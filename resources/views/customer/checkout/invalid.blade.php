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
        <div class="card bg-base-100 max-w-sm mx-auto w-full">
            <div class="card-body">
                <h3 class="card-title text-error justify-center">Invalid Payment Request</h3>

                <p class="text-center my-3 opacity-60">There are some error while process your payment. Please try
                    again!</p>

                <div class="flex justify-center">
                    <a href="{{ route('index') }}" class="btn btn-outline">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
