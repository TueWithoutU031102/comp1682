@extends('layouts.bill')

@section('content')
    <div class="min-h-screen">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
        @endif
        <div class="flex flex-col text-center mt-[20vh]">
            <h1 class="mb-5">Good morning, {{ $user_name }}</h1>

            <div>
                <p class="italic opacity-50">Table Name</p>
                <div class="p-5 rounded-full bg-cyan-600 inline-block relative mt-2">
                    <span
                        class="absolute text-white font-semibold text-2xl top-1 right-0 left-0 bottom-0">{{ $table_id }}</span>
                </div>
            </div>
        </div>
        {{-- TODO: làm lại giao diện của trang customer --}}
        <div class="w-full mt-5">
            <div class="card max-w-2xl mx-auto w-full bg-white shadow">

                <div class="card-body grid grid-cols-2 md:grid-cols-3 gap-5">
                    <form action="{{ route('customer.notification.store') }}" method="POST" enctype="multipart/form-data"
                        class="flex flex-col justify-center w-32 h-32 transition border mx-auto cursor-pointer">
                        <div class="flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M12 5a2 2 0 0 1 2 2c0 .24-.04.47-.12.69C17.95 8.5 21 11.91 21 16H3c0-4.09 3.05-7.5 7.12-8.31c-.08-.22-.12-.45-.12-.69a2 2 0 0 1 2-2m10 14H2v-2h20v2Z" />
                            </svg>
                        </div>
                        @csrf
                        <input type="hidden" class="form-control" value="{{ $session_id }}" id="note"
                            name="session_id">
                        <button type="submit" class="mt-3 mx-auto">Call Staff</button>
                    </form>

                    <a href="{{ route('customer.menu.index') }}"
                        class="flex flex-col justify-center w-32 h-32 transition border mx-auto">
                        <div class="flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M18.06 23h1.66c.84 0 1.53-.65 1.63-1.47L23 5.05h-5V1h-1.97v4.05h-4.97l.3 2.34c1.71.47 3.31 1.32 4.27 2.26c1.44 1.42 2.43 2.89 2.43 5.29V23M1 22v-1h15.03v1c0 .54-.45 1-1.03 1H2c-.55 0-1-.46-1-1m15.03-7C16.03 7 1 7 1 15h15.03M1 17h15v2H1v-2Z" />
                            </svg>
                        </div>
                        <span class="mt-3 mx-auto">Order</span>
                    </a>

                    <a href="{{ route('customer.review.create') }}"
                        class="flex flex-col justify-center w-32 h-32 transition border mx-auto col-span-2 md:col-span-1 cursor-pointer">
                        <div class="flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M20 2H4c-1.1 0-2 .9-2 2v15.59c0 .89 1.08 1.34 1.71.71L6 18h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-6.43 9.57l-1.12 2.44a.5.5 0 0 1-.91 0l-1.12-2.44l-2.44-1.12a.5.5 0 0 1 0-.91l2.44-1.12l1.12-2.44a.5.5 0 0 1 .91 0l1.12 2.44l2.44 1.12a.5.5 0 0 1 0 .91l-2.44 1.12z" />
                            </svg>
                        </div>
                        <span class="mt-3 mx-auto">Review</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

