angular.module("naoConformidade").controller("registro", function ($scope, objetoAPI, config) {

    $scope.origens = [];
    $scope.setores = [];
    $scope.usuarios = [];

    $scope.carregarObjetos = function () {
        objetoAPI.getObjeto(config.apiURL + "/origem.api.php").success(function (data) {
            $scope.origens = data;
        });

        objetoAPI.getObjeto(config.apiURL + "/setor.api.php").success(function (data) {
            $scope.setores = data;
        });

        objetoAPI.getObjeto(config.apiURL + "/usuarios.api.php").success(function (data) {
            $scope.usuarios = data;
        });
    };


    $scope.saveRegistro = function (registro) {
        objetoAPI.saveObjeto(config.apiURL + "/registro.api.php", registro).success(function (data) {
            console.log(data);
        });
    };

    $scope.novoRegistro = function () {
        delete $scope.registro;
    };

    $scope.carregarObjetos();
});