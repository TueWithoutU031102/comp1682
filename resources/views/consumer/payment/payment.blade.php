@extends('layouts.checkout')

@section('content')
    <div class="min-h-screen grid place-content-center bg-base-200">

        <div>
            <div class="card max-w-xl bg-base-100 rounded-none shadow-lg">
                <div class="card-body">
                    <h3 class="card-title">Please scan QR bellow to Pay!</h3>

                    <div class="flex justify-center">
                        <img class="aspect-square w-2/3"
                            src="https://homepage.momocdn.net/blogscontents/momo-upload-api-220810110042-637957260425550228.webp">
                    </div>

                    <div class="divider">Order Info</div>

                    <table class="table text-lg font-medium">
                        <tr>
                            <td class="opacity-60">Order Number</td>
                            <td>#7749</td>
                        </tr>
                        <tr>
                            <td class="opacity-60">Session Time</td>
                            <td>19:59</td>
                        </tr>
                        <tr>
                            <td class="opacity-60">Holder</td>
                            <td>Telecom Asia</td>
                        </tr>
                        <tr>
                            <td class="opacity-60">Total Price</td>
                            <td>420.690 đ</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-5">
                <a href="{{ route('customer.index') }}" class="btn btn-sm btn-outline rounded-none">Go Back</a>
            </div>
        </div>

    </div>
@endsection
