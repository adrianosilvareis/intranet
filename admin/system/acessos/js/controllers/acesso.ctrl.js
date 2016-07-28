angular.module("itemPerfil").controller('acesso', function ($scope, objetoAPI, config, $routeParams) {

    $scope.secoes = [];
    $scope.acesso = {};
    var _id = "";

    $scope.salvar = function (acesso) {
        console.log(acesso);
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
        console.log(config.urlAPI + "/acesso/&id=" + _id);
        $scope.acesso = data;
    };

    var error = function (error) {
        console.log('error');
        console.log(error);
    };

    init();
});