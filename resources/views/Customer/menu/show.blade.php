<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Detail</title>
</head>

<body>
    <h1 class="display-4" style="text-align: center; font-weight: bold">DISH INFORMATION</h1><br>
    <div class="user-card">
        <img src="{{ asset($menu->image) }}">
        <div class="submission-information">
            <h2>{{ $menu->name }}</h2>
            <p><span>Dish ID: </span>{{ $menu->id }}</p>
            <p><span>Name: </span>{{ $menu->name }}</p>
            <p><span>Type: </span>{{ $menu->type->name }}</p>
            <p><span>Status: </span> {{ $menu->statusMenu->name }}</p>
            <p><span>Price: </span>{{ $menu->price }}</p>
            <p><span>Description: </span>{{ $menu->description }}</p>
            {{-- @if ($menu->statusMenu->name === 'Unavailable')
                <button type="button" class="btn btn-primary" style="display: none;">Order</button>
            @else
                <a href="#" data-url="{{ route('addToCart', ['menu' => $menu]) }}" title="Order"
                    class="btn btn-info addToCart">Order</a>
            @endif --}}

            <a href="{{ route('customer.menu.index') }}">
                <button class="btn btn-primary">Back</button>
            </a>
        </div>
    </div>
    <script>
        function addToCart(event) {
            event.preventDefault();
            let urlCart = $(this).data('url');
            $.ajax({
                type: "GET",
                url: urlCart,
                dataType: json,
                success: function(data) {

                },
                error: function() {

                },
            });
        }
        $(function() {
            $('.addToCart').on('click', addToCart);
        });
    </script>
</body>

</html>
