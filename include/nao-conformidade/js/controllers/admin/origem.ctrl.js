angular.module("naoConformidade").controller('origem', function ($scope, origem, objetoAPI, config) {
    $scope.origem = {};

    var init = function () {
        $scope.message = {};
        $scope.message.send = "";
        $scope.message.class = "";
        $scope.message.status = 0;
        $scope.origem = origem.data;
    };

    $scope.salvar = function (origem) {
        objetoAPI.saveObjeto(config.apiURL + "/origem", origem).success(function (data) {
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