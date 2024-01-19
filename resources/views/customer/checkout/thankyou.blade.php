<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thanks you</title>

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

    <div class ="flex flex-col justify-center">
        <div class="font-bold text-2xl text-white mx-auto">
            <p>Cảm ơn bạn đã đặt món</p>
            <p>Chúc bạn ngon miệng!</p>
        </div>
        <div>
            <img src="/images/Toothless.png" alt="">
        </div>
    </div>
</body>

</html>