<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Menu Form</title>
</head>

<body>
    <form action="{{ route('manager.menu.store') }}" method="POST" enctype="multipart/form-data">
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
        <h1>Add new dish</h1>
        <div class="input-box">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name">
        </div>
        <div class="input-box">
            <label for="type" class="form-label">Type</label>

            <select name="type_id" value="{{ old('type_id') }}" class="form-select" id="type">
                @foreach ($listTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-box">
            <label for="statusMenu" class="form-label">Status</label>

            <select name="status" value="{{ old('status') }}" class="form-select" id="statusMenu">
                @foreach ($listStatus as $status)
                    <option value="{{ $status->value }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-box">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" value="{{ old('price') }}" id="price" name="price">
        </div>
        <div class="input-box">
            <label for="image" class="font-weight-bold">Image</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>
        <div class="input-box">
            <label for="description" class="form-label">Description:</label>
            <input type="text" class="form-control" value="{{ old('description') }}" id="description"
                name="description">
        </div>
        <div class="button-action">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</body>

</html>
