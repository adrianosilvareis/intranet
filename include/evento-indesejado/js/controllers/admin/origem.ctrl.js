angular.module("ej").controller('origem', function ($scope, $routeParams, $http, config) {
    $scope.origem = {};
    var origens = [];

    var init = function () {
        $scope.message = {};
        $scope.message.send = "";
        $scope.message.class = "";
        $scope.message.status = 0;
        carregarOrigens();
    };

    var params = function () {
        if ($routeParams.id) {
            var idOrigem = $routeParams.id;

            $scope.origem = origens.filter(function (origem) {
                return idOrigem == origem.origem_id;
            })[0];

            if ($scope.origem) {
                $scope.origem.edited = true;
                $scope.message.send = "";
                $scope.message.class = "";
                $scope.message.status = 200;
            } else {
                $scope.message.send = "Origem não encontrada";
                $scope.message.class = "alert alert-danger";
                $scope.message.status = 404;
            }
        }
    };

    var carregarOrigens = function () {
        $http.get(config.apiURL + "/origem.api.php").success(function (data) {
            origens = data;
            params();
        });
    };

    $scope.salvar = function (origem) {
        $http.post(config.apiURL + "/origem.api.php", origem).success(function (data) {
            origem.edited ?
                    $scope.message.send = "Origem atualizada com sucesso!"
                    : $scope.message.send = "Origem adicionado com sucesso!";
                    
            $scope.message.class = "alert alert-success";
            $scope.message.status = 200;
            
            delete origem;
        });
    };

    init();

});