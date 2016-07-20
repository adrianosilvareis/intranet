angular.module('aplication').controller('control', function($scope, $http){
    
    $scope.lista = [];
    
    $scope.salvar = function(){
        $http.post('/intranet/api/teste/&').success(successGet).error(error);
    };
    
    $scope.remover = function(contato){
        $http.delete('/intranet/api/teste&id=' + contato._id).success(successDel).error(error);
        carregarTeste();
    };
    
    var carregarTeste = function(){
        $http.get('/intranet/api/teste').success(successGet).error(error);
    };
    
    var successDel = function(data){
        console.log(data);
    };
    
    var successGet = function(data){
        $scope.lista = data;
        console.log(data);
    };
    
    var error = function(error){
        console.log("error");
        console.log(error);
    };
    
    carregarTeste();
});