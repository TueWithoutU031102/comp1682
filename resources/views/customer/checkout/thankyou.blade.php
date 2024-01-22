<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#331D8A" />
    <title>Cảm ơn</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.2/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <style>
        html {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-image: url("/images/ThanksBGMB.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

        @media screen and (min-width: 768px) {
            html {
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                background-image: url("/images/ThanksBGPC.png");
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center center;
            }
        }
    </style>

    <div class="flex flex-col justify-center">
        <div class="font-bold text-xl text-center text-white mx-auto">
            <p>Cảm ơn bạn đã sử dụng dịch vụ</p>
            <p>Vui lòng qua quầy để thanh toán !</p>
        </div>
        <div>
            <img src="/images/toothless.gif" alt="">
        </div>
    </div>
    <div class="flex justify-center">
        <div class="rounded-xl absolute bottom-0">
            <footer class="container p-5 flex justify-center">
                <div class="text-white text-center text-xs">
                    <p class="mt-5">Special thanks to: <br>Vu Nguyen Duc Tue, Vu Hien Vinh, Luu Thao Huong, Alexzvn
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>