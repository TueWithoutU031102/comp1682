<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Type Form</title>
</head>

<body>
    <form action="{{ route('manager.type.update', ['type' => $type]) }}" method="POST">
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
        <h1>Edit type</h1>
        <input type="hidden" name="id" value="{{ $type->id }}" name="id" class="form-control"
            id="id">
        <div class="input-box">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" value="{{ $type->name }}" id="name" name="name">
        </div>
        <div class="button-action">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="button-action">
            <a href="{{ route('manager.type.index') }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</body>

</html>
