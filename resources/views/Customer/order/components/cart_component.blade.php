<div class="container">
    <h1>Shopping Cart</h1>
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
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @forelse ($carts as $id => $cartItem)
                @php
                    $total += $cartItem['price'] * $cartItem['quantity'];
                @endphp
                <tr>
                    <th scope="row">{{ $id }}</th>
                    <td><img style="width: 200px; height: 100px;" src="{{ asset($cartItem['image']) }}" alt="">
                    </td>
                    <td>{{ $cartItem['name'] }}</td>
                    <td>{{ number_format($cartItem['price']) }}</td>
                    <td><input type="number" value="{{ $cartItem['quantity'] }}" min="1" class="quantity"
                            data-id="{{ $id }}"></td>
                    <td>{{ number_format($cartItem['price'] * $cartItem['quantity']) }}</td>
                    <td></td>
                    <td>
                        <button class="btn btn-primary cart_update" data-id="{{ $id }}">Update</button>
                        <button class="btn btn-danger cart_delete" data-id="{{ $id }}">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Your cart is empty.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="col-md-12">
        <h2>Total: {{ number_format($total) }} VND</h2>
    </div>
    <a href="/customer/order/orderForm">
        <button class="btn btn-primary">Back to Homepage</button>
    </a>
    <a href="">
        <button class="btn btn-primary">Submit</button>
    </a>
</div>
