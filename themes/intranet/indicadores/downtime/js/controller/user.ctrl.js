angular.module("downtime").controller("user", function ($scope, objetoAPI, config) {
    $scope.times = [];
    $scope.equipamentos = [];
    
    var carregarListas = function(){
        objetoAPI.getObjeto(config.apiURL + "");
    };
    
    carregarListas();
});