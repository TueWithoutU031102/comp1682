<x-app-layout>
    <div class="card bg-base-100 shadow my-5 max-w-lg mx-auto">
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="card-body">
            @csrf
            <h3 class="card-title">Create Account</h3>

            @if ($errors->any())
                <div class="alert alert-danger my-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" value="{{ old('name') }}" id="name" name="name" placeholder="Name"
                    class="input input-bordered">
            </div>

            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" value="{{ old('email') }}" id="email" name="email" placeholder="Email"
                    class="input input-bordered">
            </div>

            <div class="form-control">
                <label for="phone">Phone</label>
                <input type="text" value="{{ old('phone') }}" id="phone" name="phone" placeholder="Phone"
                    class="input input-bordered">
            </div>

            <div class="form-control">
                <label for="role">Role</label>

                <select name="role" value="{{ old('role') }}" class="select select-bordered w-full" id="role">
                    @foreach ($roles as $role)
                        <option value="{{ $role->value }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password"
                    class="input input-bordered">
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
