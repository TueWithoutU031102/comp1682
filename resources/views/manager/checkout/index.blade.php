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
                            <th>Status</th>
                            <th>Action</th>
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
                                <td>{{ $checkout->total }}</td>
                                <td class="text-info link" onclick="status{{ $checkout->id }}.showModal()">
                                    {{ $checkout->status }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
