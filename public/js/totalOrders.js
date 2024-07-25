function totalOrders() {
    const timePeriod = $('#timePeriod').val();
    $.ajax({
        url: '/admin/pie-chart-revenue-order',
        method: 'GET',
        data: { timePeriod: timePeriod },
        dataType: 'json',
        success: function (response) {
            let companyData = response.companyData;
            const companyNames = {};

            companyData = companyData.filter(item => item.total_orders !== 0);

            companyData.forEach(item => {
                if (!companyNames[item.company_name]) {
                    companyNames[item.company_name] = 0;
                }
                companyNames[item.company_name]++;
            });

            const labels = Object.keys(companyNames);
            const dataValues = companyData.map(item => item.total_orders);
            const backgroundColors = labels.map(() => getRandomColor());

            const ctx = document.getElementById('pieChartOrder').getContext('2d');

            if (window.totalOrdersPieChart) {
                window.totalOrdersPieChart.destroy();
            }

            window.totalOrdersPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Numero ordini',
                        data: dataValues,
                        backgroundColor: backgroundColors
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                },
            });
        },
    });
}