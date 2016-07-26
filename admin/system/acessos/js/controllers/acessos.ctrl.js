angular.module("itemPerfil").controller('acessos', function ($scope, objetoAPI, config, $routeParams) {

    $scope.acessos = [];
    
    $scope.status = function(acesso){
        acesso.acesso_status = !acesso.acesso_status;
        
        console.log(acesso.acesso_status);
    };
    
    var carregarAcessos = function () {
        objetoAPI.getObjeto(config.urlAPI + '/acesso').success(success).error(error);
    };

    var success = function (data) {
        $scope.acessos = data;
    };

    var error = function (error) {
        console.log(error);
    };
    
    carregarAcessos();
});