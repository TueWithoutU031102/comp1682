<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Show</title>
</head>

<body>
    <h1 class="display-4" style="text-align: center; font-weight: bold">TABLE INFORMATION</h1><br>
    <div class="user-card">
        <div class="submission-information">
            <p><span>Table ID: </span>{{ $table->id }}</p>
            <p><span>Name: </span>{{ $table->name }}</p>
            <a href="{{ route('manager.table.index') }}">
                <button class="btn btn-primary">Back</button>
            </a>
            <a href="{{ route('manager.table.edit', ['table' => $table]) }}" title="Edit Account"
                class="btn btn-primary btn-sm"><i aria-hidden="true"><i class="fa-solid fa-pen"></i>
            </a>
            <form action="{{ route('manager.table.destroy', ['table' => $table]) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Are you sure to delete {{ $table->name }} !!!???')">
                @csrf
                <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
    </div>
</body>

</html>
