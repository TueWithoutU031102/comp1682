<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Review Form</title>
    {{-- {{ route('customer.review.store') }} --}}
</head>

<body>
    <form action="{{ route('customer.review.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="text-2xl font-bold">Review</h1>
        <div class="form-control w-full max-w-xs">
            <label for="name" class="label-text">Name:</label>
            <input type="text" class="input input-bordered w-full max-w-xs" value="{{ old('name') }}"
                id="name" name="name">
        </div>

        <div class="form-control w-full max-w-xs">
            <label for="phone" class="label-text">Phone:</label>
            <input type="text" class="input input-bordered w-full max-w-xs" value="{{ old('phone') }}"
                id="phone" name="phone">
        </div>

        <div class="form-control w-full max-w-xs">
            <label for="email" class="label-text">Email:</label>
            <input type="email" class="input input-bordered w-full max-w-xs" value="{{ old('email') }}"
                id="email" name="email">
        </div>

        <div class="form-control w-full max-w-xs">
            <label for="foodQuality" class="label-text">Food quality:</label>

            <select name="foodQuality" value="{{ old('foodQuality') }}" class="select w-full max-w-xs" id="foodQuality">
                @foreach ($foodQuality as $food)
                    <option value="{{ $food->value }}">{{ $food->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-control w-full max-w-xs">
            <label for="serviceQuality" class="label-text">Service quality:</label>

            <select name="serviceQuality" value="{{ old('status') }}" class="select w-full max-w-xs" id="statusMenu">
                @foreach ($serviceQuality as $service)
                    <option value="{{ $service->value }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-control w-full max-w-xs">
            <label for="detail" class="label-text">Detail:</label>
            <input type="text" class="input input-bordered w-full max-w-xs" value="{{ old('detail') }}"
                id="detail" name="detail">
        </div>
        <div class="button-action">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</body>

</html>
