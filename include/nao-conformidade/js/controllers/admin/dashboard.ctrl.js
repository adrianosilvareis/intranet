angular.module('naoConformidade').controller('dashboard', function ($scope, $http, config, $filter) {

    //
    //Variaveis
    //
    $scope.list = [];
    $scope.limit = 5;
    $scope.registros = [];
    $scope.regAtivos = [];
    $scope.userReg = [];
    $scope.areaReg = [];
    $scope.carregando = true;
    $scope.tipo = {};
    $scope.tipo.title = "aguardando resposta";

    //
    //Funções decarregamento
    //
    var carregarRegistros = function () {
        $http.get(config.apiURL + "/registroDashboard").success(function (data) {
            $scope.registros = data;
            $scope.totalRegistros = data.length;
            $scope.regAtivos = $filter("regAtivo")(data);
            $scope.totalRegistrosAbertos = $scope.regAtivos.length;
            $scope.list = $scope.regAtivos;
            
            $scope.userReg = $filter('regUsuarios')($scope.regAtivos);
            $scope.areaReg = $filter('regAreas')($scope.regAtivos);
            _pCent($scope.userReg);
            _pCent($scope.areaReg);
            
            $scope.carregando = false;
        });
    };
    
    $scope.listTipo = function(){
        if(!$scope.tipo.status){
            $scope.tipo.title = "registrados";
            $scope.list = $scope.registros;
        }else{
            $scope.tipo.title = "aguardando resposta";
            $scope.list = $scope.regAtivos;
        }
        
        $scope.tipo.status = !$scope.tipo.status;
    };
    
    var _pCent = function (loop) {
        loop.map(function (data) {
            var conta = data.quant * 100 / $scope.totalRegistrosAbertos;
            data.pcent = parseFloat(conta.toFixed(2)) + "%";
        });
    };

    //
    // iniciar controller
    //
    carregarRegistros();

});