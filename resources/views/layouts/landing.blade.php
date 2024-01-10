<!DOCTYPE html>
<html data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    @stack('header')

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
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
        :root {
            --primary: #006699;
            --grid-spacing-horizontal: 0;
            --grid-spacing-vertical: 0;
        }

        body {
            background: #fafafa;
            color: #030303;
        }

        address,
        blockquote,
        dl,
        figure,
        form,
        ol,
        p,
        pre,
        table,
        ul {
            color: #030303;
            margin: 0;
        }

        button {
            margin: 0;
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="shadow-lg fixed top-0 right-0 left-0 bg-slate-50 z-10">
        <nav class="container">
            <ul>
                <li>
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('manager.index') }}">
                            <x-application-logo
                                class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    </div>
                </li>
            </ul>
            <ul class="hidden md:block">
                <li><a onclick="showModal()">Booking</a></li>
            </ul>

            <ul class="hidden md:block">
                <li><a href="/login" role="button">Login</a></li>
            </ul>

            <ul class="md:hidden">
                <li>
                    <label for="navbar">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </li>
            </ul>
        </nav>
    </div>

    <div class="drawer">
        <input id="navbar" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <!-- Page content here -->
            @yield('content')
        </div>
        <div class="drawer-side z-20">
            <label for="navbar" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 min-h-full bg-base-200">
                <!-- Sidebar content here -->
                <li><a class="no-underline" onclick="showModal()">Booking</a></li>
                <li><a class="no-underline" href="/login">Login</a></li>
            </ul>
        </div>
    </div>

    <div class="bg-white rounded-t-xl">
        <footer class="container py-5 flex justify-between">
            <aside class="">
                <p class="mt-5">Tetnolo-Z Web<br />Product of Vu Nguyen Duc Tue<br/>Front-end by Vu Hien Vinh<br/>Design by Luu Thao Huong</p>
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
