appAgenda.controller("agendaContato", function ($scope, contatosAPI, setorAPI, objetoAPI, config) {

    $scope.contatos = [];
    $scope.setores = [];
    $scope.enderecos = [];
    $scope.estados = [];
    $scope.cidades = [];

    $scope.salvarContato = function (contato) {
        contatosAPI.saveContato(contato).success(function (data) {
            delete $scope.contato;
            $scope.contatoForm.$setPristine();
            carregarContatos();
            $scope.message = data;
        });
    };

    $scope.apagarContatos = function (contatos) {
        var apagar = contatos.filter(function (contato) {
            if (contato.selecionado)
                return contato;
        });

        contatosAPI.saveContato(apagar).success(function (data) {
            delete $scope.contato;
            $scope.contatoForm.$setPristine();
            carregarContatos();
            $scope.message = data;
        });
    };



    var carregarContatos = function () {
        contatosAPI.getContatos().success(function (data) {
            $scope.contatos = data;
        });
    };

    $scope.isContatoSelecionado = function (contatos) {
        return contatos.some(function (contato) {
            return contato.selecionado;
        });
    };

    $scope.isContatoEdited = function (contato) {
        if (contato.endereco_id !== null) {
            contato.endereco = $scope.enderecos.filter(function (endereco) {
                if (endereco.endereco_id === contato.endereco_id)
                    return endereco;
            })[0];
        }
        if (!angular.isUndefined(contato.endereco))
            $scope.isEnderecoEdited(contato.endereco);

        $scope.contato = contato;
        $scope.contato.edited = true;
    };

    $scope.vincularEndereco = function (contato) {
        $scope.contato.endereco_id = contato.endereco.endereco_id;
    };

    $scope.salvarEndereco = function (endereco) {
        objetoAPI.saveObjeto(config.apiURL + "/enderecos.api.php", endereco).success(function (data) {
            delete $scope.contato.endereco;
            $scope.enderecoForm.$setPristine();
            carregarEnderecos();
            $scope.message = data;
        });
    };

    $scope.apagarEnderecos = function (enderecos) {
        var apagar = enderecos.filter(function (endereco) {
            if (endereco.selecionado)
                return endereco;
        });

        objetoAPI.saveObjeto(config.apiURL + "/enderecos.api.php", apagar).success(function (data) {
            delete $scope.contato.endereco;
            $scope.enderecoForm.$setPristine();
            carregarEnderecos();
            $scope.message = data;
        });
    };

    var carregarEnderecos = function () {
        objetoAPI.getObjeto(config.apiURL + "/enderecos.api.php").success(function (data) {
            $scope.enderecos = data;
        });
    };

    $scope.isEnderecoEdited = function (endereco) {
        if (!$scope.contato) {
            $scope.contato = {};
            $scope.contato.endereco = {};
        }
        $scope.contato.endereco = endereco;
        $scope.contato.endereco.app_estado = uf(endereco)[0].cidade_uf;
        $scope.contato.endereco.edited = true;
    };

    var uf = function (endereco) {
        return $scope.cidades.filter(function (cidade) {
            if (endereco.app_cidade === cidade.cidade_id)
                return cidade;
        });
    };

    $scope.isEnderecoSelecionado = function (enderecos) {
        return enderecos.some(function (endereco) {
            return endereco.selecionado;
        });
    };

    $scope.ordernarPor = function (campo) {
        $scope.criterioDeOrdenacao = campo;
        $scope.direcaoDaOrdenacao = !$scope.direcaoDaOrdenacao;
    };

    var carregarSetores = function () {
        setorAPI.getSetor().success(function (data) {
            $scope.setores = data;
        });
    };

    var carregarEstados = function () {
        objetoAPI.getObjeto(config.apiURL + '/estados.api.php').success(function (data) {
            $scope.estados = data;
        });
    };

    var carregarCidades = function () {
        objetoAPI.getObjeto(config.apiURL + '/cidades.api.php').success(function (data) {
            $scope.cidades = data;
        });
    };

    carregarContatos();
    carregarSetores();
    carregarEnderecos();
    carregarEstados();
    carregarCidades();

});