@extends('layouts.consumer')



@section('content')
@if ($cart != null)
<div class="flex flex-col space-y-6 pb-44">
    @if (session('cart'))
    @foreach (session('cart') as $id => $details)
    <div class="flex justify-evenly bg-white mx-6 mt-12 cart-detail"
        style="box-shadow: -4px -4px 10px rgba(0, 0, 0, 0.05), 4px 4px 10px rgba(0, 0, 0, 0.05);">
        <div class="cart-detail-img">
            <img class="aspect-square w-24 h-24 m-4 rounded object-cover" src="{{ asset($details['image']) }}" alt="">
        </div>
        <div class="mt-6">
            <p class="font-bold w-36">{{ $details['name'] }}</p>
            <div class="flex justify-between mt-6 p-0.5 border-[1px] border-[rgba(242,245,248,1)] w-[90px]">
                <button class="" onclick="decreaseQuantity(this)"><img src="/images/clarity_minus-line.png"
                        alt=""></button>
                <div class="cart_update" data-id="{{ $id }}">
                    <input type="number" class="w-8 text-center font-semibold quantity"
                        value="{{ $details['quantity'] }}">
                </div>
                <button class="" onclick="increaseQuantity(this)"><img class="w-5" src="/images/bi_plus.png"
                        alt=""></button>
            </div>
        </div>
        <div class="flex flex-col justify-between mt-2">
            <button onclick="cartDelete(this)"> <img class="w-6 ml-6" src="/images/bi_x.png" alt=""></button>
            <span class="text-black font-semibold mb-6 w-20 price" data-price="{{ $details['price'] }}">
                {{ number_format($details['price']) }} đ
            </span>
        </div>
    </div>
    @endforeach
    @endif
</div>

<div class="fixed bg-white w-full bottom-0 h-40">
    <div class="flex flex-col ml-4 mt-4">
        @php $total = 0 @endphp
        @foreach ((array) session('cart') as $id => $details)
        @php $total += $details['price'] * $details['quantity'] @endphp
        @endforeach
        <span class="font-bold">Tổng:</span>
        <span class="font-bold text-xl" id="total-amount"> {{ number_format($total) }} đ</span>
    </div>

    <div class="flex justify-center">
        <form action="{{ route('customer.order.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <button type="submit"
                class="rounded-2xl font-semibold py-[10px] w-36 mx-32 mt-6 bg-[rgba(202,1,71,1)] text-white">Đặt món
            </button>
        </form>
    </div>

    <!-- <div class="lg:mt-3 w-full text-center">
                                                    <label class="swap swap-flip opacity-40">

                                                        this hidden checkbox controls the state
                                                        <input type="checkbox" class="hidden" />
                                                        <div class="swap-off"><span class="text-4xl">😀</span></div>
                                                        <div class="swap-on"><span class="text-4xl">🤡</span></div>
                                                    </label>
                                                </div> -->
</div>
@else
<div class="text-center font-semibold text-[rgba(5,38,142,1)] text-xl mt-24">
    <p>Giỏ hàng của bạn đang trống.</p>
    <p>Hãy thêm món ăn vào giỏ để đặt món !</p>
    <div class="flex justify-center">
        <img src="/images/Toothless.png" alt="">
    </div>
</div>
@endif


{{-- <div class="drawer drawer-end lg:drawer-open">
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
        </div>


    </div> --}}
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

        function cartDelete(button) {
            let cartDetail = $(button).closest('.cart-detail');
            let id = cartDetail.find('.cart_update').data('id');
            cartDetail.remove();
            update(id, 0);
        }

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

            if (total == 0) { window.location.reload(); }
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
                cartDetail.remove();
                update(id, 0)
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