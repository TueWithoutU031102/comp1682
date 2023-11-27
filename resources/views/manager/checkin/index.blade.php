<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Session table list') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 max-w-2xl mx-auto my-5">
        <div class="card-body">
            @include('components.notification')

            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Table</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="ses_data">
                        @foreach ($session as $ses)
                            <tr class="hover">
                                <td>{{ $ses->id }}</td>
                                <td>{{ $ses->name }}</td>
                                <td>{{ $ses->phone }}</td>
                                <td>{{ $ses->table->name }}</td>
                                <td>
                                    <form action="{{ route('manager.checkin.destroy', $ses) }}" method="POST"
                                        onsubmit="return confirm('Are you sure to delete {{ $ses->name }} !!!???')">
                                        @csrf
                                        <button type="submit" class="btn btn-square btn-outline btn-error btn-sm">
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

    <script>
        function showModal(url) {
            var modal = document.getElementById("modal");
            document.querySelector('#modal iframe').src = url;
            modal.showModal();
        }
        async function updateEvent() {
            let url = "{{ route('manager.checkin.event',[],false) }}";
            let response = await fetch(url);
            let data = await response.json();
            let ses = data.sessions;
            let table = data.tables;
            let element = window.document.querySelector('#ses_data');
            element.innerHTML = '';

            for (const obj of ses) {
                let tableName = table.find(table => table.id === obj.table_id).name;
                let tr = `<tr class="hover">
                <td>${obj.id}</td>
                <td>${obj.name}</td>
                <td>${obj.phone}</td>
                <td>${tableName}</td>
                <td>
                    <form action="/managers/checkins/${obj.id}/destroy" method="POST" onsubmit="return confirm('Are you sure to delete this !!!???')">
                        @csrf
                        <button type="submit" class="btn btn-square btn-outline btn-error btn-sm">
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
</x-app-layout>
