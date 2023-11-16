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
                <button
                    onclick="showModal('{{ route('admin.create') }}')"
                    class="btn btn-primary btn-sm btn-square text-lg">
                    +
                </button>
            </h2>
        </x-slot>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif

        <div class="card shadow bg-base-100 max-w-xl mx-auto mt-5">
            <div class="card-body">
                <h3 class="card-title">Manage role</h3>
                <table class="table table table-zebra border">
                    <thead>
                        <tr class="font-semibold">
                            <th>Name</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody id="user_data">
                        @foreach ($users as $user)
                            <tr class="cursor-pointer" onclick="showModal('{{ route('admin.show', ['user' => $user]) }}')">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <dialog id="modal" class="modal">
            <div class="modal-box">
                <article>
                    <form method="dialog">
                        <button method="dialog" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                            X
                        </button>
                    </form>
                    <iframe class="w-full h-full aspect-[4/3]"></iframe>
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
                let tr = `<tr class="cursor-pointer" onclick="showModal('/admins/manages/${obj.id}')">
                    <td>${obj.name}</td>
                    <td>${obj.role}</td>
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
