angular.module("filterDefault").filter("timestampBr", function () {
    return function (input) {
        var dataHora = input.split(" ");
        var data = dataHora[0];
        var hora = dataHora[1];

        var arrayData = data.split("-");
        var ano = arrayData[0];
        var mes = arrayData[1];
        var dia = arrayData[2];
        
        var dataFormatada = dia + "/" + mes + "/" + ano + " " + hora;
        return dataFormatada;
    };
});