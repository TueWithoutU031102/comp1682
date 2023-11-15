<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Session table list</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Session table list') }}
            </h2>
        </x-slot>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
        @endif
        <br><br>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Table</th>
                </tr>
            </thead>
            <tbody id="ses_data">
                @foreach ($session as $ses)
                    <tr onclick="showModal('{{ route('manager.checkin.show', ['session' => $ses]) }}')">
                        <td>{{ $ses->id }}</td>
                        <td>{{ $ses->name }}</td>
                        <td>{{ $ses->table->name }}</td>
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
    <script>
        function showModal(url) {
            var modal = document.getElementById("modal");
            document.querySelector('#modal iframe').src = url;
            modal.showModal();
        }
        async function updateEvent() {
            let url = "{{ route('manager.checkin.event') }}";
            let response = await fetch(url);
            let data = await response.json();
            let ses = data.sessions;
            let table = data.tables;
            let element = window.document.querySelector('#ses_data');
            element.innerHTML = '';
            for (const obj of ses) {
                let tableName = table.find(table => table.id === obj.table_id).name;
                let tr = `<tr onclick="showModal('/managers/checkins/${obj.id}')">
                <td>${obj.id}</td>
                <td>${obj.name}</td>
                <td>${tableName}</td>
            </tr>`
                element.insertAdjacentHTML('beforeend', tr);
            }
        }

        setInterval(updateEvent, 1000);
        window.addEventListener('message', function(event) {
            if (event.data === "session table deleted") window.document.querySelector("#modal").close()
        })
    </script>
</body>

</html>
