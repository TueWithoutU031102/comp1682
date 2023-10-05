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
    <div>
        <h1 class="display-4" style="text-align: center; font-weight: bold">USER INFORMATION</h1>
        <a href="{{ route('admin.index') }}">
            <button class="btn btn-primary">Back</button>
        </a>
    </div>
    <div class="user-card">
        {{-- <img src="{{ asset($menu->image) }}"> --}}

        <div class="submission-information">
            <p><span>Name: </span>{{ $user->name }}</p>
            <p><span>Email: </span>{{ $user->email }}</p>
            <p><span>Role: </span> {{ $user->role }}</p>
            <p><span>Phone: </span>{{ $user->phone }}</p>
            <a href="{{ route('admin.edit', ['user' => $user]) }}" title="Edit Account"
                class="btn btn-primary btn-sm"><i aria-hidden="true"><i class="fa-solid fa-pen"></i>
            </a>
            <form action="{{ route('admin.destroy', ['user' => $user]) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Are you sure to delete {{ $user->name }} !!!???')">
                @csrf
                <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
    </div>
</body>

</html>
