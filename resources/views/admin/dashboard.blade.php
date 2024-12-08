<x-adminlayouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="card" style="width: 500px; margin-left: 25%; margin-top: 5%; padding: 20px; text-align: center;">
        <h3>Monthly Patient Visits & System Users</h3>
        <canvas id="combinedChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Set up the data for the combined line chart showing both patient visits and system users per month
        var ctx = document.getElementById('combinedChart').getContext('2d');
        var combinedChart = new Chart(ctx, {
            type: 'line', // Line graph type to track progress over time
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'], // X-axis (Months)
                datasets: [{
                        label: 'Patient Visits', // Dataset for Patient Visits
                        data: [30, 45, 50, 60, 55, 70], // Y-axis (Number of patient visits per month)
                        borderColor: '#4caf50', // Line color (green for visits)
                        fill: false, // No fill under the line
                        tension: 0.1, // Smoothness of the line
                        pointRadius: 5, // Size of the data points
                        pointBackgroundColor: '#4caf50', // Color of the points
                    },
                    {
                        label: 'System Users', // Dataset for System Users
                        data: [150, 200, 250, 300, 350, 400], // Y-axis (Number of system users per month)
                        borderColor: '#3b82f6', // Line color (blue for users)
                        fill: false, // No fill under the line
                        tension: 0.1, // Smoothness of the line
                        pointRadius: 5, // Size of the data points
                        pointBackgroundColor: '#3b82f6', // Color of the points
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Months' // Label for the X-axis
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Visits / Users' // Label for the Y-axis
                        },
                        suggestedMin: 0, // Minimum value for the Y-axis
                        suggestedMax: 500 // Maximum value for the Y-axis (adjust as needed)
                    }
                },
                plugins: {
                    tooltip: {
                        enabled: true // Enable tooltips to show data when hovering
                    },
                    legend: {
                        display: true // Display the legend to distinguish between Patient Visits and System Users
                    }
                },
                animation: {
                    duration: 1000, // Duration of the animation for smooth transition
                    easing: 'easeInOutQuad' // Smooth easing for the animation
                }
            }
        });
    </script>

</x-adminlayouts.app>