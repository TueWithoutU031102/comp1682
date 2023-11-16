<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Type</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Type') }}
            </h2>
        </x-slot>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
        @endif
        <div class="create-btn">
            <a type="button" onclick="showModal('{{ route('manager.type.create') }}')" class="btn btn-primary"
                style="font-weight: bold; font-size: 20px;">+</a>
        </div>
        <br><br>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">&nbsp;</th>
                </tr>
            </thead>
            <tbody id="type_data">
                @foreach ($types as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td>
                            <a onclick="showModal('{{ route('manager.type.edit', ['type' => $type]) }}')" title="Edit"
                                class="btn btn-primary btn-sm"><i aria-hidden="true"><i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('manager.type.destroy', ['type' => $type]) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Are you sure to delete {{ $type->name }} !!!???')">
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
    </x-app-layout>
    <script defer>
        function showModal(url) {
            var modal = document.getElementById("modal");
            document.querySelector('#modal iframe').src = url;
            modal.showModal();
        }
        async function updateEvent() {
            let url = "{{ route('manager.type.event') }}";
            let response = await fetch(url);
            let type = await response.json();

            let element = window.document.querySelector('#type_data');
            element.innerHTML = '';

            for (const obj of type) {
                let tr = `<tr>
                    <td>${obj.name}</td>
                    <td>
                        <a onclick="showModal('/managers/types/${obj.id}/edit')"
                            title="Edit" class="btn btn-primary btn-sm"><i aria-hidden="true">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                            <form action="/managers/types/${obj.id}/destroy" method="POST"
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
        setInterval(updateEvent, 1000);

        window.addEventListener('message', event => {
            if (["type edited", "type created"].includes(event.data)) {
                window.document.querySelector("#modal").close();
            }
        });
    </script>
</body>

</html>
