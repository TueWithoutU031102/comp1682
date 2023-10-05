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
            @if ($menu->status->value === 'Available')
                <a href="{{ route('customer.order.add', ['menu' => $menu]) }}">
                    <button class="btn btn-primary" title="Order" class="btn btn-info add">Order</button>
                </a>
            @endif
            <a href="{{ route('customer.menu.index') }}">
                <button class="btn btn-primary">Back</button>
            </a>
        </div>
    </div>
</body>

</html>
