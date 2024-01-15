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
        <h2 class="text-center my-5 text-4xl font-bold">MENU</h2>
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mt-5">
            @foreach ($menus as $menu)
            @php
            $open = "menu{$menu->id}.showModal()";
            @endphp

            <!-- <dialog id="menu{{ $menu->id }}" class="modal">
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
            </dialog> -->

            <div style="background: rgba(5, 38, 142, 1); border-radius: 15px; margin: 40px 0 40px 0">
                <div
                    class="relative overflow-hidden transition hover:shadow-md duration-300 shadow rounded :[&>img]:rounded">
                    <img style="border-radius: 15px"
                        class="aspect-square object-cover cursor-pointer w-full transition duration-500 hover:scale-125"
                        src="{{ asset($menu->image) }}" onclick="{{ $open }}" alt="">

                    <!-- @if ($menu->status->value === 'Available')
                    <td>
                        <a href="{{ route('customer.order.add', ['menu' => $menu]) }}">
                            <button class="absolute bottom-3 right-3 btn btn-circle btn-warning btn-sm opacity-90">+
                            </button>
                        </a>
                    </td>
                    @endif -->
                </div>
                <p class="flex flex-col p-2">
                    <strong style="color: #fff" class="cursor-pointer" onclick="{{ $open }}">{{ $menu->name }}</strong>
                    <span style="color: #fff" class="text-sm">{{ number_format($menu->price) }} đ</span>
                    @if ($menu->status->value === 'Available')
                    <span style="color: #fff" class="text-sm">Còn hàng</span>
                    @elseif ($menu->status->value === 'Unavailable')
                    <span style="color: #fff" class="text-sm">Hết hàng</span>
                    @endif
                    <!-- <span class="opacity-50 text-sm">{{ $menu->description }}</span> -->
                </p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection