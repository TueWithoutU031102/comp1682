<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Review') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 max-w-3xl mx-auto my-5">
        <div class="card-body">
            @include('components.notification')

            {{-- TODO: cứu trợ phần front end và realtime --}}
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
                            {{-- <dialog id="status{{ $cart->id }}" class="modal">
                                <div class="modal-box max-w-xs">
                                    <article>
                                        <form method="dialog">
                                            <button method="dialog" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                                                X
                                            </button>
                                        </form>
                                        <h3 class="font-semibold text-lg mb-3">Update status order</h3>
                                        <form method="POST" action="{{ route('manager.order.update', ['cart' => $cart]) }}">
                                            @method('PUT')
                                            @csrf

                                            <div class="form-control">
                                                <label class="label">Status</label>
                                                <select name="status" value="{{ $cart->status }}" class="select select-bordered w-full max-w-xs">
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status->value }}">{{ $status->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-success mt-5">Save Status</button>
                                        </form>
                                    </article>
                                </div>
                            </dialog> --}}
                            <tr>
                                <td>{{ $checkout->id }}</td>
                                <td>{{ $checkout->table->name }}</td>
                                <td>{{ $checkout->total }}</td>
                                <td class="text-info link" onclick="status{{ $checkout->id }}.showModal()">
                                    {{ $checkout->status }}
                                </td>
                                <td>
                                    {{-- <form action="{{ route('manager.order.destroy', ['cart' => $cart]) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure to delete {{ $cart->quantity }} {{ $cart->menu->name }} {{ $cart->session->table->name }} !!!???')">
                                        @csrf
                                        <button class="btn btn-error btn-outline btn-square btn-sm"><i class="fa-solid fa-trash"></i></button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- <dialog id="modal" class="modal">
        <div class="modal-box">
            <article>
                <form method="dialog">
                    <button method="dialog" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                        X
                    </button>
                </form>
                <div class="content"></div>
            </article>
        </div>
    </dialog> --}}

    <x-slot name="scripts">
        {{-- <script defer>
    window.addEventListener('load', function() {
        const modal = document.querySelector('#modal');
        const content = modal.querySelector('#modal .content');

        for (const form of document.querySelectorAll('delete-review')) {
            form.addEventListener('submit', event => {
                event.preventDefault();
                const confirm = window.confirm('Are you sure to delete this review !!!???');
                if (confirm) {
                    form.submit();
                }
            })
        }

        document.querySelectorAll('button[data-review]').forEach(button => {
            const review = JSON.parse(button.dataset.review);

            button.addEventListener('click', () => {
                content.innerHTML = `
                <h3 class="font-bold text-lg">Review from ${review.name}</h3>
                <table class="table bg-base-200 mt-5">
                    <tr>
                        <th>Review ID</th>
                        <td>${review.id}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>${review.phone}</td>
                    </tr>
                    <tr>
                        <th>Food quality</th>
                        <td>${review.foodQuality}</td>
                    </tr>
                    <tr>
                        <th>Service quality</th>
                        <td>${review.serviceQuality}</td>
                    </tr>
                </table>

                <div class="form-control mt-5">
                    <p class="font-semibold">Description</p>
                    <p>${review.detail}</p>
                </div>
                `
                modal.showModal();
            })
        })
    })
</script> --}}
    </x-slot>
</x-app-layout>
