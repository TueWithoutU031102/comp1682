<div class="container">
    <h1>Order Cart</h1>
    <br><br>
    <div class="cart_feedback alert" style="display: none;"></div>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price (VND)</th>
                <th scope="col">Quantity</th>
                <th scope="col">Sub Total</th>
                <th scope="col"></th>

            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @if ($carts === null)
                <tr>
                    <td colspan="7">Your cart is empty.</td>
                </tr>
            @else
                @forelse ($carts as $id => $cartItem)
                    @php
                        $total += $cartItem['price'] * $cartItem['quantity'];
                    @endphp
                    <tr>
                        <th scope="row">{{ $id }}</th>
                        <td><img style="width: 200px; height: 100px;" src="{{ asset($cartItem['image']) }}"
                                alt="">
                        </td>
                        <td>{{ $cartItem['name'] }}</td>
                        <td>{{ number_format($cartItem['price']) }}</td>
                        <td class="cart_update" data-id="{{ $id }}">
                            <input type="number" value="{{ $cartItem['quantity'] }}" min="1" min="1"
                                class="quantity">
                        </td>
                        <td>{{ number_format($cartItem['price'] * $cartItem['quantity']) }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm cart_remove" data-id="{{ $id }}">
                                <i class="fa fa-trash-o"></i>
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Your cart is empty.</td>
                    </tr>
                @endforelse
            @endif
        </tbody>
    </table>

    <div class="col-md-12">
        <h2>Total: {{ number_format($total) }} VND</h2>
    </div>
    <a href="{{ route('customer.menu.index') }}">
        <button class="btn btn-primary">Continue to order</button>
    </a>
    <div>
        <form action={{ route('vnpay_payment') }} method="POST">
            @csrf
            <input type="hidden" name="total" value="{{ $total }}">
            <button type="submit" name="redirect" class="btn btn-primary checkout-btn">Checkout by VNPay</button>
        </form>
    </div>

</div>
