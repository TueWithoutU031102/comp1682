<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Index Customer page</title>
</head>

<body>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    customer page
    <div class="button-action">
        <a href="{{ route('customer.book.create') }}" class="btn btn-primary">Booking</a>
    </div>
    <div class="button-action">
        <a href="" class="btn btn-primary">Payment</a>
    </div>
    <div class="button-action">
        <a href="{{ route('customer.review.create') }}" class="btn btn-primary">Review</a>
    </div>
    <div class="button-action">
        <button id="notifyButton"> class="btn btn-primary">Call staffs</button>
    </div>
    <div class="button-action">
        <a href="{{ route('customer.menu.index') }}" class="btn btn-primary">Menu</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notifyButton = document.getElementById('notifyButton');

            notifyButton.addEventListener('click', function() {
                fetch('/managers/notifications/index', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            message: "Khách hàng cần trợ giúp"
                        })
                    })
                    .then(response => {
                        console.log('Yêu cầu đã được gửi thành công');
                    })
                    .catch(error => {
                        console.error('Đã xảy ra lỗi khi gửi yêu cầu: ', error);
                    });
            });
        });
    </script>
</body>

</html>
