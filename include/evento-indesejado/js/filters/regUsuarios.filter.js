angular.module("eventoIndesejado").filter("regUsuarios", function () {
    return function (input, cadastro) {
        if (cadastro) {
            var map = input.map(function (reg) {
                return reg.user_cadastro;
            });
        } else {
            var map = input.map(function (reg) {
                return reg.user_recebimento;
            });
        }

        var verifica = [];
        var lista = [];
        map.filter(function (reg) {
            var pos = verifica.indexOf(reg);
            if (pos === -1) {
                verifica.push(reg);
                lista.push({user_id: reg, quant: 1});
            } else {
                var obj = lista[pos];
                var cont = obj.quant + 1;
                lista[pos] = {user_id: reg, quant: cont};
            }
        });

        return lista;
    };
});

