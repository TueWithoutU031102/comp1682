<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Detail</title>
</head>

<body>
    <h1 class="display-4" style="text-align: center; font-weight: bold">SESSION TABLE INFORMATION</h1><br>
    <div class="user-card">
        <div class="submission-information">
            <h2>{{ $session->name }}</h2>
            <p><span>ID: </span>{{ $session->id }}</p>
            <p><span>Name: </span>{{ $session->name }}</p>
            <p><span>Table: </span>{{ $session->table->name }}</p>
            <form action="{{ route('manager.checkin.destroy', ['session' => $session]) }}" method="POST"
                class="d-inline" onsubmit="return confirm('Are you sure to delete {{ $session->name }} !!!???')">
                @csrf
                <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
    </div>
</body>

</html>
