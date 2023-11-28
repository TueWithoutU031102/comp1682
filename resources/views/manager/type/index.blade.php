<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Type') }}
            <button class="btn btn-primary btn-sm btn-square text-lg" onclick="creator.showModal()">+</button>
        </h2>
    </x-slot>

    <div class="card bg-base-100 max-w-lg mx-auto my-5">
        <div class="card-body">
            @include('components.notification')
            <div class="overflow-x-auto">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <dialog id="type{{ $type->id }}" class="modal">
                                <div class="modal-box max-w-xs">
                                    <article>
                                        <form method="dialog">
                                            <button method="dialog"
                                                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                                                X
                                            </button>
                                        </form>
                                        <h3 class="font-semibold text-lg mb-3">Category name</h3>
                                        <form method="POST" action="{{ route('manager.type.update', $type) }}">
                                            @csrf

                                            <div class="form-control">
                                                <label class="lable">Name</label>
                                                <input class="input input-bordered" type="text" name="name"
                                                    id="name" placeholder="Table name" value="{{ $type->name }}">
                                            </div>

                                            <button type="submit" class="btn btn-success mt-5">Save Status</button>
                                        </form>
                                    </article>
                                </div>
                            </dialog>
                            <tr class="hover">
                                <td>{{ $type->name }}</td>
                                <td class="flex space-x-3">
                                    <a onclick="type{{ $type->id }}.showModal()" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('manager.type.destroy', ['type' => $type]) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure to delete {{ $type->name }} !!!???')">
                                        @csrf
                                        <button class="btn btn-error btn-square btn-outline btn-sm"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <dialog id="creator" class="modal">
        <div class="modal-box">
            <article>
                <form method="dialog">
                    <button method="dialog" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                        X
                    </button>
                </form>
                <form action="{{ route('manager.type.store') }}" method="POST">
                    <h3 class="font-semibold text-lg mb-3">Add new category</h3>
                    @csrf

                    <div class="form-control">
                        <label class="lable">Name</label>
                        <input class="input input-bordered" type="text" name="name" id="name"
                            placeholder="Type name" value="{{ old('name') }}">
                    </div>

                    <button type="submit" class="btn btn-success mt-5">Create</button>
                </form>
            </article>
        </div>
    </dialog>
</x-app-layout>
