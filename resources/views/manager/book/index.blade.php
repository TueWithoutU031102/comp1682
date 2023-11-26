<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

<script>
    async function updateEvent() {
        let url = "{{ route('manager.book.event') }}";
        let response = await fetch(url);
        let book = await response.json();

        let element = window.document.querySelector('#book_data');
        element.innerHTML = '';

        for (const obj of book) {
            let tr = `<tr>
                <td>${obj.bookName }</td>
                <td>${obj.phonenumber }</td>
                <td>${obj.numberofPeople }</td>
                <td>${moment(obj.arrivalTime).format('YYYY-MM-DD HH:mm:ss') }</td>
                <td>${obj.note}</td>
                <td>
                    <form action="/managers/books/${obj.id}/destroy" method="POST"
                        class="d-inline"
                        onsubmit="return confirm('Are you sure to delete this booking !!!???')">
                        @csrf
                        <button class="btn btn-error btn-square btn-outline btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>`
            element.insertAdjacentHTML('beforeend', tr);
        }
    }

    setInterval(updateEvent, 1000);
</script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Booking') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 max-w-4xl mx-auto my-5">
        <div class="card-body">
            @include('components.notification')
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Number of people</th>
                            <th>Arrival time</th>
                            <th>Note</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="book_data">
                        @foreach ($books as $book)
                            <tr class="hover">
                                <td>{{ $book->bookName }}</td>
                                <td>{{ $book->phonenumber }}</td>
                                <td>{{ $book->numberofPeople }}</td>
                                <td>{{ $book->arrivalTime }}</td>
                                <td>{{ $book->note }}</td>
                                <td>
                                    <form action="{{ route('manager.book.destroy', ['book' => $book]) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure to delete this booking !!!???')">
                                        @csrf
                                        <button class="btn btn-error btn-square btn-outline btn-sm">
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
</x-app-layout>
