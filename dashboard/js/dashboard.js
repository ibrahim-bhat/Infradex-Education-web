$(document).ready(function() {
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const courseCtx = document.getElementById('courseDistribution').getContext('2d');

    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Revenue',
                data: [30000, 45000, 35000, 50000, 40000, 60000],
                borderColor: '#3498db',
                backgroundColor: 'rgba(52,152,219,0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    const courseChart = new Chart(courseCtx, {
        type: 'doughnut',
        data: {
            labels: ['Programming', 'Design', 'Business', 'Marketing'],
            datasets: [{
                data: [35, 25, 20, 20],
                backgroundColor: [
                    '#3498db',
                    '#2ecc71',
                    '#9b59b6',
                    '#e67e22'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 15
                    }
                }
            }
        }
    });

    $('.chart-filter').click(function() {
        $('.chart-filter').removeClass('active');
        $(this).addClass('active');
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        revenueChart.resize();
        courseChart.resize();
    });
}); 