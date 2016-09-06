angular.module("naoConformidade").controller('origens', function ($scope, origens, objetoAPI, config) {

    $scope.origens = [];

    var init = function () {
        $scope.message = {};
        $scope.message.send = "";
        $scope.message.class = "";
        $scope.message.status = 0;
        $scope.origens = origens.data;
    };

    $scope.AlterarStatus = function (origem) {
        var novoStatus = (origem.origem_status == '0' ? '1' : '0');
        origem.origem_status = novoStatus;
        salvar(origem);
    };

    var salvar = function (origem) {
        objetoAPI.saveObjeto(config.apiURL + "/origem", origem).success(function (data) {
            $scope.message.send = "Origem atualizada com sucesso!";
            $scope.message.class = "alert alert-success";
            $scope.message.status = 200;
        });
    };

    init();
});