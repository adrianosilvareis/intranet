angular.module('ej').controller('registros', function ($scope, objetoAPI, config) {
    $scope.registros = [];
    $scope.users = [];

    var init = function () {
        carregarRegistros();
        carregarUsers();
    };

    var carregarRegistros = function () {
        objetoAPI.getObjeto(config.apiURL + '/registro.api.php')
                .then(
                        function (success) {
                            $scope.registros = success.data;
                        },
                        function (error) {
                            console.log(error);
                        }
                );
    };

    var carregarUsers = function () {
        objetoAPI.getObjeto(config.apiURL + '/usuarios.api.php')
                .then(
                        function (success) {
                            $scope.users = success.data;
                        },
                        function (error) {
                            console.log(error);
                        }
                );
    };

    init();
});