angular.module("naoConformidade").controller('origens', function ($scope, config, $http) {

    $scope.origens = [];

    var init = function () {
        $scope.message = {};
        $scope.message.send = "";
        $scope.message.class = "";
        $scope.message.status = 0;
    };

    $scope.AlterarStatus = function (origem) {
        var novoStatus = (origem.origem_status == '0' ? '1' : '0');
        origem.origem_status = novoStatus;
        salvar(origem);
    };

    var carregarOrigens = function () {
        $http.get(config.apiURL + "/origem").success(function (data) {
            $scope.origens = data;
        });
    };

    var salvar = function (origem) {
        $http.post(config.apiURL + "/origem", origem).success(function (data) {
            $scope.message.send = "Origem atualizada com sucesso!";
            $scope.message.class = "alert alert-success";
            $scope.message.status = 200;
        });
    };
    
    init();
    carregarOrigens();
});