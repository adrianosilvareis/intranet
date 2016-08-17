angular.module('faturamento').controller('inconsistencias', function ($scope, inconsistencias, unidades, convenios, naoconformidades, atendentes) {

    $scope.info = {};
    $scope.limit = 5;
    $scope.inconsistencias = [];
    
    var init = function () {
        var data = inconsistencias.data;
        if (Array.isArray(data)) {
            $scope.inconsistencias = data;
            setAdicionais();
        } else {
            $scope.info = data;
        }
    };
    
    var setAdicionais = function () {
        var Unidades = (Array.isArray(unidades.data) ? unidades.data : []);
        var Convenios = (Array.isArray(convenios.data) ? convenios.data : []);
        var Atendentes = (Array.isArray(atendentes.data) ? atendentes.data : []);
        var Naoconformidades = (Array.isArray(naoconformidades.data) ? naoconformidades.data : []);

        $scope.inconsistencias.map(function (data) {
            //adiciona o posto
            data.unid = Unidades.filter(function (unid) {
                return data.postos_id === unid.postos_id;
            })[0];
            //adiciona o convenio
            data.conv = Convenios.filter(function (conv) {
                return data.conv_id === conv.conv_id;
            })[0];
            //adiciona atendente
            data.aten = Atendentes.filter(function (aten) {
                return data.aten_id === aten.user_id;
            })[0];
            //adiciona não conformidade
            data.ncon = Naoconformidades.filter(function (ncon) {
                return data.ncon_id === ncon.ncon_id;
            })[0];
            //adiciona faturista
            data.fatur = Atendentes.filter(function (aten) {
                return data.faturista_id === aten.user_id;
            })[0];
        });
    };
    
    init();
});