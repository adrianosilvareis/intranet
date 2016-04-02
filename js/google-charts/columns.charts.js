/**
 * google charts
 * column
 */
google.charts.setOnLoadCallback(drawColumnChart);
function drawColumnChart() {
    if (typeof datacolumn !== "undefined") {
        var data = google.visualization.arrayToDataTable(datacolumn);

        var options = {
            title: titlecolumn,
            bar: {groupWidth: "95%"},
            legend: {position: "none"}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(data, options);
    }
}
