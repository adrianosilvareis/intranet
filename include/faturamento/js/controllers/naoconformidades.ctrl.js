angular.module('faturamento').controller('naoconformidades', function ($scope, config, objetoAPI) {

    $scope.info = {};
    $scope.ncon = [];

    var carregarNcon = function () {
        objetoAPI.getObjeto(config.urlAPI + '/naoconformidade').success(success).error(error);
    };

    var success = function (data) {
        if (Array.isArray(data)) {
            $scope.ncon = data;
        } else {
            $scope.info = data;
        }
    };

    var error = function (error) {
        console.log(error);
        $scope.info = error;
    };

    carregarNcon();
});