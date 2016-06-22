angular.module("ej").controller('origens', function($scope, config, $http){
    
    $scope.origens = [];
    
    $scope.AlterarStatus = function(origem){
        //implementar a modificação no banco de dados
        var novoStatus = (origem.origem_status == '0' ? '1' : '0');
        origem.origem_status = novoStatus;
    };
    
    var carregarOrigens = function(){
        $http.get(config.apiURL + "/origem.api.php").success(function(data){
            $scope.origens = data;
        });
    };
    
    carregarOrigens();
});