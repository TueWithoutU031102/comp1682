<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Menu</title>
</head>

<body>
    <h1>Menu</h1>
    <br><br>
    <a href="" class="btn btn-primary">
        Show cart
    </a>
    <table class="table table-hover">
        <tbody>
            @php
                $currentType = null;
            @endphp
            @foreach ($types as $type)
                <tr>
                    <td colspan="3">{{ $type->name }}</td>
                </tr>
                @foreach ($type->menus as $menu)
                    <tr onclick="redirectTo('{{ route('customer.menu.show', ['menu' => $menu]) }}')">
                        <td style="width:20%">
                            <ul class="img">
                                <li>
                                    <img style="width: 600px;height: 400px" src="{{ asset($menu->image) }}">
                                </li>
                            </ul>
                        </td>
                        <td>
                            <h3>{{ $menu->name }}</h3>
                            <p>{{ $menu->price }}</p>
                            <p>{{ $menu->status }}</p>
                            <p>{{ $menu->description }}</p>
                        </td>
                        <td>
                            @if ($menu->status === 'Unavailable')
                                <button type="button" class="btn btn-primary" style="display: none;">Order</button>
                            @else
                                <a href="#" onclick="event.stopPropagation();"
                                    data-url="{{ route('addToCart', ['id' => $menu->id]) }}" title="View Profile"
                                    class="btn btn-info addToCart">Order</a>
                            @endif

                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('customer.index') }}">
        <button class="btn btn-primary">Back</button>
    </a>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }

        function addToCart(event) {
            event.preventDefault();
            let urlCart = $(this).data('url');
            $.ajax({
                type: "GET",
                url: urlCart,
                dataType: 'json',
                success: function(data) {
                    if (data.code === 200)
                        alert("Add dish to cart successfully");
                },
                error: function() {

                },
            });
        }
        $(function() {
            $('.addToCart').on("click", addToCart);
        });
    </script>
</body>

</html>
