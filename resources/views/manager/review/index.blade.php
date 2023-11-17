<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Review') }}
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
                            <th>Name</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="review_data">
                        @foreach ($reviews as $review)
                            <tr class="hover cursor-pointer">
                                <td>{{ $review->id }}</td>
                                <td>{{ $review->name }}</td>
                                <td>{{ $review->created_at->diffForHumans() }}</td>
                                <td class="flex space-x-3">
                                    <button data-review='@json($review)'
                                        class="btn btn-sm btn-circle btn-info btn-outline">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <form class="delete-review" action="{{ route('manager.review.destroy', $review) }}"
                                        method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-circle btn-error btn-outline">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <dialog id="modal" class="modal">
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
    </dialog>

    <x-slot name="scripts">
        <script defer>
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
        </script>
    </x-slot>
</x-app-layout>
