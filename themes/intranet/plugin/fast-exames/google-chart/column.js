
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
    var data = google.visualization.arrayToDataTable(datacolumn);

    var options = {
        title: "Exames por usuario",
        bar: {groupWidth: "95%"},
        legend: {position: "none"}
    };

    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
    chart.draw(data, options);
}