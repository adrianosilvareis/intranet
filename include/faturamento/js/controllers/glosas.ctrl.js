angular.module('faturamento').controller('glosas', function ($scope, config, objetoAPI) {

    $scope.info = {};
    $scope.glos = [];

    var carregarInconsistencias = function () {
        objetoAPI.getObjeto(config.urlAPI + '/glosas').success(success).error(error);
    };

    var success = function (data) {
        if (Array.isArray(data)) {
            $scope.glos = data;
        } else {
            $scope.info = data;
        }
    };

    var error = function (error) {
        console.log(error);
        $scope.info = error;
    };

    carregarInconsistencias();
});