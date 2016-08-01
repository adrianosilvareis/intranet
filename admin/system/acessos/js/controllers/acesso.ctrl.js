angular.module("itemPerfil").controller('acesso', function ($scope, objetoAPI, config, $routeParams) {

    $scope.secoes = [];
    $scope.acesso = {};
    $scope.message = false;
    $scope.carregando = config.URL.HOME + '/admin/css/carregando.gif';
    var _id = "";
    
    $scope.salvar = function (acesso) {
        objetoAPI.saveObjeto(config.urlAPI + '/acesso', acesso).success(function (data) {
            $scope.acesso = data;
            if (_id) {
                $scope.message = "Alterado com sucesso!";
            } else {
                $scope.message = "Adicionado com sucesso!";
            }
        }).error(error);
    };

    var carregarSecao = function () {
        objetoAPI.getObjeto(config.urlAPI + "/acesso/&join=true")
                .success(function (data) {
                    if (Array.isArray(data)) {
                        $scope.secoes = data;
                    } else {
                        $scope.secoes = [
                            {acesso_id:"NULL",
                                acesso_title: "Cadastre uma seção!" }
                        ];
                    }

                    $scope.carregando = false;
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
        $scope.carregando = false;
    };

    var error = function (error) {
        console.log('error');
        console.log(error);
    };

    init();
});