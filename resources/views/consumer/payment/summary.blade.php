@extends('layouts.checkout')

@section('content')
<div class="min-h-screen grid place-content-center bg-base-200">

  <div class="-mt-24">
    <div class="card max-w-xl bg-base-100 rounded-none shadow-lg">
      <div class="card-body">
        <h3 class="card-title justify-center text-3xl">Order Success!</h3>
      
        <p class="text-center opacity-70 text-lg mt-5">Thank you! Your order has been successfully placed, we looking forward to you next time.</p>
        <div class="divider opacity-70 text-info">Order Number</div>

        <span class="text-center text-4xl font-light">#4893</span>

        <div class="text-center mt-7">
          <button class="btn">Back To Home</button>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection
