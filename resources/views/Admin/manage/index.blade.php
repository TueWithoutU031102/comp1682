<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.2/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <script>
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
    </script> --}}
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
            <div class="alert alert-success" role="alert">
                <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif

        <div class="create-btn">
            <button onclick="showModal('{{ route('admin.create') }}')" class="btn btn-primary"
                style="font-weight: bold; font-size: 20px; color:white;">+</button>
        </div>

        <table class="table-auto mx-auto w-3/4">
            <thead>
                <tr class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <th class="px-4 py-2 font-semibold text-xs text-black">Name</th>
                    <th class="px-4 py-2 font-semibold text-xs text-black">Role</th>
                </tr>
            </thead>
            <tbody class="bg-white overflow-hidden shadow-sm sm:rounded-lg" id="user_data">
                @foreach ($users as $user)
                    <tr onclick="showModal('{{ route('admin.show', ['user' => $user]) }}')">
                        <td class="border px-4 py-2 font-semibold text-xs text-black">{{ $user->name }}</td>
                        <td class="border px-4 py-2 font-semibold text-xs text-black">{{ $user->role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <dialog id="modal" class="modal">
            <div class="modal-box">
                <article style="width:400px;height:400px">
                    <form method="dialog">
                        <button method="dialog" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                            X
                        </button>
                    </form>
                    <iframe style="width:100%; height:100%"></iframe>
                </article>
            </div>
        </dialog>
    </x-app-layout>
    <script defer>
        function showModal(url) {
            var modal = document.getElementById("modal");
            document.querySelector('#modal iframe').src = url;
            modal.showModal();
        }
        async function updateEvent() {
            let url = "{{ route('admin.event') }}";
            let response = await fetch(url);
            let user = await response.json();

            let element = window.document.querySelector('#user_data');
            element.innerHTML = '';

            for (const obj of user) {
                let tr = `<tr onclick="showModal('/admins/manages/${obj.id}')">
                    <td class="border px-4 py-2 font-semibold text-xs text-black">${obj.name}</td>
                    <td class="border px-4 py-2 font-semibold text-xs text-black">${obj.role}</td>
                </tr>`
                element.insertAdjacentHTML('beforeend', tr);
            }
        }
        setInterval(updateEvent, 2000);

        window.addEventListener('message', function(event) {
            if (event.data === "user deleted") {
                window.document.querySelector("#modal").close()
            }
        })
    </script>
</body>


</html>
