@extends('layouts.consumer')



@section('content')
    <h1 class="display-4" style="text-align: center; font-weight: bold">DISH INFORMATION</h1><br>
    <div class="user-card">
        <img src="{{ asset($menu->image) }}">
        <div class="submission-information">
            <h2>{{ $menu->name }}</h2>
            <p><span>Dish ID: </span>{{ $menu->id }}</p>
            <p><span>Name: </span>{{ $menu->name }}</p>
            <p><span>Type: </span>{{ $menu->type->name }}</p>
            <p><span>Status: </span> {{ $menu->status }}</p>
            <p><span>Price: </span>{{ $menu->price }}</p>
            <p><span>Description: </span>{{ $menu->description }}</p>
            @if ($menu->status->value === 'Available')
                <td>
                    <div class="rounded flex space-x-2 bg-white p-2">
                        <div>
                            <div class="flex justify-between mt-3">
                                <div class="join border border-stone-200 ">
                                    <button id="decrease" class="btn btn-xs join-item"
                                        onclick="updateQuantity(-1)">-</button>
                                    <div>
                                        <input id="quantity" type="number"
                                            class="input input-xs join-item w-8 text-center quantity" value="1">
                                    </div>
                                    <button id="increase" class="btn btn-xs join-item"
                                        onclick="updateQuantity(1)">+</button>
                                </div>
                            </div>
                            <span id="price" class="text-red-500 price" data-price="{{ $menu->price }}">
                                đ
                            </span>
                        </div>
                    </div>
                    <form action="{{ route('customer.order.add', ['menu' => $menu]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <button class="absolute bottom-3 right-3 btn btn-circle btn-warning btn-sm opacity-90">+
                        </button>
                    </form>
                    </a>
                </td>
            @endif
        </div>
    </div>

    <script type="text/javascript">
        const quantityInput = document.getElementById('quantity');
        const priceSpan = document.getElementById('price');

        function updateQuantity(change) {
            let currentQuantity = parseInt(quantityInput.value);
            let newQuantity = currentQuantity + change;

            // Ensure quantity is non-negative and has a minimum value of 1
            newQuantity = Math.max(newQuantity, 1);

            quantityInput.value = newQuantity;

            // Update price based on quantity
            updatePrice(newQuantity);
        }

        function updatePrice(quantity) {
            // Assuming base price is 10 and increases by 5 for each quantity unit
            const basePrice = {{ $menu->price }};

            const newPrice = basePrice * quantity;
            priceSpan.textContent = newPrice + ' đ';
        }

        // Set initial price when the page loads
        updatePrice(parseInt(quantityInput.value));

        addToCartButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the anchor tag
            const menuId = addToCartButton.dataset.menuId;
            const quantity = quantityInput.value;

            // Call addToCart function
            addToCart(menuId, quantity);
        });

        function addToCart(menuId, quantity) {
            // Perform AJAX request to the server to add the item to the cart
            // Adjust this URL according to your route configuration
            const url = '{{ route('customer.order.add', ['menu' => $menu]) }}';
            const data = {
                menu_id: menuId,
                quantity: quantity,
            };

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response (optional)
                    console.log('Item added to cart:', data);
                })
                .catch(error => {
                    console.error('Error adding item to cart:', error);
                });
        }
    </script>
@endsection
