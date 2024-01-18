@extends('layouts.consumer')

@section('content')
<div class="px-3">
    <div class="py-10">
        @if (Session::has('success'))
        <div class="alert alert-success bg-[rgba(5,38,142,1)]" role="alert"><strong class="text-white">{{ Session::get('success') }}</strong></div>
        @endif
        @php
        $currentType = null;
        @endphp
        <h2 class="text-center my-5 text-4xl font-bold">MENU</h2>
        <div class="grid grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 gap-5 mt-10">
            @foreach ($menus as $menu)
            {{-- @php
            $open = "menu{$menu->id}.showModal()";
            @endphp --}}

            {{-- <dialog id="menu{{ $menu->id }}" class="modal">
                <div class="modal-box lg:max-w-lg">
                    <article>
                        <form method="dialog">
                            <button method="dialog" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                                X
                            </button>
                        </form>
                        <h3 class="font-semibold text-lg mb-3">{{ $menu->name }}</h3>

                        <img class="w-full aspect-square object-cover" src="{{ asset($menu->image) }}" alt="">
                        <table class="table">
                            <tr>
                                <td>Price</td>
                                <td>{{ number_format($menu->price) }} đ</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ $menu->status }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ $menu->description }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('customer.order.add', $menu) }}" class="btn btn-success mt-5">Add to
                            cart</a>
                    </article>
                </div>
            </dialog> --}}

            <div style="background: rgba(5, 38, 142, 1); border-radius: 15px;">
                <div onclick="window.location.href = '{{ route('customer.menu.show', ['menu' => $menu]) }}'"
                    class="relative overflow-hidden transition hover:shadow-md duration-300 shadow rounded :[&>img]:rounded">
                    <img class="aspect-square object-cover cursor-pointer w-28 mx-auto my-4 transition duration-500 hover:scale-125"
                        src="{{ asset($menu->image) }}" alt="">

                    <!-- {{-- @if ($menu->status->value === 'Available')
                    <a href="{{ route('customer.order.add', ['menu' => $menu]) }}">
                        <button class="absolute bottom-3 right-3 btn btn-circle btn-warning btn-sm opacity-90">+
                        </button>
                    </a>
                    @endif --}} -->
                </div>
                <p class="flex flex-col p-2">
                    <strong style="color: #fff" class="cursor-pointer">{{ $menu->name }}</strong>
                    <span style="color: #fff" class="text-sm">{{ number_format($menu->price) }} đ</span>
                    <!-- {{-- <span class="opacity-50 text-sm">{{ $menu->description }}</span> --}} -->
                </p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection