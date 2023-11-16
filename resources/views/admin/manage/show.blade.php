<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Detail</title>
</head>

<body class="p-5">
    <div>
        <h1 class="text-3xl mb-5 text-center">USER INFORMATION</h1>
    </div>
    <div class="user-card">
        <div class="submission-information">
            <p class="block mb-1">
                <span class="mb-1 font-bold">Name: </span>
                {{ $user->name }}
            </p>
            <p class="block mb-1">
                <span class="mb-1 font-bold">Email: </span>
                {{ $user->email }}
            </p>
            <p class="block mb-1">
                <span class="mb-1 font-bold">Role: </span>
                {{ $user->role }}
            </p>
            <p class="block mb-1">
                <span class="mb-1 font-bold">Phone: </span>
                {{ $user->phone }}
            </p>

            <div class="flex space-x-3 mt-5">
                <a href="{{ route('admin.edit', ['user' => $user]) }}" title="Edit Account"
                    class="btn btn-outline btn-info"><i aria-hidden="true"><i class="fa-solid fa-pen"></i>
                </a>

                <form action="{{ route('admin.destroy', ['user' => $user]) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Are you sure to delete {{ $user->name }} !!!???')">
                    @csrf
                    <button class="btn btn-outline btn-error"><i aria-hidden="true"><i
                                class="fa-solid fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
