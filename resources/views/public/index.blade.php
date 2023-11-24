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
        <div class="modal-box w-auto md:w-[42rem]">
            <form method="dialog">
                <button method="dialog" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                    X
                </button>
            </form>
            <form class="flex flex-wrap" action="{{ route('customer.book.store') }}" method="POST">
                @csrf
                
                <div class="w-full px-3 mb-6">
                    <h1 class="text-4xl text-center mt-10 font-bold mb-2">Book table</h1>
                    @include('components.notification')
                    <div class="input-box">
                        <label for="bookName"
                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Your name:</label>
                        <input type="text"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            value="{{ old('bookName') }}" id="bookName" name="bookName">
                    </div>
                    <div class="input-box">
                        <label for="phonenumber"
                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Phone:</label>
                        <input type="text"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            value="{{ old('phonenumber') }}" id="phonenumber" name="phonenumber">
                    </div>
                    <div class="input-box">
                        <label for="numberofPeople"
                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Number of
                            people:</label>
                        <input type="number" id="numberofPeople"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            value="{{ old('numberofPeople') }}" name="numberofPeople" min="1">
                    </div>
    
                    <div class="input-box">
                        <label for="arrivalTime"
                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Arrival time:</label>
                        <input type="datetime-local"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            value="{{ old('arrivalTime') }}" id="arrivalTime" name="arrivalTime">
                    </div>
                    <div class="input-box">
                        <label for="note"
                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Note:</label>
                        <input type="text"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            value="{{ old('note') }}" id="note" name="note">
                    </div>
                    <div class="button-action">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Submit</button>
                    </div>
                </div>
            </form>

          <div class="modal-action">
            <form method="dialog">
              <!-- if there is a button in form, it will close the modal -->
              <button class="btn">Close</button>
            </form>
          </div>
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
@if ($errors->any())
@push('scripts')
    <script>
        showModal();
    </script>
@endpush
@endif
