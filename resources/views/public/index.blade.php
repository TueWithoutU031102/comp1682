
@extends('layouts.landing')

@section('content')
<div class="bg-white py-10">
  <div class="container">
    {{-- small banner --}}
  
    <h2 class="text-center mt-10">Cafe và Trà</h2>
  
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-7">
      <img class="aspect-[16/10] object-cover w-full col-span-2 shadow rounded" src="https://picsum.photos/800" alt="">
  
      @foreach (range(1, 6) as $index)
      <div>
        <div class="transition rounded hover:shadow-md hover:scale-105 duration-300">
          <img class="aspect-square object-cover w-full rounded" src="https://picsum.photos/800?i={{ $index }}" alt="">
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

<div class="container py-10">
  <h2 class="text-center">Các món ăn</h2>
  <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mt-5">
    @foreach (range(1, 8) as $index)
    <div>
      <div class="relative overflow-hidden transition hover:shadow-md duration-300 shadow rounded :[&>img]:rounded">
        @if ($index == 1)
        <div class="absolute px-5 py-2 bg-yellow-400 top-5 rounded-r-full z-[1] shadow">Best Seller</div>
        @endif
        <img class="aspect-square object-cover w-full transition duration-500 hover:scale-125" src="https://picsum.photos/800?i={{ $index }}" alt="">
      </div>
      <p class="flex flex-col p-2">
        <strong>Cafe Đen Đá</strong>
        <span class="opacity-50 text-sm">49.000 đ</span>
      </p>
    </div>
    @endforeach
  </div>
</div>

<div class="bg-yellow-50">
  <div class="container py-10">
    <h2 class="text-center">Những câu chuyện</h2>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5 gap-y-10">

      @foreach (range(1, 6) as $item)
      <div>
        <img class="aspect-[10/5] rounded object-cover w-full ring-offset-2 ring-1" src="https://picsum.photos/800" alt="">

        <h3 class="text-lg text-black opacity-90 mt-2 mb-0">Title of a post here</h3>
        <p class="text-sm mt-3 opacity-60">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, repellendus facilis? Adipisci incidunt minus veritatis iure doloremque ut eum ipsam nemo dolorum repellendus dolore, accusamus iusto optio laudantium nobis beatae.
        </p>
      </div>
      @endforeach

    </div>
  </div>
</div>


<dialog id="modal">
  <article>
    <form method="dialog">
      <a href="javascript:void(0)" class="close" onclick="modal.close()"></a>
    </form>

    <h3>Form Booking</h3>
    <p>
      Cras sit amet maximus risus. 
      Pellentesque sodales odio sit amet augue finibus pellentesque. 
      Nullam finibus risus non semper euismod.
    </p>

    <footer>
      <form class="inline-block" method="dialog">
        <button>Close</button>
      </form>
    </footer>
  </article>
</dialog>
@endsection


@push('scripts')
<script>
setTimeout(() => modal.showModal(), 2000);
</script>
@endpush
