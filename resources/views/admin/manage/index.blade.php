@php
    $title = 'Manage Account';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Dashboard') }}
        </h2>
    </x-slot>

    <div class="card shadow bg-base-100 max-w-4xl mx-auto mt-5">
        <div class="card-body">
            <h3 class="card-title">
                Manage role
                <a href="{{ route('admin.create') }}" class="btn btn-primary btn-sm btn-square text-lg">+</a>
            </h3>

            @if (Session::has('success'))
                <div class="alert alert-success py-3" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                </div>
            @endif

            <div class="overflow-x-auto mt-3">
                <table class="table table-zebra">
                    <thead>
                        <tr class="font-semibold">
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="user_data">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <div class="flex space-x-3">
                                        <a class="btn btn-sm btn-circle btn-info btn-outline"
                                            href="{{ route('admin.edit', $user) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if ($user->role->name !== 'Admin')
                                            <form class="delete-user" action="{{ route('admin.destroy', $user) }}"
                                                method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-circle btn-error btn-outline">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <x-slot name="scripts">
        <script>
            window.addEventListener('load', () => {
                for (const form of document.querySelectorAll('.delete-user')) {
                    form.addEventListener('submit', e => {
                        e.preventDefault()
                        if (confirm('Are you sure you want to delete this user?')) {
                            form.submit()
                        }
                    })
                }
            })
        </script>
    </x-slot>
</x-app-layout>
