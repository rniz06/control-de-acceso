<!-- BAR CHART -->
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Últimos 7 Días</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="grafico-ultimos-7-dias"></canvas>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

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
