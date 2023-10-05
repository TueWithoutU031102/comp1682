<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Create Account</title>
</head>

<body>
    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
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
        <h1>Add new account</h1>
        <div class="input-box">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name">
        </div>
        <div class="input-box">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email">
        </div>
        <div class="input-box">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" value="{{ old('phone') }}" id="phone" name="phone">
        </div>
        <div class="input-box">
            <label for="role" class="form-label">Role</label>

            <select name="role" value="{{ old('role') }}" class="form-select" id="role">
                @foreach ($roles as $role)
                    <option value="{{ $role->value }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-box">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" value="{{ old('password') }}" id="password" name="password">
        </div>
        {{-- <div class="input-box">
            <label for="image" class="font-weight-bold">Image</label>
            <input type="file" name="image" class="form-control" id="image">
        </div> --}}
        <div class="button-action">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="button-action">
            <a href="{{ route('admin.index') }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</body>

</html>
