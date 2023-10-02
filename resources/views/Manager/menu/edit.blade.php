<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Menu Form</title>
</head>

<body>
    <form action="{{ route('manager.menu.update', ['menu' => $menu]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <br>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1>Edit the dish</h1>
        <input type="hidden" name="id" value="{{ $menu->id }}" name="id" class="form-control"
            id="id">
        <div class="input-box">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" value="{{ $menu->name }}" id="name" name="name">
        </div>
        <div class="input-box">
            <label for="type" class="form-label">Type</label>

            <select name="type_id" value="{{ $menu->type_id }}" class="form-select" id="type">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-box">
            <label for="statusMenu" class="form-label">Status</label>

            <select name="status" value="{{ $menu->status }}" class="form-select" id="status">
                @foreach ($statuses as $status)
                    <option value="{{ $status->value }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-box">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" value="{{ $menu->price }}" id="price" name="price">
        </div>
        <div class="input-box">
            <label for="image" class="font-weight-bold">Image</label>
            <input type="file" name="image" class="form-control" id="image">
            <img style="width:100%; object-fit: cover; object-position: center center; height: 100px; width: 100px;;"
                src="{{ asset($menu->image) }}">
        </div>
        <div class="input-box">
            <label for="description" class="form-label">Description:</label>
            <input type="text" class="form-control" value="{{ $menu->description }}" id="description"
                name="description">
        </div>
        <div class="button-action">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="button-action">
            <a href="{{ route('manager.menu.index') }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</body>

</html>
