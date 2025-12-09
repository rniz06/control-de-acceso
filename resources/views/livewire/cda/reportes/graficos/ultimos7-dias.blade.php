<!-- BAR CHART -->

<x-adminlte-card title="Últimos 7 Días" theme="success" theme-mode="outline" icon="fas fa-chart-bar"
    header-class="text-uppercase rounded-bottom border-success" collapsible>
    <div class="chart">
        <canvas id="grafico-ultimos-7-dias"></canvas>
    </div>
</x-adminlte-card>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            const ctx = document.getElementById('grafico-ultimos-7-dias');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                            label: 'Ingresos',
                            data: @json($ingresos),
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        },
                        {
                            label: 'Salidas',
                            data: @json($salidas),
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false
                    // scales: {
                    //     y: {
                    //         beginAtZero: true,
                    //         ticks: {
                    //             precision: 0
                    //         }
                    //     }
                    // }
                }
            });
        });
    </script>
@endpush
