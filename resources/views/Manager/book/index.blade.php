<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Book</title>
</head>

<body>
    <h1>Book</h1>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Number of people</th>
                <th scope="col">Arrival time</th>
                <th scope="col">Note</th>
                <th scope="col">Status</th>
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        <tbody id="book_data">
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->bookName }}</td>
                    <td>{{ $book->phonenumber }}</td>
                    <td>{{ $book->numberofPeople }}</td>
                    <td>{{ $book->arrivalTime }}</td>
                    <td>{{ $book->note }}</td>
                    <td>{{ $book->status }}</td>
                    <td>
                        <form action="{{ route('manager.book.destroy', ['book' => $book]) }}" method="POST"
                            class="d-inline" onsubmit="return confirm('Are you sure to delete this booking !!!???')">
                            @csrf
                            <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i
                                        class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
                    <td>${obj.note }</td>
                    <td>${obj.status }</td>
                    <td>
                        <form action="/managers/books/${obj.id}/destroy"
                            method="POST" class="d-inline"
                            class="d-inline" onsubmit="return confirm('Are you sure to delete this booking !!!???')">
                            @csrf
                            <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i
                                        class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>`
                element.insertAdjacentHTML('beforeend', tr);
            }
        }

        setInterval(updateEvent, 1000);
    </script>
</body>

</html>
