<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order') }}
        </h2>
    </x-slot>


    <div class="card bg-base-100 max-w-6xl mx-auto my-5">
        <div class="card-body">
            @include('components.notification')
            <div class="overflow-x-auto">
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
                            <dialog id="status{{ $cart->id }}" class="modal">
                                <div class="modal-box max-w-xs">
                                    <article>
                                        <form method="dialog">
                                            <button method="dialog"
                                                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                                                X
                                            </button>
                                        </form>
                                        <h3 class="font-semibold text-lg mb-3">Update status order</h3>
                                        <form method="POST"
                                            action="{{ route('manager.order.update', ['cart' => $cart]) }}">
                                            @csrf

                                            <div class="form-control">
                                                <label class="label">Status</label>
                                                <select name="status" value="{{ $cart->status }}"
                                                    class="select select-bordered w-full max-w-xs">
                                                    @foreach ($statuses as $status)
                                                        <option value="{{ $status->value }}">{{ $status->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-success mt-5">Save Status</button>
                                        </form>
                                    </article>
                                </div>
                            </dialog>
                            <tr>
                                <td>{{ $cart->id }}</td>
                                <td>{{ $cart->menu->name }}</td>
                                <td>{{ $cart->session->table->name }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td class="text-info link" onclick="status{{ $cart->id }}.showModal()">
                                    {{ $cart->status }}
                                </td>
                                <td>{{ $cart->created_at }}</td>
                                <td>
                                    <form action="{{ route('manager.order.destroy', ['cart' => $cart]) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure to delete {{ $cart->quantity }} {{ $cart->menu->name }} {{ $cart->session->table->name }} !!!???')">
                                        @csrf
                                        <button class="btn btn-error btn-outline btn-square btn-sm"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js" defer></script>
    <script>
        async function updateEvent() {
            let url = "{{ route('manager.order.event', [], false) }}";
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

                let created = document.querySelector(`#status${obj.id}`)

                let dialog = created ? '' : `<dialog id="status${obj.id}" class="modal">
                                <div class="modal-box max-w-xs">
                                    <article>
                                        <form method="dialog">
                                            <button method="dialog" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                                                X
                                            </button>
                                        </form>
                                        <h3 class="font-semibold text-lg mb-3">Update status order</h3>
                                        <form action="/managers/orders/${obj.id}/update" method="POST"
                                            @csrf
                                            <div class="form-control">
                                                <label class="label">Status</label>
                                                <select name="status" value="${obj.status}" class="select select-bordered w-full max-w-xs">
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status->value }}">{{ $status->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-success mt-5">Save Status</button>
                                        </form>
                                    </article>
                                </div>
                            </dialog>`
                console.log(dialog);
                let tr = `<tr>
                <td>${obj.id}</td>
                <td>${menuName}</td>
                <td>${tableName}</td>
                <td>${obj.quantity}</td>
                <td class="text-info link" onclick="status${obj.id}.showModal()">${obj.status}</td>
                <td>${moment(obj.created_at).format('YYYY-MM-DD HH:mm:ss') }</td>
                <td>
                    <form action="/managers/orders/${obj.id}/destroy" method="POST"
                        class="d-inline"
                        onsubmit="return confirm('Are you sure to delete ${obj.quantity} ${menuName} ${tableName} !!!???')">
                        @csrf
                        <button class="btn btn-error btn-outline btn-square btn-sm"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>`

                element.insertAdjacentHTML('beforeend', dialog + tr);
            }
        }
        setInterval(updateEvent, 5000);
    </script>

</x-app-layout>
