@extends('layouts.consumer')

@section('content')
    <div class="px-3">
        <div class="py-10">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
            @endif
            @php
                $currentType = null;
            @endphp
            @foreach ($types as $type)
                <h2 class="text-center my-5 text-3xl font-bold">{{ $type->name }}</h2>
                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mt-5">
                    @foreach ($type->menus as $menu)
                        <div onclick="redirectTo('{{ route('customer.menu.show', ['menu' => $menu]) }}')">
                            <div
                                class="relative overflow-hidden transition hover:shadow-md duration-300 shadow rounded :[&>img]:rounded">
                                @if ($menu->id == 1)
                                    <div class="absolute px-5 py-2 bg-yellow-400 top-5 rounded-r-full z-[1] shadow">Best
                                        Seller</div>
                                @endif

                                <img class="aspect-square object-cover w-full transition duration-500 hover:scale-125"
                                    src="{{ asset($menu->image) }}" alt="">

                                @if ($menu->status->value === 'Available')
                                    <td>
                                        <a href="{{ route('customer.order.add', ['menu' => $menu]) }}">
                                            <button
                                                class="absolute bottom-3 right-3 btn btn-circle btn-warning btn-sm opacity-90">+
                                            </button>
                                        </a>
                                    </td>
                                @endif

                            </div>
                            <p class="flex flex-col p-2">
                                <strong>{{ $menu->name }}</strong>
                                <span class="opacity-50 text-sm">{{ $menu->price }}</span>
                                <span class="opacity-50 text-sm">{{ $menu->status }}</span>
                                <span class="opacity-50 text-sm">{{ $menu->description }}</span>
                            </p>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <a href="{{ route('customer.index') }}">
        <button class="btn btn-primary">Back</button>
    </a>
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>
@endsection
