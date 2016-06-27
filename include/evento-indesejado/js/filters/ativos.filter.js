angular.module('eventoIndesejado').filter("regAtivo", function () {
    return function (input, size) {

        var _ativos = input.filter(function (reg) {
            return reg.reg_finalizado == '0';
        });

        if (size) {
            return _ativos.length;
        } else {
            return _ativos;
        }
    };
});