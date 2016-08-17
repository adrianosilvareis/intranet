angular.module("filterDefault").filter("dateBr", function () {
    return function (input) {
        if (!input) {
            return input;
        }

        var arrayData = input.split("-");
        var ano = arrayData[0];
        var mes = arrayData[1];
        var dia = arrayData[2];

        var dataFormatada = dia + "/" + mes + "/" + ano;
        return dataFormatada;
    };
});