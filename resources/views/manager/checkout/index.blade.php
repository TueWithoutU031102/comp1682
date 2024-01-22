<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 max-w-3xl mx-auto my-5">
        <div class="card-body">
            @include('components.notification')

            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th>Table</th>
                            <th>Total</th>
                            <th>Name</th>
                            <th>MSSV</th>
                            <th>Mobile phone</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="checkout_data">
                        @foreach ($checkouts as $checkout)
                        <dialog id="status{{ $checkout->id }}" class="modal">
                            <div class="modal-box max-w-xs">
                                <article>
                                    <form method="dialog">
                                        <button method="dialog"
                                            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                                            X
                                        </button>
                                    </form>
                                    <h3 class="font-semibold text-lg mb-3">Status</h3>
                                    <form method="POST" action="{{ route('manager.checkout.update', $checkout) }}">
                                        @csrf

                                        <div class="form-control">
                                            <label class="label">Status</label>
                                            <select name="status" value="{{ $checkout->status }}"
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
                        <tr class="hover">
                            <td>{{ $checkout->id }}</td>
                            <td>{{ $checkout->table->name }}</td>
                            <td>{{ $checkout->total }} đ</td>
                            <td>{{ $checkout->name }}</td>
                            <td>{{ $checkout->mssv }}</td>
                            <td>{{ $checkout->phone }}</td>
                            @if($checkout->status->name == "Pending")
                            <td class="text-info link text-orange-500" onclick="status{{ $checkout->id }}.showModal()">
                                {{ $checkout->status }}
                            </td>
                            @elseif($checkout->status->name == "Cash" || $checkout->status->name == "Transfer")
                            <td class="text-info link text-green-500" onclick="status{{ $checkout->id }}.showModal()">
                                {{ $checkout->status }}
                            </td>
                            @elseif($checkout->status->name == "Canceled")
                            <td class="text-info link text-red-500" onclick="status{{ $checkout->id }}.showModal()">
                                {{ $checkout->status }}
                            </td>
                            @endif
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
            let url = "{{ route('manager.checkout.event', [], false) }}";
            let response = await fetch(url);
            let data = await response.json();
            let checkout = data.checkouts.reverse();
            let table = data.tables;
            let status = data.statuses;



            let element = window.document.querySelector('#checkout_data');
            element.innerHTML = '';

            for (const obj of checkout) {
                let tableName = table.find(table => table.id === obj.table_id).name;
                let statusClass = '';
                if (obj.status === "Pending") {
                    statusClass = 'text-orange-500';
                } else if (obj.status === "Cash" || obj.status === "Transfer") {
                    statusClass = 'text-green-500';
                } else if (obj.status === "Cancel") {
                    statusClass = 'text-red-500';
                }

                let created = document.querySelector(`#status${obj.id}`)

                let dialog = created ? '' : `<dialog id="status${obj.id}" class="modal">
                    <div class="modal-box max-w-xs">
                        <article>
                            <form method="dialog">
                                <button method="dialog"
                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                                    X
                                </button>
                            </form>
                            <h3 class="font-semibold text-lg mb-3">Status</h3>
                            <form method="POST" action="managers/checkout/${obj.id}/update">
                                @csrf

                                <div class="form-control">
                                    <label class="label">Status</label>
                                    <select name="status" value="${obj.status}"
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
                </dialog>`

                let tr = `<tr>
                        <td>${obj.id}</td>
                        <td>${tableName}</td>
                        <td>${obj.total} đ</td>
                        <td>${obj.name}</td>
                        <td>${obj.mssv}</td>
                        <td>${obj.phone}</td>
                        <td class="text-info link ${statusClass}" onclick="status${obj.id}.showModal()">
                            ${obj.status}
                        </td>
                    </tr>`
                element.insertAdjacentHTML('beforeend', dialog + tr);
            }
        }
        setInterval(updateEvent, 1000);
    </script>
</x-app-layout>