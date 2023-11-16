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
    <h1 class="display-4" style="text-align: center; font-weight: bold">DISH INFORMATION</h1>
    <div class="user-card">
        <img src="{{ asset($menu->image) }}">
        <div class="submission-information">
            <h2>{{ $menu->name }}</h2>
            <p><span>Dish ID: </span>{{ $menu->id }}</p>
            <p><span>Name: </span>{{ $menu->name }}</p>
            <p><span>Type: </span>{{ $menu->type->name }}</p>
            <p><span>Status: </span> {{ $menu->status }}</p>
            <p><span>Quantity sold: </span> {{ $menu->saled }}</p>
            <p><span>Price: </span>{{ $menu->price }}</p>
            <p><span>Description: </span>{{ $menu->description }}</p>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="{{ route('manager.menu.edit', ['menu' => $menu]) }}" title="Edit Account"
                    class="btn btn-outline btn-success"><i aria-hidden="true"><i class="fa-solid fa-pen"></i>
                </a>
                <form action="{{ route('manager.menu.destroy', ['menu' => $menu]) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Are you sure to delete {{ $menu->name }} !!!???')">
                    @csrf
                    <button class="btn btn-outline btn-error"><i aria-hidden="true"><i
                                class="fa-solid fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
