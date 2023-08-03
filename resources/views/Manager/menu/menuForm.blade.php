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
    <form action="createMenu" method="POST" enctype="multipart/form-data">
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
        <div class="button-action">
            <a href="/manager/menu/indexMenu" class="btn btn-primary">Back</a>
        </div>
    </form>
</body>

</html>
