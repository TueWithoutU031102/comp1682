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
            <img src="https://placehold.co/400" alt="">
          </div>
        </div>
    </div>

    <div class="card bg-base-100 max-w-xl mx-auto w-full shadow">
      <div class="card-body">
        <h3 class="card-title">Thank you for using our services</h3>

        <p class="text-success text-center">Your payment number ##### is process sucessfully. We hope see you in next time.</p>

        <div class="bg-base-200 p-3 rounded shadow-inner my-3 space-y-3 max-h-screen overflow-y-auto">
          <div class="bg-base-100 p-3 flex space-x-3">
            <div class="avatar">
              <div class="w-16 mask mask-squircle">
                <img src="https://placehold.co/400" alt="">
              </div>
            </div>

            <div>
              <p class="mt-2"><strong>2</strong> x <span>The food Name</span></p>
              <p class="text-sm">Subtotal: <span class="text-error">200.000 đ</span></p>
            </div>
          </div>
        </div>
        
        <div class="grid grid-cols-2">
          <p class="mt-3 font-light text-xl">
            Total: <span class="text-primary font-bold">{{ number_format(120000) }}</span>đ
          </p>
          <div>
            <button class="btn float-right" disabled>Already Paid</button>
          </div>
        </div>

      </div>
    </div>

    <div class="max-w-xl mx-auto mt-3">
      <a href="#" class="btn btn-ghost">< Go Back</a>
    </div>
  </div>
</body>
</html>
