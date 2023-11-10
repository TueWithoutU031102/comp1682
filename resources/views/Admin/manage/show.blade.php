<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/heroicons@4.0.0/dist/css/material.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Detail</title>
</head>

<body>
    <div>
        <h1 class="text-3xl mb-5" style="text-align: center; font-weight: bold">USER INFORMATION</h1>
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
            <div class="btn-group">
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
