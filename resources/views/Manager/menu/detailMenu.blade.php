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
        <img src="{{ asset($dish->image) }}">
        <div class="submission-information">
            <h2>{{ $dish->name }}</h2>
            <p><span>Dish ID: </span>{{ $dish->id }}</p>
            <p><span>Name: </span>{{ $dish->name }}</p>
            <p><span>Type: </span>{{ $dish->type->name }}</p>
            <p><span>Price: </span>{{ $dish->price }}</p>
            <p><span>Description: </span>{{ $dish->description }}</p>
            <a href="/manager/menu/indexMenu">
                <button class="btn btn-primary">Back</button>
            </a>
            <a href="/manager/menu/editMenu/{{ $dish->id }}" title="Edit Account" class="btn btn-primary btn-sm"><i aria-hidden="true"><i
                        class="fa-solid fa-pen"></i>
            </a>
            <form action="/manager/menu/deleteMenu/{{ $dish->id }}" method="POST" class="d-inline"
                onsubmit="return confirm('Are you sure to delete {{ $dish->name }} !!!???')">
                @csrf
                <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
    </div>
</body>

</html>
