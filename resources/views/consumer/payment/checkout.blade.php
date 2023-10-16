@extends('layouts.checkout')

@section('content')
<div class="min-h-screen bg-base-200">

  <div class="grid grid-cols-1 lg:grid-cols-2 py-10 gap-10">

    <div>
      <div class="card max-w-lg w-full mx-auto lg:mr-0 lg:ml-auto bg-base-100 rounded-none">
        <div class="card-body">
          <h3 class="card-title">Select Payment Method</h3>
          <div class="divider"></div>
  
          <div class="flex flex-col space-y-3">
            <label class="label justify-start border border-gray-300 px-5 cursor-pointer rounded">
              <input type="radio" name="method" class="radio mr-5"> Cash
            </label>
  
            <label class="label justify-start border border-gray-300 px-5 cursor-pointer rounded">
              <input type="radio" name="method" class="radio mr-5"> Momo
            </label>
  
  
            <label class="label justify-start border border-gray-300 px-5 cursor-pointer rounded">
              <input type="radio" name="method" class="radio mr-5"> Credit/Debit Card
            </label>
  
            <label class="label justify-start border border-gray-300 px-5 cursor-pointer rounded">
              <input type="radio" name="method" class="radio mr-5"> ATM Card
            </label>
  
            <label class="label justify-start border border-gray-300 px-5 cursor-pointer rounded">
              <input type="radio" name="method" class="radio mr-5"> Bank Transfer
            </label>
          </div>
  
          <button class="btn btn-info rounded-none mt-5">Continue</button>
        </div>
      </div>
    </div>

    <div class="card max-w-lg w-full mx-auto lg:ml-0 bg-base-100 rounded-none">
      <div class="card-body">
        <h3 class="card-title">Order sumary</h3>
        <div class="divider"></div>

        <div class="flex flex-col space-y-3">

          @foreach (range(1,6) as $item)
          <div class="rounded flex space-x-3 bg-white p-2">
            <img class="aspect-square w-16 h-16 rounded" src="https://picsum.photos/200" alt="">
            <div>
              <p>The product one from anon, and one other</p>

              <div class="flex justify-between mt-2">
                <span class="text-red-500">69.420 đ</span>
              </div>
            </div>
          </div>
          @endforeach
        </div>


        <div>
          <hr class="border-t h-1 border-black border-dashed w-full my-2">
          <div class="flex justify-between">
            <span class="text-xl">Total price:</span>
            <span class="text-xl">69.420 đ</span>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
