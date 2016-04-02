angular.module("naoConformidade").controller("origem", function ($scope, objetoAPI, config) {

    $scope.origens = [];

    $scope.saveOrigem = function (origem) {
        objetoAPI.saveObjeto(config.apiURL + "/origem.api.php", origem).success(function (data, status) {
            delete $scope.origem;
            $scope.origemForm.$setPristine();
            carregarObjetos();
            $scope.message = data;
            if (status === 200) {
                console.log(data);
            }
        });
    };

    $scope.novaOrigem = function () {
        delete $scope.origem;
        $scope.origemForm.$setPristine();
    };

    $scope.origemId = function (origem) {
        origem.edited = true;
        $scope.origem = origem;
    };

    $scope.apagarOrigem = function (origem) {
        apagar = [origem];
        $scope.saveOrigem(apagar);
    };

    $scope.alterStatus = function (origem) {
        origem.origem_status = (origem.origem_status === "0" ? false : true);
        origem.origem_status = !origem.origem_status;
        origem.edited = true;
        $scope.saveOrigem(origem);
    };

    var carregarObjetos = function () {
        objetoAPI.getObjeto(config.apiURL + "/origem.api.php").success(function (data) {
            $scope.origens = data;
        });
    };

    carregarObjetos();
});