<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Session table list</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Session table list') }}
            </h2>
        </x-slot>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
        @endif
        <br><br>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Table</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($session as $ses)
                    <tr onclick="redirectTo('{{ route('manager.checkin.show', ['session' => $ses]) }}')">
                        <td>{{ $ses->id }}</td>
                        <td>{{ $ses->name }}</td>
                        <td>{{ $ses->table->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-app-layout>
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>
</body>

</html>
