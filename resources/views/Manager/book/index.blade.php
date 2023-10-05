<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Menu</title>
</head>

<body>
    <h1>Book</h1>
    <br><br>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Phonenumber</th>
                <th scope="col">Number of people</th>
                <th scope="col">Arrival time</th>
                <th scope="col">Note</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->bookName }}</td>
                    <td>{{ $book->phonenumber }}</td>
                    <td>{{ $book->numberofPeople }}</td>
                    <td>{{ $book->arrivalTime }}</td>
                    <td>{{ $book->note }}</td>
                    <td>{{ $book->status }}</td>
                    <td>
                        <a href="{{ $book->id }}" title="View Profile"
                            class="btn btn-info btn-sm"><i aria-hidden="true"><i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
