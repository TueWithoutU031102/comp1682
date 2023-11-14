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
                                <span class="opacity-50 text-sm">{{ $menu->price }} đ</span>
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    <dialog id="modal" class="modal">
        <div class="modal-box w-full h-full">
            <article class="w-full h-full">
                <form method="dialog">
                    <button method="dialog" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                        X
                    </button>
                </form>
                <iframe class="w-full h-3/4" src="{{ route('customer.book.create') }}"></iframe>
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
