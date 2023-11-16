<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Order</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Order') }}
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
                    <th scope="col">Dish</th>
                    <th scope="col">Table</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                    <th scope="col">Time order</th>
                    <th scope="col">&nbsp;</th>
                </tr>
            </thead>
            <tbody id="order_data">
                @foreach ($carts as $cart)
                    <tr>
                        <td>{{ $cart->id }}</td>
                        <td>{{ $cart->menu->name }}</td>
                        <td>{{ $cart->session->table->name }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td onclick="showModal('{{ route('manager.order.edit', ['cart' => $cart]) }}')">
                            {{ $cart->status }}
                        </td>
                        <td>{{ $cart->created_at }}</td>
                        <td>
                            <form action="{{ route('manager.order.destroy', ['cart' => $cart]) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Are you sure to delete {{ $cart->quantity }} {{ $cart->menu->name }} {{ $cart->session->table->name }} !!!???')">
                                @csrf
                                <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i
                                            class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <dialog id="modal" class="modal">
                        <div class="modal-box">
                            <article style="width:400px;height:400px">
                                <form method="dialog">
                                    <button method="dialog"
                                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                                        X
                                    </button>
                                </form>
                                <iframe style="width:100%; height:100%"></iframe>
                            </article>
                        </div>
                    </dialog>
                @endforeach
            </tbody>
        </table>
    </x-app-layout>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js" defer></script>
    <script>
        function showModal(url) {
            var modal = document.getElementById("modal");
            document.querySelector('#modal iframe').src = url;
            modal.showModal();
        }

        async function updateEvent() {
            let url = "{{ route('manager.order.event') }}";
            let response = await fetch(url);
            let data = await response.json();
            let cart = data.carts;
            let menu = data.menus;
            let session = data.sessions;
            let table = data.tables;
            let element = window.document.querySelector('#order_data');
            element.innerHTML = '';

            for (const obj of cart) {

                let menuName = menu.find(menu => menu.id === obj.menu_id).name;

                let tableID = session.find(session => session.id === obj.session_id).table_id;
                let tableName = table.find(table => table.id === tableID).name;
                let tr = `<tr>
                <td>${obj.id}</td>
                <td>${menuName}</td>
                <td>${tableName}</td>
                <td>${obj.quantity}</td>
                <td onclick="showModal('/managers/orders/${obj.id}/edit')">${obj.status}</td>
                <td>${moment(obj.created_at).format('YYYY-MM-DD HH:mm:ss') }</td>
                <td>
                    <form action="/managers/orders/${obj.id}/destroy" method="POST"
                        class="d-inline"
                        onsubmit="return confirm('Are you sure to delete ${obj.quantity} ${menuName} ${tableName} !!!???')">
                        @csrf
                        <button class="btn btn-danger btn-sm"><i aria-hidden="true">
                        <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>`

                element.insertAdjacentHTML('beforeend', tr);
            }
        }
        setInterval(updateEvent, 1000);
        window.addEventListener('message', function(event) {
            if (event.data === "status edited") {
                window.document.querySelector("#modal").close()
            }
        })
    </script>
</body>

</html>
