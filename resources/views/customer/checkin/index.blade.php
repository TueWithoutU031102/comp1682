<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Login customer</title>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <img class="w-20 h-20 fill-current text-gray-500" src="/images/logo.png" alt="">
        </div>
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form class="space-y-6" action="{{ route('customer.checkin.store', ['table' => $table]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Your
                        name:</label>
                    <input placeholder="Name"
                        class="border border-gray-300 dark:border-gray-700 dark:bg-gray-900 py-2 px-3 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full "
                        type="text" id="name" name="name">
                    @if ($errors->any())
                        <div class="text-sm text-red-600 dark:text-red-400 space-y-1 mt-2">
                            <ul>
                                @foreach ($errors->get('name') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Phone
                        number:</label>
                    <input placeholder="Phone number"
                        class="border border-gray-300 dark:border-gray-700 dark:bg-gray-900 py-2 px-3 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                        type="text" id="phone" name="phone" required="required" autofocus="autofocus">
                    @if ($errors->any())
                        <div class="text-sm text-red-600 dark:text-red-400 space-y-1 mt-2">
                            <ul>
                                @foreach ($errors->get('phone') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="mt-4">
                    <div class="input-box" hidden>
                        <input type="text" class="form-control" value="{{ $table->id }}" id="table_id"
                            name="table_id">
                    </div>
                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-gray-800 dark:bg-gray-200 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 button-action">Receive table</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
