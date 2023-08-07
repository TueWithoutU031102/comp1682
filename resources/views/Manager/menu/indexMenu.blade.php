<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Menu</title>
</head>

<body>
    <h1>Menu</h1>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    <div class="create-btn">
        <a type="button" href="/manager/menu/formMenu" class="btn btn-primary"
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
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
                <tr>
                    <td>
                        <ul class="img">
                            <li>
                                <img style="width: 600px;height: 400px" src="{{ asset($menu->image) }}">
                            </li>
                        </ul>
                    </td>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->type->name }}</td>
                    <td>{{ $menu->statusMenu->name }}</td>
                    <td>{{ $menu->price }}</td>
                    <td>{{ $menu->description }}</td>
                    <td>
                        <a href="/manager/menu/detailMenu/{{ $menu->id }}" title="View Profile"
                            class="btn btn-info btn-sm"><i aria-hidden="true"><i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
