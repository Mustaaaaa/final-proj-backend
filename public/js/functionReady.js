$(document).ready(function () {
    totalOrders();
    barChart();
    totalRevenue();
});
$('#timePeriod').change(function() {
    totalRevenue();
    totalOrders();
});