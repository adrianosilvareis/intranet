angular.module('faturamento').controller('inconsistencias', function ($scope, config, objetoAPI) {

    $scope.info = {};
    $scope.incos = [];
    
    var carregarInconsistencias = function () {
        objetoAPI.getObjeto(config.urlAPI + '/inconsistencias').success(success).error(error);
    };

    var success = function (data) {
        if (Array.isArray(data)) {
            $scope.incos = data;
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