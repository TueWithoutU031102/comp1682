<x-app-layout>
    <div class="card bg-base-100 max-w-xl mx-auto my-5">
        <div class="card-body">
            <h2 class="card-title">Edit the dish</h2>
            @include('components.notification')

            <form action="{{ route('manager.menu.update', ['menu' => $menu]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-control">
                    <label class="label">Name</label>
                    <input type="text" class="input input-bordered" value="{{ $menu->name }}" name="name">
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div class="form-control">
                        <label class="label">Type</label>
                        <select name="type_id" class="select select-bordered w-full max-w-xs">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ $menu->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-control">
                        <label class="label">Status</label>
                        <select name="status" class="select select-bordered w-full max-w-xs">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->value }}" {{ $menu->status == $status->value ? 'selected' : '' }}>{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-control">
                    <label class="label">Price</label>
                    <input type="text" class="input input-bordered" value="{{ $menu->price }}" name="price">
                </div>

                <div class="form-control">
                    <label class="label">Description</label>
                    <input type="text" class="input input-bordered" value="{{ $menu->description }}" name="description">
                </div>

                <div class="form-control">
                    <label class="label">Avatar</label>
                    <input id="file" class="hidden" name="image" type="file" accept="image/*">

                    <div class="avatar relative cursor-pointer" onclick="file.click()">
                        <div class="max-w-xs aspect-square object-cover rounded mx-auto relative" >
                            <div id="remover" class="btn btn-error btn-circle btn-sm absolute top-2 right-2 ring-2 ring-white" style="display: none">
                                <i class="fa-solid fa-times"></i>
                            </div>
                            <img id="avatar" src="{{ asset($menu->image) }}" alt="" data-origin="{{ asset($menu->image) }}">
                        </div>
                    </div>
                </div>

                <div class="flex justify-between mt-5">
                    <a href="{{ route('manager.menu.index') }}" class="btn btn-ghost">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div class="py-10"></div>

<script>

window.addEventListener('load', () => {
  const file = document.getElementById('file');
  const remover = document.getElementById('remover');
  const avatar = document.getElementById('avatar');

  file.addEventListener('change', (e) => {
    const [upload] = e.target.files;
    const link = URL.createObjectURL(upload);
    avatar.src = link;
    remover.style.display = '';
  })

  remover.addEventListener('click', (e) => {
    e.stopImmediatePropagation();
    e.preventDefault();
    avatar.src = avatar.dataset.origin;
    remover.style.display = 'none';
    file.value = ''
  })
})

</script>
</x-app-layout>
