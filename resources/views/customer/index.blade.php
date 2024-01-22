@extends('layouts.bill')

@section('content')
<div style="background: #fff" class="min-h-screen">
    @if (Session::has('success'))
    <div class="alert alert-success bg-[rgba(5,38,142,1)]" role="alert"><strong class="text-white">{{
            Session::get('success') }}</strong></div>
    @endif
    <div class="flex flex-col text-center mt-[10vh]">
        <h1 style="font-size: 22px; color: #000; font-weight: 500" class="mb-3">Xin chào, {{ $user_name }}</h1>

        <div>
            <p style="font-weight: 500">Số bàn</p>
            <div style="background: rgba(202, 1, 71, 1);" class="p-7 rounded-full inline-block relative mt-2">
                <span class=" absolute text-white font-semibold text-2xl top-2.5 right-0 left-0 bottom-0">{{ $table_id
                    }}</span>
            </div>
        </div>
    </div>

    <div style="background: rgba(5, 38, 142, 1); border-top-left-radius: 40px; border-top-right-radius: 40px; height: 600px; box-shadow: 0px 0px 0px, 0px -10px 10px rgba(0,0,0,0.25);"
        class="w-full mt-20">

        <div style="padding-top: 100px" class="card-body grid grid-cols-2 md:grid-cols-2 gap-12">
            <form action="{{ route('customer.notification.store') }}" method="POST" enctype="multipart/form-data"
                style="background: #fff; border: none; border-radius: 20px;"
                class="flex flex-col justify-center w-36 h-36 transition border mx-auto cursor-pointer">
                <div class="flex justify-center">
                    <img src="/images/Dish.png" alt="">
                </div>
                @csrf
                <input type="hidden" class="form-control" value="{{ $session_id }}" id="note" name="session_id">
                <button type="submit" style="font-weight: bold; color: rgba(202, 1, 71, 1);" class="mt-3 mx-auto">Gọi
                    nhân viên</button>
            </form>

            <a href="{{ route('customer.menu.index') }}" style="background: #fff; border: none; border-radius: 20px;"
                class="flex flex-col justify-center w-36 h-36 transition border mx-auto">
                <div class="flex justify-center">
                    <img src="/images/Order.png" alt="">
                </div>
                <span style="font-weight: bold; color: rgba(202, 1, 71, 1);" class="mt-3 mx-auto">Gọi món</span>
            </a>

            <!-- <a href="{{ route('customer.review.create') }}"
                        class="flex flex-col justify-center w-32 h-32 transition border mx-auto col-span-2 md:col-span-1 cursor-pointer">
                        <div class="flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M20 2H4c-1.1 0-2 .9-2 2v15.59c0 .89 1.08 1.34 1.71.71L6 18h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-6.43 9.57l-1.12 2.44a.5.5 0 0 1-.91 0l-1.12-2.44l-2.44-1.12a.5.5 0 0 1 0-.91l2.44-1.12l1.12-2.44a.5.5 0 0 1 .91 0l1.12 2.44l2.44 1.12a.5.5 0 0 1 0 .91l-2.44 1.12z" />
                            </svg>
                        </div>
                        <span class="mt-3 mx-auto">Review</span>
                    </a> -->
        </div>
    </div>
</div>
@endsection