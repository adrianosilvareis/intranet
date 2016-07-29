angular.module("itemPerfil").controller('acesso', function ($scope, objetoAPI, config, $routeParams) {

    $scope.secoes = [];
    $scope.acesso = {};
    var _id = "";

    $scope.salvar = function (acesso) {
       objetoAPI.saveObjeto(config.urlAPI + '/acesso', acesso).success(function(data){
           //apos os testes receber o acesso
           $scope.acesso = data;
       }).error(error);
    };

    var carregarSecao = function () {
        objetoAPI.getObjeto(config.urlAPI + "/acesso/&join=true")
                .success(function (data) {
                    $scope.secoes = data;
                })
                .error(error);
    };

    var carregarAcesso = function () {
        objetoAPI.getObjeto(config.urlAPI + "/acesso/&id=" + _id)
                .success(success)
                .error(error);
    };

    var init = function () {
        _id = $routeParams.id;
        if (_id)
            carregarAcesso();
        carregarSecao();
    };

    var success = function (data) {
        $scope.acesso = data;
    };

    var error = function (error) {
        console.log('error');
        console.log(error);
    };

    init();
});