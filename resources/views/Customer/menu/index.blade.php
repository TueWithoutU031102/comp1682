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
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    <a href="{{ route('customer.order.show') }}" class="btn btn-primary">
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
                            <a href="{{ route('customer.order.add', ['menu' => $menu]) }}">
                                <button class="btn btn-primary">Order</button>
                            </a>
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
    </script>
</body>

</html>
