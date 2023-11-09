<?php

namespace App\Http\Controllers\Customer;

use App\Models\VNPay;
use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Cart;

class CustomerController extends Controller
{
    //
    public function index(VNPay $VNpay)
    {
        if (isset($_GET['vnp_Amount'])) {
            $data_vnpay = [
                'vnp_Amount' => $_GET['vnp_Amount'],
                'vnp_BankCode' => $_GET['vnp_BankCode'],
                'vnp_BankTranNo' => $_GET['vnp_BankTranNo'],
                'vnp_CardType' => $_GET['vnp_CardType'],
                'vnp_OrderInfo' => $_GET['vnp_OrderInfo'],
                'vnp_PayDate' => $_GET['vnp_PayDate'],
                'vnp_ResponseCode' => $_GET['vnp_ResponseCode'],
                'vnp_TmnCode' => $_GET['vnp_TmnCode'],
                'vnp_TransactionNo' => $_GET['vnp_TransactionNo'],
                'vnp_TransactionStatus' => $_GET['vnp_TransactionStatus'],
                'vnp_TxnRef' => $_GET['vnp_TxnRef'],
                'vnp_SecureHash' => $_GET['vnp_SecureHash'],
            ];
            $VNpay->fill($data_vnpay)->save();
        }
        $table_id = Session::find(session()->get('customer.session'))->table->id;
        $user_name = Session::find(session()->get('customer.session'))->name;
        $session_id = session()->get('customer.session');
        $bill = Cart::where('session_id', $session_id)->get();
        // dd($bill[1]['status']);
        return view("customer.index", ["table_id" => $table_id, "user_name" => $user_name, "session_id" => $session_id, "bill" => $bill]);
    }

}
