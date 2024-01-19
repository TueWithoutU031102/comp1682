<label for="navbar" aria-label="close sidebar" class="drawer-overlay"></label>
<div class="flex flex-col justify-between p-2 w-80 bg-base-200">
    <div class="flex flex-col space-y-2">
        @if ($bill)
            @php $total = 0 @endphp
            @foreach ($bill as $b)
                <div class="rounded flex space-x-2 bg-white p-2 cart-detail">
                    <div class="cart-detail-img">
                        <img class="aspect-square w-12 h-12 rounded" src="{{ asset($b->menu->image) }}" alt="">
                    </div>
                    <div>
                        <p>
                            {{ $b['quantity'] }} X
                            {{ $b->menu->name }}
                            @if ($b['status'] !== 'Completed')
                                <span class="text-sm opacity-50">({{ $b['status'] }})</span>
                            @endif
                        </p>
                        @php
                            $price = $b->menu->price * $b['quantity'];
                        @endphp
                        <span class="text-red-500 price">{{ number_format($price) }} đ</span>
                        @php $total += $price @endphp
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div>
        <hr class="border-t h-1 border-black border-dashed w-full my-2">
        <div class="flex justify-between">
            <span>Total price:</span>
            <span> {{ number_format($total) }}đ</span>
        </div>
        @php
            $allCompleted = true;
        @endphp
        @if ($bill)
            @foreach ($bill as $b)
                @if ($b['status'] !== 'Completed')
                    @php
                        $allCompleted = false;
                    @endphp
                @endif
            @endforeach
            @if ($allCompleted)
                <a href="{{ route('customer.checkout.show') }}">
                    <button type="submit" class="btn btn-info w-full mt-2 border-[rgba(202,1,71,1)] bg-[rgba(202,1,71,1)] text-white">Thanh
                        toán</button>
                </a>
            @endif
        @endif
    </div>
</div>
