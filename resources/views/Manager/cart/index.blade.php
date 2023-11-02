<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Cart</title>
</head>

<body>
    <h1>Cart</h1>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    <br><br>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Dish</th>
                <th scope="col">Table</th>
                <th scope="col">Quantity</th>
                <th scope="col">Status</th>
                <th scope="col">Time order</th>
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
                <tr>
                    <td>{{ $cart->id }}</td>
                    <td>{{ $cart->menu->name }}</td>
                    <td>{{ $cart->session->table->name }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td class="status-cell" data-cart-id="{{ $cart->id }}" data-status="{{ $cart->status }}">
                        <span class="status-text">{{ $cart->status }}</span>
                    </td>
                    <td>{{ $cart->created_at }}</td>
                    {{-- <td>
                        <form action="{{ route('manager.cart.destroy', ['cart' => $cart]) }}" method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Are you sure to delete {{ $cart->id }} !!!???')">
                            @csrf
                            <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i
                                        class="fa-solid fa-trash"></i></button>
                        </form>
                    </td> --}}
                </tr>
                <tr class="form-row" id="form-row-{{ $cart->id }}" style="display: none;">
                    <td colspan="6">
                        <form method="POST" action="{{ route('manager.cart.update', ['cart' => $cart]) }}">
                            @method('PUT')
                            @csrf

                            <label for="StatusDish" class="form-label">Status</label>

                            <select name="status" value="{{ $cart->status }}" class="form-select" id="status">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->value }}">{{ $status->name }}</option>
                                @endforeach
                            </select>

                            <button type="submit">Lưu thay đổi</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".status-cell").click(function() {
                var cartId = $(this).data("cart-id");
                $("#form-row-" + cartId).toggle();
            });
        });
    </script>
</body>

</html>
