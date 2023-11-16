<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.link')
    <title>Notification</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Notification list') }}
            </h2>
        </x-slot>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Table</th>
                    <th scope="col">Date</th>
                    <th scope="col">&nbsp;</th>
                </tr>
            </thead>
            <tbody id="notification_data">
                @foreach ($notifications as $notification)
                    <tr>
                        <td>{{ $notification->id }}</td>
                        <td>{{ $notification->session_id }}</td>
                        <td>{{ $notification->created_at }}</td>
                        <td>
                            <form
                                action="{{ route('manager.notification.destroy', ['notification' => $notification]) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure to delete this notification !!!???')">
                                @csrf
                                <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i
                                            class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

    <script>
        async function updateEvent() {
            let url = "{{ route('manager.notification.event') }}";
            let response = await fetch(url);
            let notification = await response.json();

            let element = window.document.querySelector('#notification_data');
            element.innerHTML = '';

            for (const obj of notification) {

                let tr = `<tr>
                    <td>${obj.id}</td>
                    <td>${obj.session_id}</td>
                    <td>${moment(obj.created_at).format('YYYY-MM-DD HH:mm:ss')}</td>
                    <td>
                        <form action="/managers/notifications/${obj.id}/destroy"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure to delete this notification !!!???')">
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