<x-app-layout>
    <div class="card bg-base-100 max-w-xl mx-auto my-5">
        <div class="card-body">
            <h2 class="card-title">Create new menu</h2>
            @include('components.notification')

            <form action="{{ route('manager.menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-control">
                    <label class="label">Name</label>
                    <input type="text" class="input input-bordered" value="{{ old('name') }}" name="name">
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div class="form-control">
                        <label class="label">Type</label>
                        <select name="type_id" class="select select-bordered w-full max-w-xs">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-control">
                        <label class="label">Status</label>
                        <select name="status" class="select select-bordered w-full max-w-xs">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->value }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label">Quantity</label>
                    <input type="number" class="input input-bordered" value="{{ old('quantity') }}" name="quantity">
                </div>

                <div class="form-control">
                    <label class="label">Price</label>
                    <input type="text" class="input input-bordered" value="{{ old('price') }}" name="price">
                </div>

                <div class="form-control">
                    <label class="label">Description</label>
                    <input type="text" class="input input-bordered" value="{{ old('description') }}" name="description">
                </div>

                <div class="form-control">
                    <label class="label">Avatar</label>
                    <input id="file" class="hidden" name="image" type="file" accept="image/*">

                    <div class="avatar relative cursor-pointer" onclick="file.click()" style="display: none">
                        <div class="max-w-xs aspect-square object-cover rounded mx-auto relative" >
                            <div id="remover" class="btn btn-error btn-circle btn-sm absolute top-2 right-2 ring-2 ring-white">
                                <i class="fa-solid fa-times"></i>
                            </div>
                            <img id="avatar" alt="">
                        </div>
                    </div>

                    <div class="uploader grid place-content-center border border-dashed border-white-900/25 rounded-md p-5 cursor-pointer" onclick="file.click()">
                        <div class="text-center">
                            <p class="text-5xl mb-3">
                                <i class="fa-solid fa-cloud-upload"></i>
                            </p>
                            <p><span class="link">Upload a file</span> or drag and drop</p>
                            <p class="text-sm">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between mt-5">
                    <a href="{{ route('manager.menu.index') }}" class="btn btn-ghost">Back</a>
                    <button type="submit" class="btn btn-success">Create</button>
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
  const uploader = document.querySelector('.uploader');
  const container = document.querySelector('.avatar');

  file.addEventListener('change', (e) => {
    const [upload] = e.target.files;
    const link = URL.createObjectURL(upload);
    uploader.style.display = 'none';
    avatar.src = link;
    container.style.display = '';
  })

  remover.addEventListener('click', (e) => {
    e.stopImmediatePropagation();
    e.preventDefault();
    uploader.style.display = '';
    avatar.src = '';
    file.value = '';
    container.style.display = 'none';

  })
})

</script>
</x-app-layout>
