<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Menu</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Menu') }}
            </h2>
        </x-slot>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
        @endif
        <div class="create-btn">
            <a type="button" onclick="showModal('{{ route('manager.menu.create') }}')" class="btn btn-primary"
                style="font-weight: bold; font-size: 20px;">+</a>
        </div>
        {{-- <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr onclick="showModal('{{ route('manager.menu.show', ['menu' => $menu]) }}')">
                        <td>
                            <ul class="img">
                                <li>
                                    <img style="width: 600px;height: 400px" src="{{ asset($menu->image) }}"
                                        alt="Menu Image">
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
        <div id="menu_data">
            @foreach ($types as $type)
                <div class="py-10">
                    <div class="container">
                        {{-- small banner --}}
                        <h2 class="text-center mt-10">{{ $type->name }}</h2>

                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-7">
                            @foreach ($type->menus as $menu)
                                <div>
                                    <div class="transition rounded hover:shadow-md hover:scale-105 duration-300">
                                        <img onclick="showModal('{{ route('manager.menu.show', ['menu' => $menu]) }}')"
                                            class="aspect-square object-cover w-full rounded"
                                            src="{{ asset($menu->image) }}" alt="">
                                    </div>
                                    <p class="flex flex-col p-2">
                                        <strong>{{ $menu->name }}</strong>
                                        <span class="opacity-50 text-sm">{{ $menu->price }} đ</span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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
            let url = "{{ route('manager.menu.event') }}";
            let response = await fetch(url);
            let data = await response.json();
            let type = data.types;
            let menu = data.menus;
            let element = window.document.querySelector('#menu_data');
            element.innerHTML = '';

            for (const obj of type) {
                let div = `<div class="container">
                <h2 class="text-center mt-10">${obj.name}</h2>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-7">
                    ${menu.filter(menu => menu.type_id === obj.id).map(menu => `
                            <div>
                                <div class="transition rounded hover:shadow-md hover:scale-105 duration-300">
                                    <img onclick="showModal('/managers/menus/${menu.id}])')"
                                        class="aspect-square object-cover w-full rounded"
                                        src="{{ asset('${menu.image}') }}" alt="">
                                </div>
                                <p class="flex flex-col p-2">
                                    <strong>${menu.name}</strong>
                                    <span class="opacity-50 text-sm">${menu.price} đ</span>
                                </p>
                            </div>`).join('')}
                </div>
            </div>`

                element.insertAdjacentHTML('beforeend', div);
            }
        }
        setInterval(updateEvent, 2000);

        window.addEventListener('message', function(event) {
            if (event.data === "menu edited" || event.data === "menu deleted") {
                window.document.querySelector("#modal").close()
            }
        })
    </script>
</body>

</html>
