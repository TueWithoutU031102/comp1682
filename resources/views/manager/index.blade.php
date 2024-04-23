<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manager dashboard') }}
        </h2>
    </x-slot>

    <div class="grid lg:grid-cols-2 gap-5 max-w-6xl mx-auto mt-5">
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <div id="cart-product-sold"></div>
            </div>
        </div>

        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <div id="daily-sale"></div>
            </div>
        </div>
    </div>

    <div class="card bg-base-100 max-w-6xl mx-auto mt-5 shadow">
        <div class="card-body">
            <div id="cart-product-sale"></div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const data = {
            sold: @json($menus->pluck('saled')),
            name: @json($menus->pluck('name')),
            sale: @json($menus->map(fn($menu) => $menu->price * $menu->saled)),
        }

        const daily = {
            label: @json($transaction->keys()),
            data: @json($transaction->values()->map(fn ($array) => $array->sum('total')))
        }

    console.log(daily)

        const formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        })

        window.addEventListener('load', () => {
            const apex = new ApexCharts(document.querySelector("#cart-product-sale"), {
                title: { text: 'Sales Product' },
                labels: data.name,
                dataLabels: { enabled: false },
                series: [{ name: 'Sales', data: data.sale, type: 'column' }],
                chart: { type: 'line', height: 350, toolbar: { show: false } },
                yaxis: [{ opposite: true, labels: { formatter: v => formatter.format(v) } }]
            })

            apex.render()
        })

        window.addEventListener('load', () => {
            const apex = new ApexCharts(document.querySelector("#cart-product-sold"), {
                theme: { palette: 'palette8' },
                title: { text: 'Product Sold' },
                labels: data.name,
                dataLabels: { enabled: true },
                series: data.sold,
                // series: [{ name: 'Sales', type: 'column', data: data.sold }],
                chart: { type: 'pie', height: 350, toolbar: { show: false } },
            })

            apex.render()
        })

        window.addEventListener('load', () => {
            const apex = new ApexCharts(document.querySelector("#daily-sale"), {
                theme: { palette: 'palette2' },
                title: { text: 'Daily Sales' },
                labels: daily.label,
                dataLabels: { enabled: false },
                series: [{ name: 'Sales', data: daily.data }],
                chart: { type: 'area', height: 350, toolbar: { show: false } },
                yaxis: [{ opposite: true, labels: { formatter: v => formatter.format(v) } }]
            })

            apex.render()
        })
    </script>
</x-app-layout>
