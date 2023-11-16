<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Menu Form</title>
</head>

<body>

    <form action="{{ route('manager.menu.update', ['menu' => $menu]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1 class="text-2xl font-bold">Edit the dish</h1>
                <input type="hidden" name="id" value="{{ $menu->id }}" name="id"
                    class="form-control w-full max-w-xs" id="id">
                <div class="form-control max-w-xs w-full max-w-xs">
                    <label for="name" class="label-text">Name:</label>
                    <input type="text" class="input input-bordered w-full max-w-xs" value="{{ $menu->name }}"
                        id="name" name="name">
                </div>
                <div class="form-control w-full max-w-xs w-full max-w-xs">
                    <label for="type" class="label-text">Type</label>

                    <select name="type_id" value="{{ $menu->type_id }}" class="select select-bordered w-full max-w-xs" id="type">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-control w-full max-w-xs w-full max-w-xs">
                    <label for="statusMenu" class="label-text">Status</label>

                    <select name="status" value="{{ $menu->status }}" class="select select-bordered w-full max-w-xs" id="status">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->value }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-control w-full max-w-xs w-full max-w-xs">
                    <label for="price" class="label-text">Price</label>
                    <input type="text" class="input input-bordered w-full max-w-xs" value="{{ $menu->price }}"
                        id="price" name="price">
                </div>
                <div class="col-span-full">
                    <label for="cover-photo" class="label-text">Cover
                        photo</label>
                    <img style=" object-fit: cover; object-position: center center; height: 50px; width: 50px;"
                        src="{{ asset($menu->image) }}">
                    <div
                        class="mt-2 flex justify-center rounded-lg border border-dashed border-white-900/25 px-6 py-10">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-white-300" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div class="mt-4 flex text-sm leading-6 text-white-600">
                                <label for="image"
                                    class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    <span>Upload a file</span>
                                    <input type="file" name="image" class="sr-only" id="image">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs leading-5 text-white-600">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                </div>
                <div class="form-control w-full max-w-xs w-full max-w-xs">
                    <label for="description" class="label-text">Description:</label>
                    <input type="text" class="input input-bordered w-full max-w-xs" value="{{ $menu->description }}"
                        id="description" name="description">
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                </div>
            </div>
        </div>
    </form>

</body>

</html>
