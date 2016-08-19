angular.module('faturamento').controller('particular', function ($scope, particular, unidades, atendentes) {

    $scope.particulares = [];
    $scope.info = {};
    $scope.limit = 5;

    var init = function () {
        var data = particular.data;
        if (Array.isArray(data)) {
            $scope.particulares = data;
            setAdicionais();
        } else {
            $scope.info = data;
        }
    };

    var setAdicionais = function () {
        var Unidades = (Array.isArray(unidades.data) ? unidades.data : []);
        var Atendentes = (Array.isArray(atendentes.data) ? atendentes.data : []);

        $scope.particulares.map(function (data) {
            //adiciona o posto
            data.unid = Unidades.filter(function (unid) {
                return data.unid_id === unid.postos_id;
            })[0];
            //adiciona atendente
            data.aten = Atendentes.filter(function (aten) {
                return data.aten_id === aten.user_id;
            })[0];
        });
    };

    init();
});