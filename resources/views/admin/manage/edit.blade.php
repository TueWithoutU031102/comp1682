<x-app-layout>


    <div class="card bg-base-100 shadow max-w-3xl mx-auto my-5">
        <form action="{{ route('admin.update', ['user' => $user]) }}" method="POST" enctype="multipart/form-data" class="card-body">
            <h3 class="card-title">Edit the account</h3>
            @csrf

            @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" value="{{ $user->name }}" id="name" name="name" placeholder="Name" class="input input-bordered">
            </div>

            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" value="{{ $user->email }}" id="email" name="email" placeholder="Email" class="input input-bordered">
            </div>

            <div class="form-control">
                <label for="phone">Phone</label>
                <input type="text" value="{{ $user->phone }}" id="phone" name="phone" placeholder="Phone" class="input input-bordered">
            </div>

            <div class="form-control">
                <label for="role">Role</label>

                <select name="role" value="{{ old('role') }}" class="select select-bordered w-full max-w-xs" id="role">
                    @foreach ($roles as $role)
                        <option value="{{ $role->value }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" class="input input-bordered">
            </div>

            <div class="flex justify-between mt-5">
                <a href="{{ route('admin.index') }}" class="btn btn-ghost">Back</a>
                <button type="submit" class="btn btn-info">
                    <span class="text-primary">Save</span>
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
