<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.2/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="bg-base-200 min-h-screen pt-10">

        <div class="flex justify-center">
            <div class="avatar mx-auto">
                <div class="w-48 mask mask-squircle">
                    <img src="/images/Logotet.png" alt="">
                </div>
            </div>
        </div>

        <div class="card bg-base-100 max-w-xl mx-auto w-full shadow">
            <div class="card-body">
                <h3 class="card-title">Payment process</h3>
                @if (Session::has('message'))
                    <div class="alert alert-error" role="alert"><strong>{{ Session::get('message') }}</strong></div>
                @endif
                <div class="bg-base-200 p-3 rounded shadow-inner my-3 space-y-3 max-h-screen overflow-y-auto">
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($bill as $b)
                        <div class="bg-base-100 p-3 flex space-x-3">
                            <div class="avatar">
                                <div class="w-16 mask mask-squircle">
                                    <img src="{{ asset($b->menu->image) }}" alt="">
                                </div>
                            </div>
                            <div>
                                <p class="mt-2"><strong>{{ $b->quantity }}</strong> x
                                    <span>{{ $b->menu->name }}</span>
                                </p>
                                <p class="text-sm">Subtotal:
                                    <span class="text-error">{{ $b->quantity * $b->menu->price }} đ</span>
                                </p>
                                @php
                                    $total += $b->quantity * $b->menu->price;
                                @endphp
                            </div>
                        </div>
                    @endforeach
                </div>

                <form action="{{ route('customer.checkout.pay') }}" class="grid grid-cols-2" method="POST">
                    @csrf
                    <p class="mt-3">
                        Your total cost is: <span class="text-primary font-bold">{{ number_format($total) }}</span>đ
                    </p>
                    <div>
                        <button type="submit" class="btn btn-danger bg-[rgba(202,1,71,1)] text-white float-right">Pay with VNPay</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="max-w-xl mx-auto mt-3">
            <a href="{{ route('customer.index') }}" class="btn btn-ghost">
                < Go Back</a>
        </div>
    </div>
</body>

</html>
