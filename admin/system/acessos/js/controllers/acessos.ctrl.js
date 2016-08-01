angular.module("itemPerfil").controller('acessos', function ($scope, objetoAPI, config, $routeParams) {

    $scope.acessos = [];
    $scope.carregando = config.URL.HOME + '/admin/css/carregando.gif';
    $scope.message = {};
    
    $scope.status = function (acesso) {
        acesso.acesso_status = !acesso.acesso_status;
        objetoAPI.saveObjeto(config.urlAPI + '/acesso', acesso).success(function (data) {
            $scope.message.mensage = "Status alterado com sucesso!";
            $scope.message.status = 200;
        }).error(error);
    };

    var carregarAcessos = function () {
        objetoAPI.getObjeto(config.urlAPI + '/acesso').success(success).error(error);
    };

    var success = function (data) {
        if (Array.isArray(data)) {
            $scope.acessos = data;
        } else {
            $scope.message = data;
        }
        $scope.carregando = false;
    };

    var error = function (error) {
        console.log(error);
    };

    carregarAcessos();
});