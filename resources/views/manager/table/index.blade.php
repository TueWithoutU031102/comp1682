<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Table') }}
            <button class="btn btn-primary btn-sm btn-square text-lg" onclick="creator.showModal()" >+</button>
        </h2>
    </x-slot>


    <div class="card bg-base-100 max-w-xl mx-auto my-5">
        <div class="card-body">
            <div class="overflow-x-auto">

                @include('components.notify')
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Preview</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="table_data">
                        @foreach ($tables as $table)
                            <tr class="hover">
                                <td>{{ $table->name }}</td>
                                <td><button class="btn-sm btn-ghost" onclick="preview('{{ asset($table->link) }}')">Preview</button></td>
                                <td class="flex space-x-3">
                                    <a href="{{ route('manager.table.edit', ['table' => $table]) }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('manager.table.destroy', ['table' => $table]) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure to delete {{ $table->name }} !!!???')">
                                        @csrf
                                        <button class="btn btn-error btn-outline btn-sm">
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

    <dialog id="creator" class="modal">
        <div class="modal-box">
            <article>
                <form method="dialog">
                    <button method="dialog" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">
                        X
                    </button>
                </form>
                <form action="{{ route('manager.table.store') }}" method="POST">
                    <h3 class="font-semibold text-lg mb-3">Add new table</h3>
                    @csrf
                    @include('components.alert')

                    <div class="form-control">
                        <label class="lable">Name</label>
                        <input class="input input-bordered" type="text" name="name" id="name" placeholder="Table name" value="{{ old('name') }}">
                    </div>

                    <button class="btn btn-success mt-5">Create</button>
                </form>
            </article>
        </div>
    </dialog>

    <dialog id="previewer" class="modal">
        <div class="modal-box">
            <article>
                <form method="dialog">
                    <button method="dialog" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                        X
                    </button>
                </form>
                <h3 class="text-lg font-semibold">Link to Table</h3>
                <div class="qrcode flex max-w-[200px] justify-center mx-auto my-3"></div>
                <p class="qrcode-link text-center text-primary"></p>
            </article>
        </div>
    </dialog>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        async function updateEvent() {
            let url = "{{ route('manager.table.event') }}";
            let response = await fetch(url);
            let table = await response.json();

            let element = window.document.querySelector('#table_data');
            element.innerHTML = '';

            for (const obj of table) {
                let tr = `
                <tr class="hover">
                    <td>${obj.name}</td>
                    <td><button class="btn-sm btn-ghost" onclick="preview('${new URL('/customers/checkins/tables/' + obj.id, location.origin)}')">Preview</button></td>
                    <td class="flex space-x-3">
                        <a href="/managers/tables/${obj.id}/edit" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form action="/managers/tables/${obj.id}/destroy" method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Are you sure to delete ${obj.name} !!!???')">
                            @csrf
                            <button class="btn btn-error btn-outline btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>`

                element.insertAdjacentHTML('beforeend', tr);
            }
        }
        setInterval(updateEvent, 2000);

        const qrcode = new QRCode(document.querySelector('.qrcode'))
        function preview(link) {
            if (!link.startsWith('http')) {
               link = new URL(link, location.origin).toString();
            }

            qrcode.makeCode(link);
            previewer.showModal();
            document.querySelector('.qrcode-link').innerHTML = link;
        }

        window.addEventListener('load', function() {
            
        });
    </script>

    @if ($errors->any())
        <script>
            creator.showModal();
        </script>
    @endif
</x-app-layout>
