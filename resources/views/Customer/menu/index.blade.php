<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <title>Menu</title>
</head>

<body>
    <h1>Menu</h1>
    <br><br>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12">
                <div class="dropdown">
                    <button type="button" class="btn btn-primary" data-toggle="dropdown">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        Cart
                        <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                    </button>

                    <div class="dropdown-menu">
                        <div class="row total-header-section">
                            @php $total = 0 @endphp
                            @foreach ((array) session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                            @endforeach
                            <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                                <p>Total: <span class="text-info">{{ $total }} VND</span></p>
                            </div>
                        </div>
                        @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
                                <div class="row cart-detail">
                                    <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                        <img style="width: 110px; height: 65px;" src="{{ asset($details['image']) }}" />
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                        <p>{{ $details['name'] }}</p>
                                        <span class="price text-info"> {{ $details['price'] }} VND</span> <span
                                            class="count"> Quantity:{{ $details['quantity'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                <a href="{{ route('customer.order.show') }}" class="btn btn-primary btn-block">View
                                    all</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        @if ($menu->status->value === 'Unavailable')
                            <td>
                                <a href="{{ route('customer.order.add', ['menu' => $menu]) }}">
                                    <button class="btn btn-primary" style="display: none;">Order</button>
                                </a>
                            </td>
                        @else
                            <td>
                                <a href="{{ route('customer.order.add', ['menu' => $menu]) }}">
                                    <button class="btn btn-primary">Order</button>
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('customer.index') }}">
        <button class="btn btn-primary">Back</button>
    </a>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>
</body>

</html>
