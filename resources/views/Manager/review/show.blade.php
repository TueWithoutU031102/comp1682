<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Detail review</title>
</head>

<body>
    <h1 class="display-4" style="text-align: center; font-weight: bold">Detail review</h1><br>
    <div class="user-card">
        <div class="submission-information">
            <h2>{{ $review->name }}</h2>
            <p><span>Review ID: </span>{{ $review->id }}</p>
            <p><span>Name: </span>{{ $review->name }}</p>
            <p><span>Phone: </span>{{ $review->phone }}</p>
            <p><span>Food quality: </span> {{ $review->foodQuality }}</p>
            <p><span>Service quality: </span>{{ $review->serviceQuality }}</p>
            <p><span>Description: </span>{{ $review->detail }}</p>
            <a href="{{ route('manager.review.index') }}">
                <button class="btn btn-primary">Back</button>
            </a>
            <form action="{{ route('manager.review.destroy', ['review' => $review]) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Are you sure to delete this review !!!???')">
                @csrf
                <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
    </div>
</body>

</html>
