@extends('layouts.consumer')



@section('content')
<div class="flex flex-col space-y-3">
    @if (session('cart'))
    @foreach (session('cart') as $id => $details)
    <div class="rounded flex space-x-2 bg-white p-2 cart-detail">
        <div class="cart-detail-img">
            <img class="aspect-square w-12 h-12 rounded object-cover" src="{{ asset($details['image']) }}" alt="">
        </div>
        <div>
            <p>{{ $details['name'] }}</p>
            <div class="flex justify-between mt-3">
                <div class="join border border-stone-200 ">
                    <button class="btn btn-xs join-item" onclick="decreaseQuantity(this)">-</button>
                    <div class="cart_update" data-id="{{ $id }}">
                        <input type="number" class="input input-xs join-item w-8 text-center quantity"
                            value="{{ $details['quantity'] }}">
                    </div>
                    <button class="btn btn-xs join-item" onclick="increaseQuantity(this)">+</button>
                </div>
            </div>
            <span class="text-red-500 price" data-price="{{ $details['price'] }}">
                {{ number_format($details['price']) }} đ
            </span>
        </div>
    </div>
    @endforeach
    @endif
</div>

<div>
    <hr class="border-t h-1 border-black border-dashed w-full my-2">
    <div class="flex justify-between">
        @php $total = 0 @endphp
        @foreach ((array) session('cart') as $id => $details)
        @php $total += $details['price'] * $details['quantity'] @endphp
        @endforeach
        <span>Total price:</span>
        <span id="total-amount"> {{ number_format($total) }} đ</span>
    </div>
    <form action="{{ route('customer.order.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <button type="submit" class="btn btn-info w-full mt-2">Order</button>
    </form>
    <div class="lg:mt-3 w-full text-center">
        <label class="swap swap-flip opacity-40">

            <!-- this hidden checkbox controls the state -->
            <input type="checkbox" class="hidden" />
            <div class="swap-off"><span class="text-4xl">😀</span></div>
            <div class="swap-on"><span class="text-4xl">🤡</span></div>
        </label>
    </div>
</div>



<!-- <div class="drawer drawer-end lg:drawer-open">
    <input id="navbar" type="checkbox" class="drawer-toggle" />
    <div style="background: #fff" class="drawer-content flex flex-col bg-stone-50">
        @yield('content')
    </div>
    <div class="drawer-side z-20">
        <label for="navbar" aria-label="close sidebar" class="drawer-overlay"></label>
        <div class="h-full flex flex-col justify-between p-4 w-80 bg-base-200">
            <div class="flex flex-col space-y-3">
                @if (session('cart'))
                @foreach (session('cart') as $id => $details)
                <div class="rounded flex space-x-2 bg-white p-2 cart-detail">
                    <div class="cart-detail-img">
                        <img class="aspect-square w-12 h-12 rounded object-cover" src="{{ asset($details['image']) }}"
                            alt="">
                    </div>
                    <div>
                        <p>{{ $details['name'] }}</p>
                        <div class="flex justify-between mt-3">
                            <div class="join border border-stone-200 ">
                                <button class="btn btn-xs join-item" onclick="decreaseQuantity(this)">-</button>
                                <div class="cart_update" data-id="{{ $id }}">
                                    <input type="number" class="input input-xs join-item w-8 text-center quantity"
                                        value="{{ $details['quantity'] }}">
                                </div>
                                <button class="btn btn-xs join-item" onclick="increaseQuantity(this)">+</button>
                            </div>
                        </div>
                        <span class="text-red-500 price" data-price="{{ $details['price'] }}">
                            {{ number_format($details['price']) }} đ
                        </span>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div> -->


<!-- </div> -->
<script type="text/javascript">
    const formater = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });

    $(document).on('input', '.cart_update input.quantity', function () {
        let id = $(this).closest('.cart_detail').find('.cart_update').data('id');
        let quantity = $(this).val();
        update(id, quantity);
    });


    function update(id, quantity) {
        var total = 0;
        $('.cart-detail').each(function () {
            var quantity = +$(this).find('.quantity').val();
            var price = parseFloat($(this).find('.price').data('price'));
            total += price * quantity;
        });

        $('#total-amount').text(formater.format(total));

        fetch('/customers/orders/update/' + id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                quantity: +quantity
            })
        })
    }

    function decreaseQuantity(button) {
        var inputElement = button.parentElement.querySelector('.quantity');
        if (inputElement.value > 1) {
            inputElement.value = parseInt(inputElement.value) - 1;
            let id = $(button).closest('.cart-detail').find('.cart_update').data('id');
            update(id, inputElement.value);
        } else if (inputElement.value == 1) {
            inputElement.value = parseInt(inputElement.value) - 1;
            let cartDetail = $(button).closest('.cart-detail');
            let id = cartDetail.find('.cart_update').data('id');
            update(id, 0)
            cartDetail.remove();
        }
    }

    function increaseQuantity(button) {
        var inputElement = button.parentElement.querySelector('.quantity');
        inputElement.value = parseInt(inputElement.value) + 1;
        let id = $(button).closest('.cart-detail').find('.cart_update').data('id');
        update(id, inputElement.value);
    }
</script>
</div>
@endsection