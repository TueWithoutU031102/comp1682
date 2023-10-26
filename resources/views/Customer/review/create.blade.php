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
        <h1>Review</h1>
        <div class="input-box">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name">
        </div>

        <div class="input-box">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" class="form-control" value="{{ old('phone') }}" id="phone" name="phone">
        </div>

        <div class="input-box">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email">
        </div>

        <div class="input-box">
            <label for="foodQuality" class="form-label">Food quality:</label>

            <select name="foodQuality" value="{{ old('foodQuality') }}" class="form-select" id="foodQuality">
                @foreach ($foodQuality as $food)
                    <option value="{{ $food->value }}">{{ $food->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-box">
            <label for="serviceQuality" class="form-label">Service quality:</label>

            <select name="serviceQuality" value="{{ old('status') }}" class="form-select" id="statusMenu">
                @foreach ($serviceQuality as $service)
                    <option value="{{ $service->value }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-box">
            <label for="detail" class="form-label">Detail:</label>
            <input type="text" class="form-control" value="{{ old('detail') }}" id="detail" name="detail">
        </div>
        <div class="button-action">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="button-action">
            <a href="{{ route('customer.index') }}" class="btn btn-primary">Back</a>
        </div>
    </form>
</body>

</html>
