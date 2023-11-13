@extends('layouts.landing')

@section('content')
    @foreach ($types as $type)
        <div class="bg-white py-10">
            <div class="container">
                {{-- small banner --}}
                <h2 class="text-center mt-10">{{ $type->name }}</h2>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-7">
                    @foreach ($type->menus as $menu)
                        <div>
                            <div class="transition rounded hover:shadow-md hover:scale-105 duration-300">
                                <img class="aspect-square object-cover w-full rounded" src="{{ asset($menu->image) }}"
                                    alt="">
                            </div>
                            <p class="flex flex-col p-2">
                                <strong>{{ $menu->name }}</strong>
                                <span class="opacity-50 text-sm">{{ $menu->price }}</span>
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    {{-- <div class="container py-10">
        <h2 class="text-center">Các món ăn</h2>
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mt-5">
            @foreach (range(1, 8) as $index)
                <div>
                    <div
                        class="relative overflow-hidden transition hover:shadow-md duration-300 shadow rounded :[&>img]:rounded">
                        @if ($index == 1)
                            <div class="absolute px-5 py-2 bg-yellow-400 top-5 rounded-r-full z-[1] shadow">Best Seller
                            </div>
                        @endif
                        <img class="aspect-square object-cover w-full transition duration-500 hover:scale-125"
                            src="https://picsum.photos/800?i={{ $index }}" alt="">
                    </div>
                    <p class="flex flex-col p-2">
                        <strong>Cafe Đen Đá</strong>
                        <span class="opacity-50 text-sm">49.000 đ</span>
                    </p>
                </div>
            @endforeach
        </div>
    </div> --}}

    {{-- <div class="bg-yellow-50">
        <div class="container py-10">
            <h2 class="text-center">Những câu chuyện</h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5 gap-y-10">

                @foreach (range(1, 6) as $item)
                    <div>
                        <img class="aspect-[10/5] rounded object-cover w-full ring-offset-2 ring-1"
                            src="https://picsum.photos/800" alt="">

                        <h3 class="text-lg text-black opacity-90 mt-2 mb-0">Title of a post here</h3>
                        <p class="text-sm mt-3 opacity-60">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, repellendus facilis?
                            Adipisci incidunt minus veritatis iure doloremque ut eum ipsam nemo dolorum repellendus dolore,
                            accusamus iusto optio laudantium nobis beatae.
                        </p>
                    </div>
                @endforeach

            </div>
        </div>
    </div> --}}

    <dialog id="modal" class="modal">
        <div class="modal-box w-full h-full">
            <article class="w-full h-full">
                <form method="dialog">
                    <button method="dialog" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                        X
                    </button>
                </form>
                <iframe class="w-full h-full" src="{{ route('customer.book.create') }}"></iframe>
            </article>
        </div>
    </dialog>
@endsection


@push('scripts')
    <script>
        function showModal() {
            var modal = document.getElementById("modal");
            modal.showModal();
        }
    </script>
@endpush
