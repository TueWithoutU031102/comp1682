<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Book Table</title>
</head>

<body>
    <form action="{{ route('customer.book.store') }}" method="POST">
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
        <h1>Book table</h1>
        <div class="input-box">
            <label for="bookName" class="form-label">Your name:</label>
            <input type="text" class="form-control" value="{{ old('bookName') }}" id="bookName" name="bookName">
        </div>
        <div class="input-box">
            <label for="phonenumber" class="form-label">Phonenumber:</label>
            <input type="text" class="form-control" value="{{ old('phonenumber') }}" id="phonenumber"
                name="phonenumber">
        </div>
        <div class="input-box">
            <label for="numberofPeople" class="form-label">Number of people:</label>
            <input type="text" id="numberofPeople" class="form-control" value="{{ old('numberofPeople') }}"
                name="numberofPeople">
        </div>

        <div class="input-box">
            <label for="arrivalTime" class="form-label">Arrival time:</label>
            <input type="datetime-local" class="form-control" value="{{ old('arrivalTime') }}" id="arrivalTime"
                name="arrivalTime">
        </div>
        <div class="input-box">
            <label for="note" class="form-label">Note:</label>
            <input type="text" class="form-control" value="{{ old('note') }}" id="note" name="note">
        </div>
        <div class="button-action">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="button-action">
            <a href="/" class="btn btn-primary">Back</a>
        </div>
    </form>
</body>

</html>
