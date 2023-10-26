<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Manage Account</title>
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Account') }}
        </h2>
    </x-slot>

    <body>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
        @endif
        <div class="create-btn">
            <a type="button" href="{{ route('admin.create') }}" class="btn btn-primary"
                style="font-weight: bold; font-size: 20px;">+</a>
        </div>
        <br><br>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">>
                @foreach ($users as $user)
                
                    <tr onclick="redirectTo('{{ route('admin.show', ['user' => $user]) }}')">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script>
            function redirectTo(url) {
                window.location.href = url;
            }
        </script>
    </body>
</x-app-layout>

</html>
