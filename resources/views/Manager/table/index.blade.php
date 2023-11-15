<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Table</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Table') }}
            </h2>
        </x-slot>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
        @endif
        <div class="create-btn">
            <a type="button" onclick="showModal('{{ route('manager.table.create') }}')" class="btn btn-primary"
                style="font-weight: bold; font-size: 20px;">+</a>
        </div>
        <br><br>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Link</th>
                    <th scope="col">&nbsp;</th>
                </tr>
            </thead>
            <tbody id="table_data">
                @foreach ($tables as $table)
                    <tr>
                        <td>{{ $table->name }}</td>
                        <td>{{ asset($table->link) }}</td>
                        <td>
                            <a onclick="showModal('{{ route('manager.table.edit', ['table' => $table]) }}')"
                                title="Edit" class="btn btn-primary btn-sm"><i aria-hidden="true"><i
                                        class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('manager.table.destroy', ['table' => $table]) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Are you sure to delete {{ $table->name }} !!!???')">
                                @csrf
                                <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i
                                            class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
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
        <script defer>
            function showModal(url) {
                var modal = document.getElementById("modal");
                document.querySelector('#modal iframe').src = url;
                modal.showModal();
            }
            async function updateEvent() {
                let url = "{{ route('manager.table.event') }}";
                let response = await fetch(url);
                let table = await response.json();

                let element = window.document.querySelector('#table_data');
                element.innerHTML = '';

                for (const obj of table) {
                    let tr = `<tr>
                    <td>${obj.name}</td>
                    <td>http://127.0.0.1:8000/customers/checkins/tables/${obj.id}</td>
                    <td>
                        <a onclick="showModal('/managers/tables/${obj.id}/edit')"
                            title="Edit" class="btn btn-primary btn-sm"><i aria-hidden="true">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                            <form action="/managers/tables/${obj.id}/destroy" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Are you sure to delete ${obj.name}!!!???')">
                                @csrf
                                <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i
                                    class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                </tr>`

                    element.insertAdjacentHTML('beforeend', tr);
                }
            }
            setInterval(updateEvent, 2000);

            window.addEventListener('message', function(event) {
                if (event.data === "table edited") {
                    window.document.querySelector("#modal").close()
                }
            })
        </script>
    </x-app-layout>
</body>

</html>
