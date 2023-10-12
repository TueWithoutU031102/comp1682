<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Menu</title>
</head>

<body>
    <h1>Menu</h1>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    <div class="create-btn">
        <a type="button" href="{{ route('manager.menu.create') }}" class="btn btn-primary"
            style="font-weight: bold; font-size: 20px;">+</a>
    </div>
    <br><br>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
                <tr onclick="redirectTo('{{ route('manager.menu.show', ['menu' => $menu]) }}')">
                    <td>
                        <ul class="img">
                            <li>
                                <img style="width: 600px;height: 400px" src="{{ asset($menu->image) }}"
                                    alt="Menu Image">
                            </li>
                        </ul>
                    </td>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->type->name }}</td>
                    <td>{{ $menu->status }}</td>
                    <td>{{ $menu->price }}</td>
                    <td>{{ $menu->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>
