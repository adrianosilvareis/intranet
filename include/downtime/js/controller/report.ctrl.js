angular.module('downtime').controller('report', function ($scope, objetoAPI, config) {

    var datacolumn = [];
    var title = "Parada por equipamento";

    var carregarObjeto = function () {
        objetoAPI.getObjeto(config.apiURL + "/column_chart.api.php").success(function (data) {
            datacolumn = data;
            carregarGrafico();
        });
    };

    var carregarGrafico = function () {
        google.charts.setOnLoadCallback(drawChart(title, datacolumn));
    };

    function drawChart(title, datacolumn) {
        var data = google.visualization.arrayToDataTable(datacolumn);

        var options = {
            title: title,
            bar: {groupWidth: "95%"},
            legend: {position: "none"}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(data, options);
    }
    carregarObjeto();
});