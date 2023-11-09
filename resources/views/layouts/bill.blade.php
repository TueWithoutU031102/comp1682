<!DOCTYPE html>
<html data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    @stack('header')

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.2/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            corePlugins: {
                preflight: false
            },
            theme: {
                extend: {
                    color: {
                        primary: '#006699'
                    }
                }
            }
        }
    </script>

    <script>
        function toggleTheme() {
            const html = document.querySelector('html');
            const currentTheme = html.getAttribute('data-theme');
            const targetTheme = currentTheme === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', targetTheme);
        }
    </script>

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="navbar bg-base-100">
        <div class="navbar-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </label>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a>Home</a></li>
                    <li><a>Menu</a></li>
                    <li><a>About</a></li>
                </ul>
            </div>
        </div>
        <div class="navbar-center">
            <a class="btn btn-ghost normal-case text-xl">Brand</a>
        </div>
        <div class="navbar-end">
            <button class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
            <button class="btn btn-ghost btn-circle lg:hidden">
                <label for="navbar" class="indicator">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25c0-.05.01-.09.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2Z" />
                    </svg>
                    <span class="badge badge-xs badge-primary indicator-item"></span>
                </label>
            </button>
        </div>
    </div>

    <div class="drawer drawer-end lg:drawer-open">
        <input id="navbar" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col bg-stone-50">
            <!-- Page content here -->
            @yield('content')
        </div>
        <div class="drawer-side z-20">
            <label for="navbar" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="h-full flex flex-col justify-between p-4 w-80 bg-base-200 min-h-full">
                <div class="flex flex-col space-y-3">
                    @if ($bill)
                        @php $total = 0 @endphp
                        @foreach ($bill as $b)
                            @if ($b['status'] === 'Completed')
                                <div class="rounded flex space-x-2 bg-white p-2 cart-detail">
                                    <div class="cart-detail-img">
                                        <img class="aspect-square w-12 h-12 rounded" src="{{ asset($b->menu->image) }}"
                                            alt="">
                                    </div>
                                    <div>
                                        <p>{{ $b->menu->name }}</p>

                                        <div class="flex justify-between mt-3">
                                            <div class="join border border-stone-200">
                                                <button class="btn btn-xs join-item">-</button>
                                                <input type="number"
                                                    class="input input-xs join-item w-8 text-center quantity"
                                                    value="{{ $b['quantity'] }}">
                                                <button class="btn btn-xs join-item">+</button>
                                            </div>
                                        </div>
                                        @php
                                            $price = $b->menu->price * $b['quantity'];
                                        @endphp
                                        <span class="text-red-500 price">{{ $price }} đ</span>
                                        @php $total += $price @endphp
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>

            <div>
                <hr class="border-t h-1 border-black border-dashed w-full my-2">
                <div class="flex justify-between">
                    <span>Total price:</span>
                    <span> {{ $total }}đ</span>
                </div>

                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-info w-full mt-2">Checkout</button>
                </form>
                <div class="lg:mt-3 w-full text-center">
                    <label class="swap swap-flip opacity-40">

                        <!-- this hidden checkbox controls the state -->
                        <input type="checkbox" class="hidden" />
                        <div class="swap-off"><span class="text-4xl">😀</span></div>
                        <div class="swap-on"><span class="text-4xl">🤡</span></div>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-t-xl">
        <footer class="container p-5 flex justify-between">
            <aside class="">
                <svg width="50" height="50" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    fill-rule="evenodd" clip-rule="evenodd" class="fill-current">
                    <path
                        d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z">
                    </path>
                </svg>
                <p class="mt-5">ACME Industries Ltd.<br />Providing reliable tech since 1992</p>
            </aside>

            <nav class="grid grid-cols-1">
                <strong>Social</strong>

                <div class="grid grid-flow-col gap-4">
                    <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            class="fill-current">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z">
                            </path>
                        </svg></a>
                    <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            class="fill-current">
                            <path
                                d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z">
                            </path>
                        </svg></a>
                    <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            class="fill-current">
                            <path
                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z">
                            </path>
                        </svg></a>
                </div>
            </nav>
        </footer>
    </div>

    @stack('scripts')
</body>

</html>
