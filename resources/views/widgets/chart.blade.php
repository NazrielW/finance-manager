<div class="bg-white p-6 rounded-lg shadow mt-6">
    <h3 class="font-bold mb-4 text-gray-700">Transaction Chart</h3>
    <canvas id="transactionChart" height="100"></canvas>
</div>

<script type="module">
    const ctx = document.getElementById('transactionChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($transactionData->pluck('date')),
            datasets: [{
                label: 'Total Transaction (Rp)',
                data: @json($transactionData->pluck('total')),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>