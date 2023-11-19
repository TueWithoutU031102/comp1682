@extends('layouts.bill')

@section('content')

<div class="card bg-base-100 max-w-xl mx-auto my-10 shadow w-full">
    <div class="card-body">
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

            <div class="form-control mt-3">
                <label for="name" class="label-text">Name:</label>
                <input type="text" class="input input-bordered" value="{{ old('name') }}"
                    id="name" name="name">
            </div>
            <div class="form-control mt-3">
                <label for="phone" class="label-text">Phone:</label>
                <input type="text" class="input input-bordered" value="{{ old('phone') }}"
                    id="phone" name="phone">
            </div>
            <div class="form-control mt-3">
                <label for="email" class="label-text">Email:</label>
                <input type="email" class="input input-bordered" value="{{ old('email') }}"
                    id="email" name="email">
            </div>
            <div class="form-control mt-3">
                <label for="foodQuality" class="label-text">Food quality:</label>
        
                <select name="foodQuality" value="{{ old('foodQuality') }}" class="select select-bordered" id="foodQuality">
                    @foreach ($foodQuality as $food)
                        <option value="{{ $food->value }}">{{ $food->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-control mt-3">
                <label for="serviceQuality" class="label-text">Service quality:</label>
        
                <select name="serviceQuality" value="{{ old('status') }}" class="select select-bordered" id="statusMenu">
                    @foreach ($serviceQuality as $service)
                        <option value="{{ $service->value }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-control mt-3">
                <label for="detail" class="label-text">Detail:</label>
                <input type="text" class="input input-bordered" value="{{ old('detail') }}"
                    id="detail" name="detail">
            </div>
            <div class="flex justify-between mt-5">
                <a href="{{ route('customer.index') }}" class="btn btn-ghost">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
