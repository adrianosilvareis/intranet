appAgenda.controller("user", function ($scope, objetoAPI, config) {
    $scope.contatos = [];
    $scope.setores = [];
    $scope.enderecos = [];
    $scope.cidades = [];
    $scope.carregando = false;
    
    $scope.setorSelecionado = function (setor) {
        $scope.setor = setor;
    };

    $scope.contatoSelecionado = function (contato) {
        contato.endereco = $scope.enderecos.filter(function (endereco) {
            if (contato.endereco_id === endereco.endereco_id) {
                endereco.cidade = $scope.cidades.filter(function (cidade) {
                    if (endereco.app_cidade === cidade.cidade_id)
                        return cidade;
                })[0];
                return endereco;
            }

        })[0];

        $scope.contato = contato;
    };

    $scope.limparContato = function () {
        $scope.contato = null;
    };

    $scope.ordernarPor = function (campo) {
        $scope.criterioDeOrdenacao = campo;
        $scope.direcaoDaOrdenacao = !$scope.direcaoDaOrdenacao;
    };

    var carregarListas = function () {
        objetoAPI.getObjeto(config.apiURL + "/contatos.api.php").success(function (data) {
            $scope.contatos = data;
        });

        objetoAPI.getObjeto(config.apiURL + "/setores.api.php").success(function (data) {
            $scope.setores = data;
        });

        objetoAPI.getObjeto(config.apiURL + "/enderecos.api.php").success(function (data) {
            $scope.enderecos = data;
        });

        objetoAPI.getObjeto(config.apiURL + "/cidades.api.php").success(function (data) {
            $scope.cidades = data;
        });
        $scope.carregando = true;
    };

    carregarListas();
});