<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/index.css">
    @include('layouts.link')
    <title>Index</title>
</head>

<body>
    <div class="nav-bar">
        <nav style="width:100%;height:100%;" class="navbar navbar-expand-lg navbar-light bg-light">
            <a style="width: 20%;height:20%" class="navbar-brand" href=""><img style="width:60%;height:60%;"
                    src="/images/logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div style="text-align:center" class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.book.create') }}">Booking</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="body">
        <div class="coffee-cake">
            <div class="coffee">
                <div class="img">
                    <img src="/images/eggcoffee.jpg" alt="">
                </div>
                <div class="description">
                    <h2>Egg coffee</h2>
                    <div>Cà phê trứng không chỉ là một thức uống ngon
                        mà còn là một phần của văn hóa ẩm thực đặc biệt của Việt Nam. </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">

    </div>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif


</body>

</html>
