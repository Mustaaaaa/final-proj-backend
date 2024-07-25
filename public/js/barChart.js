let chart;
function barChart() {
    $.ajax({
        url: '/admin/bar-chart',
        method: 'GET',
        dataType: 'json',
        data: {
            'company': $("#company").val(),
            'from': $("#from").val(),
            'to': $("#to").val(),
        },
        success: function (data) {
            const companyData = data.companyData;
            const labels = companyData.map(item => item.period);
            const totalOrders = companyData.map(item => item.total_orders);
            const orderCounts = companyData.map(item => item.order_count);

            const ctx = document.getElementById('barChart').getContext('2d');

            if (chart) {
                chart.destroy();
            }

            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Guadagni (€)',
                            data: totalOrders,
                            backgroundColor: 'rgb(252, 183, 33, 0.6)',
                            yAxisID: 'y',
                        },
                        {
                            label: 'Numero ordini',
                            data: orderCounts,
                            backgroundColor: 'rgb(24, 71, 93, 0.6',
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Euro €'
                            }
                        },
                        y1: {
                            beginAtZero: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Numero ordini'
                            },
                            grid: {
                                drawOnChartArea: false,
                            },
                        }

                    }
                }
            });
        },

    });
}