<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manager dashboard') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 max-w-6xl mx-auto mt-5 shadow">
        <div class="card-body">
            <div id="cart-product-sold"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const renderSaleOfProduct = () => {
            const data = {
                sold: @json($menus->pluck('saled')),
                name: @json($menus->pluck('name')),
                sale: @json($menus->map(fn($menu) => $menu->price * $menu->saled)),
            }

            const series = [{
                    name: 'Product Sold',
                    type: 'column',
                    data: data.sold
                },
                {
                    name: 'Sale',
                    type: 'line',
                    data: data.sale
                },
            ]

            const formatter = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            })

            const options = {
                series,
                title: {
                    text: 'Sale & sold products'
                },
                chart: {
                    height: 400,
                    type: 'line',
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: true,
                    enabledOnSeries: [1]
                },
                labels: data.name,
                stroke: {
                    width: [1, 4]
                },

                xaxis: {
                    type: 'text'
                },
                yaxis: [{
                        title: {
                            text: 'Sold'
                        },
                        labels: {
                            formatter: (val) => val.toFixed(0)
                        }
                    },
                    {
                        opposite: true,
                        title: {
                            text: 'Sale'
                        },
                        labels: {
                            formatter: (val) => formatter.format(val)
                        }
                    },
                ]
            }

            new ApexCharts(document.querySelector("#cart-product-sold"), options).render()
        }

        window.addEventListener('load', renderSaleOfProduct)
    </script>
</x-app-layout>
