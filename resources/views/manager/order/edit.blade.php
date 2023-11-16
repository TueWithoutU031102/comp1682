<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Edit status</title>
</head>

<body>
    <form method="POST" action="{{ route('manager.order.update', ['cart' => $cart]) }}">
        @method('PUT')
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h1 class="text-2xl font-bold">Edit status order</h1>
                <label for="StatusDish" class="block text-sm font-medium leading-6">Status</label>
                <label for="name" class="block text-sm font-medium leading-6">{{ $cart->id }}</label>
                <div class="form-control w-full max-w-xs w-full max-w-xs">
                    <select name="status" value="{{ $cart->status }}"
                        class="select select-bordered w-full max-w-xs"
                        id="status">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->value }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
