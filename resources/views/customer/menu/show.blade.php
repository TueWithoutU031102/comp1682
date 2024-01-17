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

    .image-cover {
        box-shadow: 0px 0px 20px 0px #c9c9c9;
        width: 342px;
        height: 342px;
        margin-left: 25px;
        margin-top: 25px;
        border-radius: 100%;
        border: none;
    }

    .image {
        object-fit: fill;
        margin-left: 5px;
        border-radius: 100%;
        width: 240px;
        height: 240px;
        position: relative;
        left: 45px;
        top: 50px;
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
<div class="user-card">
    <div class="image-cover">
        <img class="image" src="{{ asset($menu->image) }}">
    </div>
    <div class="submission-information">
        <p><span>Price: </span>{{ $menu->price }}</p>
    </div>
    <div>
        @if ($menu->status->value === 'Available')
        <td>
            <div class="rounded flex space-x-2 bg-white p-2">
                <div>
                    <div class="flex justify-between mt-3">
                        <div class="join border border-stone-200 ">
                            <button id="decrease" class="btn btn-xs join-item" onclick="updateQuantity(-1)">-</button>
                            <div>
                                <input id="quantity" type="number"
                                    class="input input-xs join-item w-8 text-center quantity" value="1">
                            </div>
                            <button id="increase" class="btn btn-xs join-item" onclick="updateQuantity(1)">+</button>
                        </div>
                    </div>
                    <span id="price" class="text-red-500 price" data-price="{{ $menu->price }}">
                        đ
                    </span>
                </div>
            </div>
            <form action="{{ route('customer.order.add', ['menu' => $menu]) }}" method="POST"
                enctype="multipart/form-data">
                <input id="submitquantity" name="quantity" type="hidden" value="1">
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
        submitquantity.value = quantity.value
    }

    function updatePrice(quantity) {
        // Assuming base price is 10 and increases by 5 for each quantity unit
        const basePrice = {{ $menu-> price
    }};

    const newPrice = basePrice * quantity;
    priceSpan.textContent = newPrice + ' đ';
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