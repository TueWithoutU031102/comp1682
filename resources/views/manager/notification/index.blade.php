<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notification list') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 max-w-2xl mx-auto my-5">
        <div class="card-body">
            @include('components.notification')
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Table</th>
                            <th>Date</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="notification_data">
                        @foreach ($notifications as $notification)
                            <tr class="hover">
                                <td>{{ $notification->id }}</td>
                                <td>{{ $notification->session->table->name }}</td>
                                <td>{{ $notification->created_at }}</td>
                                <td>
                                    <form
                                        action="{{ route('manager.notification.destroy', ['notification' => $notification]) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure to delete this notification !!!???')">
                                        @csrf
                                        <button class="btn btn-error btn-outline btn-square btn-sm"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script>
        async function updateEvent() {
            let url = "{{ route('manager.notification.event') }}";
            let response = await fetch(url);
            let notification = await response.json();

            let element = window.document.querySelector('#notification_data');
            element.innerHTML = '';

            for (const obj of notification) {

                let tr = `<tr class="hover">
                    <td>${obj.id}</td>
                    <td>${obj.session_id}</td>
                    <td>${moment(obj.created_at).format('YYYY-MM-DD HH:mm:ss')}</td>
                    <td>
                        <form action="/managers/notifications/${obj.id}/destroy"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure to delete this notification !!!???')">
                            @csrf
                            <button class="btn btn-error btn-outline btn-square btn-sm"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>`
                element.insertAdjacentHTML('beforeend', tr);
            }
        }

        setInterval(updateEvent, 1000);
    </script>
</x-app-layout>
