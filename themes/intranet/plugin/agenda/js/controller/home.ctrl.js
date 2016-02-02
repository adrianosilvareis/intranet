appAgenda.controller("agenda", function ($scope, objetoAPI, config) {

    $scope.contatos = [];
    $scope.enderecos = [];
    $scope.setores = [];
    $scope.cidades = [];

    $scope.carregarListas = function () {

        objetoAPI.getObjeto(config.apiURL + "/setores.api.php").success(function (data) {
            $scope.setores = data;
        });
        objetoAPI.getObjeto(config.apiURL + "/contatos.api.php").success(function (data) {
            data.map(function (contato) {
                contato.setor = $scope.setores.filter(function (setor) {
                    if (setor.setor_id === contato.setor_id) {
                        return setor;
                    }
                })[0];
            });
            $scope.contatos = data;
        });
        objetoAPI.getObjeto(config.apiURL + "/enderecos.api.php").success(function (data) {
            $scope.enderecos = data;
        });
        objetoAPI.getObjeto(config.apiURL + "/cidades.api.php").success(function (data) {
            $scope.cidades = data;
        });
    };

    $scope.carregarListas();

});