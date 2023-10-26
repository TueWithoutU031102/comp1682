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
    <h1>Review list</h1>
    <br><br>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $reviews as $review )
            <tr onclick="redirectTo('{{ route('manager.review.show', ['review' => $review]) }}')">
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>
</body>

</html>
