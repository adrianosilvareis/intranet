angular.module('faturamento').controller('naoconformidade', function ($scope, objetoAPI, config, $routeParams) {

    $scope.ncon = {};
    $scope.info = {};

    $scope.novo = function () {
        $scope.ncon = {};
    };

    $scope.save = function (ncon) {
        objetoAPI.saveObjeto(config.urlAPI + '/naoconformidade', ncon).success(success).error(error);
    };

    var init = function () {
        if ($routeParams.id) {
            carregarNaoConformidade($routeParams.id);
        }
    };

    var carregarNaoConformidade = function (id) {
        objetoAPI.getObjeto(config.urlAPI + '/naoconformidade/&id=' + id).success(function (data) {
            if (data.ncon_id) {
                $scope.ncon = data;
            } else {
                $scope.info = data;
            }
        }).error(error);
    };

    var success = function (data) {
        if (data.ncon_id) {
            $scope.ncon = data;
            $scope.info = {
                message: 'Não conformidade salva com sucesso!',
                status: '200'
            };
        } else {
            $scope.info = data;
        }
    };

    var error = function (error) {
        console.log(error);
        $scope.info = error;
    };

    init();

});