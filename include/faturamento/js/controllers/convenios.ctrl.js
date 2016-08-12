angular.module('faturamento').controller('convenios', function ($scope, config, objetoAPI) {

    $scope.info = {};
    $scope.conv = [];

    var carregarConvenios = function () {
        objetoAPI.getObjeto(config.urlAPI + '/convenios').success(success).error(error);
    };

    var success = function (data) {
        if (Array.isArray(data)) {
            $scope.conv = data;
        } else {
            $scope.info = data;
        }
    };

    var error = function (error) {
        console.log(error);
        $scope.info = error;
    };

    carregarConvenios();

});