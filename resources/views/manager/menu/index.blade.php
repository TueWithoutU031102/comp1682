<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menu') }}
            <a href="{{ route('manager.menu.create') }}" class="btn btn-square btn-sm btn-primary">
                <i class="fa-solid fa-plus"></i>
            </a>
        </h2>
    </x-slot>

    <div class="space-y-5 mt-5 pb-10">
        <div class="max-w-6xl mx-auto">
            @include('components.notification')
        </div>

        @foreach ($types as $type)
            <div class="card bg-base-100 max-w-6xl mx-auto shadow hover:shadow-2xl transition-shadow duration-300">
                <div class="card-body">
                    <h3 class="card-title">{{ $type->name }}</h3>

                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <tr>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Quantity</th>
                                <th>Sold</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($type->menus as $menu)
                                <tr class="hover">
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="mask mask-squircle w-12 h-12">
                                                    <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold">{{ $menu->name }}</div>
                                                <div class="text-sm text-red-500 opacity-80">
                                                    {{ number_format($menu->price) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge">{{ $menu->status }}</span>
                                    </td>
                                    <td>{{ $menu->quantity }}</td>
                                    <td>{{ $menu->saled }}</td>
                                    <td>{{ $menu->description }}</td>
                                    <td>
                                        <div class="flex space-x-3">
                                            <a href="{{ route('manager.menu.edit', $menu) }}"
                                                class="btn btn-outline btn-square btn-sm">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <form action="{{ route('manager.menu.destroy', $menu) }}" method="POST"
                                                onclick="return confirm('Are you sure to delete this?')">
                                                @csrf
                                                <button type="submit" class="btn btn-error btn-sm btn-square">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
