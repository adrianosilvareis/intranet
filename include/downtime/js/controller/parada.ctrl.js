appDt.controller("parada", function ($scope, objetoAPI, config) {

    $scope.equipamentos = [];
    $scope.time = "";

    //BroadCast Recebendo equipamentos carregados da API em outro controller
    $scope.$on('handleBroadcast', function (event, args) {
        if (args.equipamentos)
            $scope.equipamentos = args.equipamentos;
    });
    
    var carregarEquipamentos = function(){
        objetoAPI.saveObjeto(config.apiURL + "/equip.api.php").success(function(data){
            $scope.equipamentos = data;
            
        });
    };
    
    var saveParada = function (parada) {
        objetoAPI.saveObjeto(config.apiURL + "/time.api.php", parada).success(function (data) {
            console.log(data);
            carregarEquipamentos();
        });
    };

    $scope.update = function (equip) {
        saveParada(equip);
    };

});