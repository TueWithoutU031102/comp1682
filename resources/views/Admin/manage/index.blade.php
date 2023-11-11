<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.2/dist/full.css" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css"> --}}
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
    <title>Manage Account</title>
</head>


<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manage Dashboard') }}
            </h2>
        </x-slot>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
        @endif
        <div class="create-btn">
            <a type="button" href="{{ route('admin.create') }}" class="btn btn-primary"
                style="font-weight: bold; font-size: 20px; color:white;">+</a>
        </div>

        <table class="table-auto mx-auto" style="width:70%;">
            <thead>
                <tr class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <th class="px-4 py-2 font-semibold text-xs text-black">Name</th>
                    <th class="px-4 py-2 font-semibold text-xs text-black">Role</th>
                </tr>
            </thead>
            <tbody class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($users as $user)
                    <tr onclick="showModal('{{ route('admin.show', ['user' => $user]) }}')">
                        <td class="border px-4 py-2 font-semibold text-xs text-black">{{ $user->name }}</td>
                        <td class="border px-4 py-2 font-semibold text-xs text-black">{{ $user->role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <dialog id="modal">
            <article style="width:400px;height:400px">
                <form method="dialog">
                    <a href="javascript:void(0)" class="close" onclick="modal.close()"></a>
                </form>
                <iframe style="width:100%; height:100%" src="{{ route('admin.show', ['user' => $user]) }}"></iframe>
                <footer>
                    <form class="inline-block" method="dialog">
                        <button>Close</button>
                    </form>
                </footer>
            </article>
        </dialog>
    </x-app-layout>

    <script>
        function showModal(url) {
            var modal = document.getElementById("modal");
            // Thiết lập iframe để hiển thị nội dung tương ứng với đường dẫn
            document.querySelector('#modal iframe').src = url;
            modal.showModal();
        }
    </script>
</body>


</html>
