<x-app-layout>
    <div class="card bg-base-100 shadow max-w-lg mx-auto my-5">
        <form action="{{ route('manager.table.update', $table) }}" method="POST" class="card-body">
            <h3 class="card-title mb-3">Edit the Table</h3>
            @csrf

            @include('components.notification')

            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" value="{{ $table->name }}" id="name" name="name" placeholder="Name" class="input input-bordered">
            </div>

            <div class="flex justify-between mt-5">
                <a href="{{ route('manager.table.index') }}" class="btn btn-ghost">Back</a>
                <button type="submit" class="btn btn-info">
                    <span class="text-primary">Save</span>
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
