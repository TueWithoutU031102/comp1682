<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Book Table</title>
</head>

<body class="bg-white">
    <form class="w-full max-w-lg" action="{{ route('customer.book.store') }}" method="POST">
        @csrf
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <h1 class="text-4xl text-center mt-10 font-bold mb-2">Book table</h1>
                <div class="input-box">
                    <label for="bookName"
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Your name:</label>
                    <input type="text"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        value="{{ old('bookName') }}" id="bookName" name="bookName">
                </div>
                <div class="input-box">
                    <label for="phonenumber"
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Phone:</label>
                    <input type="text"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        value="{{ old('phonenumber') }}" id="phonenumber" name="phonenumber">
                </div>
                <div class="input-box">
                    <label for="numberofPeople"
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Number of
                        people:</label>
                    <input type="number" id="numberofPeople"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        value="{{ old('numberofPeople') }}" name="numberofPeople" min="1">
                </div>

                <div class="input-box">
                    <label for="arrivalTime"
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Arrival time:</label>
                    <input type="datetime-local"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        value="{{ old('arrivalTime') }}" id="arrivalTime" name="arrivalTime">
                </div>
                <div class="input-box">
                    <label for="note"
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Note:</label>
                    <input type="text"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        value="{{ old('note') }}" id="note" name="note">
                </div>
                <div class="button-action">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Submit</button>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
