angular.module('ej').controller('masterList', function ($scope, objetoAPI, $routeParams, config) {

    $scope.title = "";
    $scope.status = "";

    $scope.users = [];
    var local = "";
    var session = [];

    var init = function () {
        carregarSession();
        carregarRegistros();
        carregarUsers();
    };

    if ($routeParams.local) {
        local = $routeParams.local;
    }

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

    var registros = function (data) {
        //enviados

        if (local === 'abertos_enviados') {
            $scope.title = "Enviado";
            $scope.status = "Aberto";
            $scope.registros = data.filter(function (reg) {
                return reg.reg_finalizado == '0' && session.user_id == reg.user_cadastro;
            });
        }

        if (local === 'fechados_enviados') {
            $scope.title = "Enviado";
            $scope.status = "Fechado";
            $scope.registros = data.filter(function (reg) {
                return reg.reg_finalizado == '1' && session.user_id == reg.user_cadastro;
            });
        }

        if (local === 'abertos_recebidos') {
            $scope.title = "Recebido";
            $scope.status = "Aberto";
            //recebidos
            $scope.registros = data.filter(function (reg) {
                return reg.reg_finalizado == '0' && session.user_id == reg.user_recebimento || reg.reg_finalizado == '0' && session.area_id == reg.area_recebimento;
            });
        }

        if (local === 'fechados_recebidos') {
            $scope.title = "Recebido";
            $scope.status = "Fechado";
            $scope.registros = data.filter(function (reg) {
                return reg.reg_finalizado == '1' && session.user_id == reg.user_recebimento || reg.reg_finalizado == '1' && session.area_id == reg.area_recebimento;
            });
        }

    };

    var carregarSession = function () {
        objetoAPI.getObjeto(config.session)
                .then(
                        function (sucess) {
                            session = sucess.data;
                        },
                        function (error) {
                            console.log(error);
                        });
    };

    var carregarRegistros = function () {
        objetoAPI.getObjeto(config.apiURL + '/registro.api.php')
                .then(
                        function (success) {
                            registros(success.data);
                        },
                        function (error) {
                            console.log(error);
                        }
                );
    };

    init();
});