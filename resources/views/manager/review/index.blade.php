<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Review</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Review') }}
            </h2>
        </x-slot>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody id="review_data">
                @foreach ($reviews as $review)
                    <tr onclick="showModal('{{ route('manager.review.show', ['review' => $review]) }}')">
                        <td>{{ $review->id }}</td>
                        <td>{{ $review->created_at }}</td>
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
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script defer>
        function showModal(url) {
            var modal = document.getElementById("modal");
            document.querySelector('#modal iframe').src = url;
            modal.showModal();
        }
        async function updateEvent() {
            let url = "{{ route('manager.review.event') }}";
            let response = await fetch(url);
            let review = await response.json();

            let element = window.document.querySelector('#review_data');
            element.innerHTML = '';

            for (const obj of review) {

                let tr = `<tr onclick="showModal('/managers/reviews/${obj.id}')">
                    <td>${obj.id}</td>
                    <td>${moment(obj.created_at).format('YYYY-MM-DD HH:mm:ss')}</td>
                </tr>`
                element.insertAdjacentHTML('beforeend', tr);
            }
        }

        setInterval(updateEvent, 1000);
        window.addEventListener('message', function(event) {
            if (event.data === "review deleted") {
                window.document.querySelector("#modal").close()
            }
        })
    </script>
</body>

</html>
