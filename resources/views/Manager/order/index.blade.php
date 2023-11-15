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
                        <td onclick="showModal('')">{{ $cart->status }}</td>
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
                                <form method="POST" action="{{ route('manager.order.update', ['cart' => $cart]) }}">
                                    @method('PUT')
                                    @csrf
                                    <h1 class="text-2xl font-bold">Edit status order</h1>
                                    <label for="StatusDish"
                                        class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                                    <select name="status" value="{{ $cart->status }}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                        id="status">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->value }}">{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="mt-6 flex items-center justify-end gap-x-6">
                                        <button type="submit"
                                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                            Submit
                                        </button>
                                    </div>
                                </form>
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
        function showModal() {
            var modal = document.getElementById("modal");
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
                <td onclick="showModal('')">${obj.status}</td>
                <td>${moment(obj.create_at).format('YYYY-MM-DD HH:mm:ss') }</td>
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
        setInterval(updateEvent, 2000);
    </script>
</body>

</html>
