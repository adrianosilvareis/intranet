appNCon.controller("setor", function($scope, objetoAPI, config){
    $scope.setores = [];
    
    var carregarObjetos = function(){
        objetoAPI.getObjeto(config.apiURL + "/setor.api.php").success(function(data){
            $scope.setores = data;
        });
    }
    
    carregarObjetos();
});