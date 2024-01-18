<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.2/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="bg-base-200 min-h-screen pt-10">

        <div class="flex justify-center">
            <div class="avatar mx-auto my-3">
                <div class="w-20 mask mask-squircle">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </div>
            </div>
        </div>

        <div class="card bg-base-100 max-w-xl mx-auto w-full shadow">
            <div class="card-body">
                <h3 class="card-title">Thank you for using our services</h3>

                <p class="text-success text-center">Your payment number # is process sucessfully. We
                    hope see you in next time.</p>

                <div class="grid grid-cols-2">
                    <p class="mt-3 font-light text-xl">
                        Total: <span class="text-primary font-bold"></span>đ
                    </p>
                    <div>
                        <button class="btn float-right" disabled>Already Paid</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="max-w-xl mx-auto mt-3">
            <a href="{{ route('index') }}" class="btn btn-ghost">
                < Go Back</a>
        </div>
    </div>
</body>

</html>
