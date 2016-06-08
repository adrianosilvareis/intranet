angular.module('ej').controller('registro', function ($scope, objetoAPI, config, $routeParams) {
    $scope.registros = [];
    $scope.origens = [];
    $scope.users = [];
    $scope.reg = {};

    var _registerHasOrigens = [];
    var _registerHasFile = [];
    var _registerHasImage = [];

    var init = function () {
        carregarRegistros();
        carregarUsers();
    };

    var params = function () {
        if ($routeParams.regId) {
            var idRegistro = $routeParams.regId;
            var registro = $scope.registros.filter(function (reg) {
                return reg.reg_id == idRegistro;
            })[0];
            registro ?
                    $scope.reg = registro :
                    $scope.message = 'Registro não encontrado';

            $scope.reg.disabled = true;
            carregarOther();
        }
    };

    var cont = 0;
    var complete = function () {
        cont++;
        if (cont == 4) {

            $scope.reg.files = [];
            $scope.reg.files = _registerHasFile.filter(function (file) {
                return file.reg_id == $scope.reg.reg_id;
            });

            $scope.reg.images = [];
            $scope.reg.images = _registerHasImage.filter(function (image) {
                return image.reg_id == $scope.reg.reg_id;
            });


            var origens = _registerHasOrigens.filter(function (origem) {
                return origem.reg_id == $scope.reg.reg_id;
            });


            $scope.reg.origens = [];
            origens.filter(function (origem) {
                $scope.reg.origens = $scope.origens.filter(function (ori) {
                    return ori.origem_id == origem.origem_id;
                });
            });
        }
    };

    var carregarOther = function () {

        objetoAPI.getObjeto(config.apiURL + "/registroHasOrigem.api.php").success(function (data) {
            _registerHasOrigens = data;
            complete();
        });

        objetoAPI.getObjeto(config.apiURL + "/registroHasFile.api.php").success(function (data) {
            _registerHasFile = data;
            complete();
        });

        objetoAPI.getObjeto(config.apiURL + "/registroHasImage.api.php").success(function (data) {
            _registerHasImage = data;
            complete();
        });

        objetoAPI.getObjeto(config.apiURL + "/origem.api.php").success(function (data) {
            $scope.origens = data;
            complete();
        });
    };

    var carregarRegistros = function () {
        objetoAPI.getObjeto(config.apiURL + '/registro.api.php')
                .then(
                        function (success) {
                            $scope.registros = success.data;
                            params();
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