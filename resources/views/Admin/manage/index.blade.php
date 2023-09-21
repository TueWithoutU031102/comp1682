<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Manage Account</title>
</head>

<body>
    <h1>Manage Account</h1>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    <div class="create-btn">
        <a type="button" href="{{ route('admin.create') }}" class="btn btn-primary"
            style="font-weight: bold; font-size: 20px;">+</a>
    </div>
    <br><br>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Role</th>
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr onclick="redirectTo('{{ route('admin.show', ['user' => $user]) }}')">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
