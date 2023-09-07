<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Detail</title>
</head>

<body>
    <h1 class="display-4" style="text-align: center; font-weight: bold">DISH INFORMATION</h1><br>
    <div class="user-card">
        <img src="{{ asset($menu->image) }}">
        <div class="submission-information">
            <h2>{{ $menu->name }}</h2>
            <p><span>Dish ID: </span>{{ $menu->id }}</p>
            <p><span>Name: </span>{{ $menu->name }}</p>
            <p><span>Type: </span>{{ $menu->type->name }}</p>
            <p><span>Status: </span> {{ $menu->status }}</p>
            <p><span>Price: </span>{{ $menu->price }}</p>
            <p><span>Description: </span>{{ $menu->description }}</p>
            <a href="{{ route('manager.menu.index') }}">
                <button class="btn btn-primary">Back</button>
            </a>
            <a href="{{ route('manager.menu.edit', ['menu' => $menu]) }}" title="Edit Account"
                class="btn btn-primary btn-sm"><i aria-hidden="true"><i class="fa-solid fa-pen"></i>
            </a>
            <form action="{{ route('manager.menu.destroy', ['menu' => $menu]) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Are you sure to delete {{ $menu->name }} !!!???')">
                @csrf
                <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
    </div>
</body>

</html>
