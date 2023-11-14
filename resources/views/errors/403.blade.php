<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @include('layouts/link') --}}
    <style>
        .message {
            max-width: 700px;
            margin: 5rem auto 0 auto;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-image: url("/images/nezuko.gif");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <div id="preloader"></div>
    <div class="message">
        <h1>Oops!</h1>
        <h1>403</h1>
        <a href="/index">
            <h2>&rightarrow; BACK TO HOME &LeftArrow;</h2>
        </a>
        <p>YOU DO NOT HAVE PERMISSION TO ACCESS THE DOCUMENT OR PROGRAM THAT YOU REQUESTED.</p>
    </div>
</body>

</html>
