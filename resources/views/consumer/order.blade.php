
@extends('layouts.consumer')

@section('content')
<div class="px-3">
  <div class="py-10">
    <div class="container">
      {{-- small banner --}}
    
      <h2 class="text-center my-5 text-3xl font-bold">Cafe và Trà</h2>
    
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-7">
        <img class="aspect-[16/10] object-cover w-full col-span-2 shadow rounded" src="https://picsum.photos/800" alt="">
    
        @foreach (range(1, 6) as $index)
        <div>
          <div class="transition rounded hover:shadow-md hover:scale-105 duration-300">
            <img class="aspect-square object-cover w-full rounded" src="https://picsum.photos/800?i={{ $index }}" alt="">
            <button class="absolute bottom-3 right-3 btn btn-circle btn-warning btn-sm opacity-90">+</button>
          </div>
          <p class="flex flex-col p-2">
            <strong>Cafe Đen Đá</strong>
            <span class="opacity-50 text-sm">49.000 đ</span>
          </p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  
  <div class="py-10">
    <h2 class="text-center my-5 text-3xl font-bold">Các món ăn</h2>
    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mt-5">
      @foreach (range(1, 8) as $index)
      <div>
        <div class="relative overflow-hidden transition hover:shadow-md duration-300 shadow rounded :[&>img]:rounded">
          @if ($index == 1)
          <div class="absolute px-5 py-2 bg-yellow-400 top-5 rounded-r-full z-[1] shadow">Best Seller</div>
          @endif
          <img class="aspect-square object-cover w-full transition duration-500 hover:scale-125" src="https://picsum.photos/800?i={{ $index }}" alt="">
          
          <button class="absolute bottom-3 right-3 btn btn-circle btn-warning btn-sm opacity-90">+</button>
        </div>
        <p class="flex flex-col p-2">
          <strong>Cafe Đen Đá</strong>
          <span class="opacity-50 text-sm">49.000 đ</span>
        </p>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
