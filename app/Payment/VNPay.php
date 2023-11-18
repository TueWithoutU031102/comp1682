<?php

namespace App\Payment;

class VNPay
{
    public const API = 'https://sandbox.vnpayment.vn';

    protected $responseCode = [
        '00' => 'Successful transaction',
        '07' => 'Deduct money successfully. Suspected transaction (related to fraud, unusual transactions).',
        '09' => 'Customer`s card/account has not registered for InternetBanking service at the bank.',
        '10' => 'Customers verify incorrect card/account information more than 3 times.',
        '11' => 'Payment deadline has expired. Please retry the transaction.',
        '12' => 'Customer`s card/account is locked.',
        '13' => 'You entered the wrong transaction authentication password (OTP). Please retry the transaction.',
        '24' => 'Customer cancels transaction',
        '51' => 'Your account does not have enough balance to make a transaction.',
        '65' => 'Your account has exceeded the daily transaction limit.',
        '75' => 'The payment bank is under maintenance.',
        '79' => 'Customers enter the wrong payment password more than the specified number of times. Please retry the transaction.',
        '99' => 'Other error',
    ];

    public function __construct(
        protected string $merchantCode = 'N4XIQGO3',
        protected string $secret = 'VOMWSOAXPMYBXTRZTFJNKSPCHNEQMLLP',
        protected string $locale = 'vn',
        protected string $version = '2.1.0',
    ) {
    }

    /**
     * Create payment url
     *
     * @param integer $amount Số tiền thanh toán.
     * @param string $ip Địa chỉ IP của khách hàng thực hiện giao dịch. Ví dụ: 13.160.92.202
     * @param string $ref Mã tham chiếu của giao dịch tại hệ thống của merchant. Mã này là duy nhất dùng để phân biệt các đơn hàng gửi sang VNPAY. Không được trùng lặp trong ngày. Ví dụ: 23554
     * @param string $description Thông tin mô tả nội dung thanh toán (Tiếng Việt, không dấu). Ví dụ: **Nap tien cho thue bao 0123456789. So tien 100,000 VND** 
     * @param string $callbackURL URL thông báo kết quả giao dịch khi Khách hàng kết thúc thanh toán. Ví dụ: https://domain.vn/VnPayReturn 
     * @return void
     */
    public function create(string $ref, int $amount, string $ip, string $description, string $callbackURL)
    {
        // https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?vnp_Amount=1806000&vnp_Command=pay&vnp_CreateDate=20210801153333&vnp_CurrCode=VND&vnp_IpAddr=127.0.0.1&vnp_Locale=vn&vnp_OrderInfo=Thanh+toan+don+hang+%3A5&vnp_OrderType=other&vnp_ReturnUrl=https%3A%2F%2Fdomainmerchant.vn%2FReturnUrl&vnp_TmnCode=DEMOV210&vnp_TxnRef=5&vnp_Version=2.1.0&vnp_SecureHash=3e0d61a0c0534b2e36680b3f7277743e8784cc4e1d68fa7d276e79c23be7d6318d338b477910a27992f5057bb1582bd44bd82ae8009ffaf6d141219218625c42
        $payload = [
            'vnp_Version' => $this->version,
            'vnp_Command' => 'pay',
            'vnp_TmnCode' => $this->merchantCode,
            'vnp_Amount' => $amount * 100,
            'vnp_CreateDate' => date('YmdHis'),
            'vnp_CurrCode' => 'VND',
            'vnp_IpAddr' => $ip,
            'vnp_Locale' => $this->locale,
            'vnp_OrderInfo' => $description,
            'vnp_OrderType' => 'other',
            'vnp_ReturnUrl' => $callbackURL,
            'vnp_TxnRef' => $ref,
        ];

        ksort($payload);

        $query = http_build_query($payload);
        $hmac = hash_hmac('sha512', $query, $this->secret);
        $query = "$query&vnp_SecureHash=$hmac";

        return static::API . "/paymentv2/vpcpay.html?$query";
    }

    /**
     * Read payment result
     *
     * @return null|\App\Payment\Status null if invalid hash otherwise return object with properties: transaction_id, ref, amount, code, success, message
     */
    public function read()
    {
        $payload = [];

        if (empty($_GET['vnp_SecureHash'])) {
            return null;
        }

        foreach ($_GET as $key => $value) {
            $payload[$key] = $value;
        }

        unset($payload['vnp_SecureHash']);
        $query = http_build_query($payload);

        if (hash_hmac('sha512', $query, $this->secret) !== $_GET['vnp_SecureHash']) {
            return null;
        }

        $payload = (object) $payload;

        return new Status([
            'transaction_id' => $payload->vnp_TransactionNo,
            'ref' => $payload->vnp_TxnRef,
            'amount' => $payload->vnp_Amount / 100,
            'code' => $payload->vnp_ResponseCode,
            'success' => $payload->vnp_ResponseCode === '00',
            'message' => $this->responseCode[$payload->vnp_ResponseCode] ?? 'Lỗi không xác định',
        ]);
    }
}
