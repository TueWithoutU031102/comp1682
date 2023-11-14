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
        <h1 class="text-2xl font-bold">Add new account</h1>
        <div class="form-control w-full max-w-xs">
            <label for="name" class="label-text">Name:</label>
            <input type="text" class="input input-bordered w-full max-w-xs" value="{{ old('name') }}"
                id="name" name="name">
        </div>
        <div class="form-control w-full max-w-xs">
            <label for="email" class="label-text">Email:</label>
            <input type="email" class="input input-bordered w-full max-w-xs" value="{{ old('email') }}"
                id="email" name="email">
        </div>
        <div class="form-control w-full max-w-xs">
            <label for="phone" class="label-text">Phone</label>
            <input type="text" class="input input-bordered w-full max-w-xs" value="{{ old('phone') }}"
                id="phone" name="phone">
        </div>
        <div class="form-control w-full max-w-xs">
            <label for="role" class="label-text">Role</label>

            <select name="role" value="{{ old('role') }}" class="select w-full max-w-xs" id="role">
                @foreach ($roles as $role)
                    <option value="{{ $role->value }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-control w-full max-w-xs">
            <label for="password" class="label-text">Password</label>
            <input type="password" class="input input-bordered w-full max-w-xs" value="{{ old('password') }}"
                id="password" name="password">
        </div>
        <div class="button-action">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</body>

</html>
