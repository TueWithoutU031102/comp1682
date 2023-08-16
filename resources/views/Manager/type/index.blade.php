<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Type</title>
</head>

<body>
    <h1>Type</h1>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    <div class="create-btn">
        <a type="button" href="{{ route('manager.type.create') }}" class="btn btn-primary"
            style="font-weight: bold; font-size: 20px;">+</a>
    </div>
    <br><br>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td>{{ $type->name }}</td>
                    <td>
                        <a href="{{ route('manager.type.edit', ['type' => $type]) }}" title="Edit"
                            class="btn btn-primary btn-sm"><i aria-hidden="true"><i class="fa-solid fa-pen"></i>
                        </a>
                        <form action="{{ route('manager.type.destroy', ['type' => $type]) }}" method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Are you sure to delete {{ $type->name }} !!!???')">
                            @csrf
                            <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i
                                        class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
