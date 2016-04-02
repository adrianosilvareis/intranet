/**
 * google charts
 * donut
 */
google.charts.setOnLoadCallback(drawDonutChart);
function drawDonutChart() {
    if (typeof datadonut !== "undefined") {
        var data = google.visualization.arrayToDataTable(datadonut);

        var options = {
            title: titledonut,
            pieHole: 0.4
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
}