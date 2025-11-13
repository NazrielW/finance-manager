<div class="bg-white p-6 rounded-lg shadow mt-6" style="max-width:400px;">
    <canvas id="donutChart" width="400" height="400"></canvas>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const income = {!! $income !!};
        const expense = {!! $expense !!};

        const data = {
            labels: ['Income', 'Expense'],
            datasets: [{
                label: 'Finance Overview',
                data: [income, expense],
                backgroundColor: ['#4CAF50', '#F44336'],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': $' + context.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById('donutChart'), config);
    });
</script>
