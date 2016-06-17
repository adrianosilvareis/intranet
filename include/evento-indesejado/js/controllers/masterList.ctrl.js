angular.module('ej').controller('masterList', function ($scope, objetoAPI, $routeParams, config) {

    $scope.title = "";
    $scope.status = "";

    var _users = [];
    var _registros = [];
    var _local = "";
    var _session = [];

    var init = function () {
        carregarSession();
        carregarRegistros();
        carregarUsers();
    };

    if ($routeParams.local) {
        _local = $routeParams.local;
    }

    var Registros = function (data) {
        //enviados

        if (_local === 'abertos_enviados') {
            $scope.title = "Enviado";
            $scope.status = "Aberto";
            $scope.registros = data.filter(function (reg) {
                return reg.reg_finalizado == '0' && _session.user_id == reg.user_cadastro;
            });
        }

        if (_local === 'fechados_enviados') {
            $scope.title = "Enviado";
            $scope.status = "Fechado";
            $scope.registros = data.filter(function (reg) {
                return reg.reg_finalizado == '1' && _session.user_id == reg.user_cadastro;
            });
        }

        if (_local === 'abertos_recebidos') {
            $scope.title = "Recebido";
            $scope.status = "Aberto";
            //recebidos
            $scope.registros = data.filter(function (reg) {
                return reg.reg_finalizado == '0' && _session.user_id == reg.user_recebimento || reg.reg_finalizado == '0' && _session.area_id == reg.area_recebimento;
            });
        }

        if (_local === 'fechados_recebidos') {
            $scope.title = "Recebido";
            $scope.status = "Fechado";
            $scope.registros = data.filter(function (reg) {
                return reg.reg_finalizado == '1' && _session.user_id == reg.user_recebimento || reg.reg_finalizado == '1' && _session.area_id == reg.area_recebimento;
            });
        }

    };

    var carregarUsers = function () {
        objetoAPI.getObjeto(config.apiURL + '/usuarios.api.php')
                .then(
                        function (success) {
                            _users = success.data;
                            _mixin();
                        },
                        function (error) {
                            console.log(error);
                        }
                );
    };

    var carregarSession = function () {
        objetoAPI.getObjeto(config.session)
                .then(
                        function (sucess) {
                            _session = sucess.data;
                        },
                        function (error) {
                            console.log(error);
                        });
    };

    var carregarRegistros = function () {
        objetoAPI.getObjeto(config.apiURL + '/registro.api.php')
                .then(
                        function (success) {
                            _registros = success.data;
                            _mixin();
                        },
                        function (error) {
                            console.log(error);
                        }
                );
    };

    var cont = 0;
    var _mixin = function () {
        cont++;
        if (cont === 2) {
            _users.filter(function (user) {
                _registros.map(function (reg) {
                    if (reg.user_recebimento === user.user_id)
                        reg.recebimento = user;

                    if (reg.user_cadastro === user.user_id)
                        reg.cadastro = user;

                    reg.reg_impacto_paciente == 1 ?
                            reg.impacto = "Sim" :
                            reg.impacto = "Não";

                });
            });
            Registros(_registros);
        }


    }

    init();
});