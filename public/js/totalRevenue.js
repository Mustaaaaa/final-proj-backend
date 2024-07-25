function totalRevenue() {
    const timePeriod = $('#timePeriod').val();
    $.ajax({
        url: '/admin/pie-chart-revenue-order',
        method: 'GET',
        data: { timePeriod: timePeriod },
        dataType: 'json',
        success: function (response) {
            let companyData = response.companyData;
            const companyNames = {};

            companyData = companyData.filter(item => item.total_revenue !== 0);

            companyData.forEach(item => {
                if (!companyNames[item.company_name]) {
                    companyNames[item.company_name] = 0;
                }
                companyNames[item.company_name]++;
            });

            const labels = Object.keys(companyNames);
            const dataValues = companyData.map(item => item.total_revenue);
            const backgroundColors = labels.map(() => getRandomColor());

            const ctx = document.getElementById('pieChartRevenue').getContext('2d');

            if (window.revenuePieChart) {
                window.revenuePieChart.destroy();
            }

            window.revenuePieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Guadagni (€)',
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