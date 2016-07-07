angular.module("eventoIndesejado").filter("regAreas", function () {
    return function (input) {
        var map = input.map(function (reg) {
            return reg.area_title;
        });
        
        var verifica = [];
        var lista = [];
        map.filter(function (reg) {
            var pos = verifica.indexOf(reg);
            if(pos === -1){
                verifica.push(reg);
                lista.push({area_id:reg,quant:1});
            }else{
                var obj = lista[pos];
                var cont = obj.quant + 1;
                lista[pos] = {area_id:reg,quant:cont};
            }
        });

        return lista;
    };
});

