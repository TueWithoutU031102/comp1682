@extends('layouts.consumer')

@section('content')
    <style>
        .header {
            text-align: center;
            padding-top: 30px
        }

        .header h1 {
            font-weight: bold;
            font-size: 18px
        }

        .header h3 {
            padding-top: 7px;
            font-weight: 400;
            color: rgba(67, 93, 107, 1);
            font-size: 14px;
        }
    </style>
    <div class="header">
        <h1>{{ $menu->name }}</h1>
        @if ($menu->status->value === 'Available')
            <h3>Còn hàng</h3>
        @elseif ($menu->status->value === 'Unavailable')
            <h3>Hết hàng</h3>
        @endif
    </div>
    <div>
        <div class="px-5 mt-8">
            <div class="p-12 rounded-full max-w-[320px] mx-auto" style="box-shadow: 6px 6px 30px rgba(0, 0, 0, 0.1);">
                <img class="aspect-square object-cover rounded-full" src="{{ asset($menu->image) }}">
            </div>
        </div>
        <div class="submission-information">
            @if ($menu->status->value === 'Available')
                <div class="flex justify-between mt-12 w-[200px] mx-auto">
                    <button id="decrease" class="rounded-full bg-[rgba(5,38,142,1)] size-10" onclick="updateQuantity(-1)">
                        <span class="text-xl text-white text-center">-</span>
                    </button>
                    <div>
                        <input style="font-size: 26px; font-weight: 500" id="quantity" type="number"
                            class="input input-xs join-item w-16 text-center quantity mt-2" value="1">
                    </div>
                    <button id="increase" class="rounded-full bg-[rgba(5,38,142,1)] size-10" onclick="updateQuantity(1)">
                        <span class="text-xl text-white text-center">+</span>
                    </button>
                </div>
                <div class="flex justify-between mt-20 mb-20">
                    <div class="pl-5">
                        <p class="text-[rgba(67,93,107,1)] font-medium">Tổng Tiền</p>
                        <span id="price" class="text-black text-2xl font-bold" data-price="{{ $menu->price }}">đ
                        </span>
                    </div>
                    <div>
                        <form action="{{ route('customer.order.add', ['menu' => $menu]) }}" method="POST"
                            enctype="multipart/form-data">
                            <input id="submitquantity" name="quantity" type="hidden" value="1">
                            @csrf
                            <button
                                class="text-white font-semibold mt-2 pr-8 pl-4 py-3 bg-[rgba(202,1,71,1)] rounded-l-[20px]">
                                <span class="">Thêm vào giỏ hàng</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script type="text/javascript">
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'VND',
            minimumFractionDigits: 0
        })
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
            submitquantity.value = quantity.value
        }

        function updatePrice(quantity) {
            // Assuming base price is 10 and increases by 5 for each quantity unit
            const basePrice = {{ $menu->price }};

            const newPrice = basePrice * quantity;
            priceSpan.textContent = formatter.format(newPrice);
        }

        // Set initial price when the page loads
        updatePrice(parseInt(quantityInput.value));

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
