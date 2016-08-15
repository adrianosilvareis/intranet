angular.module('faturamento').controller('naoconformidades', function ($scope, objetoAPI, config, naoconformidades) {

    $scope.info = {};
    $scope.naoconformidades = [];

    $scope.alterarStatus = function (ncon) {
        ncon.ncon_status = (ncon.ncon_status == '1' ? '0' : '1');
        objetoAPI.saveObjeto(config.urlAPI + '/naoconformidade', ncon)
                .success(function (data) {
                    ncon = data;
                });
    };

    var init = function () {
        var data = naoconformidades.data;
        if (Array.isArray(data)) {
            $scope.naoconformidades = data;
        } else {
            $scope.info = data;
        }
    };

    init();
});