<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thanh toán</title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.2/dist/full.css" rel="stylesheet" type="text/css" /> -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="max-w-xl mx-auto ml-6 mt-3 text-3xl">
        <a href="{{ route('customer.index') }}" class="btn btn-ghost">
            <img class="mt-6" src="/images/arrow-left.png" alt="">
        </a>
    </div>
    <div class="flex flex-col space-y-6 pb-44">
        @if (Session::has('message'))
        <div class="alert alert-error" role="alert"><strong>{{ Session::get('message') }}</strong></div>
        @endif
        @php
        $total = 0;
        @endphp
        @foreach ($bill as $b)
        <div class="flex justify-evenly bg-white mx-6 mt-12 cart-detail"
            style="box-shadow: -4px -4px 10px rgba(0, 0, 0, 0.05), 4px 4px 10px rgba(0, 0, 0, 0.05);">
            <div class="cart-detail-img">
                <img class="aspect-square w-24 h-24 m-4 rounded object-cover" src="{{ asset($b->menu->image) }}" alt="">
            </div>
            <div class="mt-6">
                <p class="font-bold w-36">{{ $b->menu->name }}</p>
                <div class="flex justify-between mt-6 p-0.5 border-[1px] border-[rgba(242,245,248,1)] w-9">
                    <div class="cart_update">
                        <input type="number" class="w-8 text-center font-semibold quantity" value="{{ $b->quantity }}">
                    </div>
                </div>
            </div>
            <div class="flex flex-col justify-between mt-2">
                <div></div>
                <span class="text-black font-semibold mb-6 w-20 price"
                    data-price="{{ $b->quantity * $b->menu->price }}">
                    {{ number_format($b->quantity * $b->menu->price) }} đ
                </span>
                @php
                $total += $b->quantity * $b->menu->price;
                @endphp
            </div>
        </div>
        @endforeach
    </div>

    <div class="fixed bg-white w-full bottom-0 h-40">
        <div class="flex flex-col ml-4 mt-4">
            <span class="font-bold">Tổng:</span>
            <span class="font-bold text-xl" id="total-amount"> {{ number_format($total) }} đ</span>
        </div>
        <div class="flex justify-center">
            <form action="{{ route('customer.checkout.pay') }}" class="grid grid-cols-2" method="POST">
                @csrf
                <button type="submit"
                    class="rounded-2xl font-semibold py-[10px] w-36 mx-32 mt-6 bg-[rgba(202,1,71,1)] text-white">Thanh
                    toán
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
</body>

</html>