angular.module('eventoIndesejado').controller('dashboard', function ($scope, $routeParams, $http, config, $filter) {

    //
    //Variaveis
    //
    $scope.registros = [];
    $scope.regAtivos = [];
    $scope.userReg = [];
    $scope.areaReg = [];


    //
    //Funções decarregamento
    //
    var carregarRegistros = function () {
        $http.get(config.apiURL + "/registroDashboard.api.php").success(function (data) {
            $scope.registros = data;
            $scope.totalRegistros = data.length;
            $scope.regAtivos = $filter("regAtivo")(data);
            $scope.totalRegistrosAbertos = $scope.regAtivos.length;
            
            $scope.userReg = $filter('regUsuarios')($scope.regAtivos);
            $scope.areaReg = $filter('regAreas')($scope.regAtivos);
            _pCent($scope.userReg);
            _pCent($scope.areaReg);
        });
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