<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit The Account</title>
</head>

<body>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <form action="{{ route('admin.update', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">
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
                <h1 class="text-4xl text-center mt-10 font-bold mb-2">Edit the account</h1>
                <input type="hidden" name="id" value="{{ $user->id }}" name="id" class="form-control"
                    id="id">
                <div class="input-box">
                    <label for="name"
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name:</label>
                    <input type="text"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        value="{{ $user->name }}" id="name" name="name">
                </div>
                <div class="input-box">
                    <label for="email"
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Email:</label>
                    <input type="email"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        value="{{ $user->email }}" id="email" name="email">
                </div>
                <div class="input-box">
                    <label for="phone"
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Phone</label>
                    <input type="text"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        value="{{ $user->phone }}" id="phone" name="phone">
                </div>
                <div class="input-box">
                    <label for="role"
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Role</label>

                    <select name="role" value="{{ old('role') }}" class="select select-bordered w-full max-w-xs"
                        id="role">
                        @foreach ($roles as $role)
                            <option value="{{ $role->value }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-box">
                    <label for="password" class="form-label">Password</label>
                    <input type="password"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="password" name="password">
                </div>
                <div class="button-action">
                    <button type="submit" class="btn btn-outline btn-info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
