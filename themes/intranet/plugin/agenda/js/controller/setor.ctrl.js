appAgenda.controller("agendaSetor", function ($scope, setorAPI, objetoAPI, config) {

    $scope.setores = [];
    $scope.types = [];

    var BroadCast = function (msg) {
        $scope.$emit('handleEmit', {setores: msg});
    };

    $scope.salvarSetor = function (setor) {
        setorAPI.saveSetor(setor).success(function (data) {
            delete $scope.setor;
            carregarSetores();
            $scope.message = data;
        });
    };

    $scope.apagarSetores = function (setores) {
        var apagar = setores.filter(function (setor) {
            if (setor.selecionado)
                return setor;
        });

        setorAPI.saveSetor(apagar).success(function (data) {
            delete $scope.setor;
            carregarSetores();
            $scope.message = data;
        });
    };

    var carregarSetores = function () {
        setorAPI.getSetor().success(function (data) {
            $scope.setores = data;
            BroadCast(data);
        });
    };

    var carregarTypes = function () {
        objetoAPI.getObjeto(config.apiURL + "/setor_type.api.php").success(function (data) {
            $scope.types = data;
        });
    };

    $scope.isSetorEdited = function (setor) {
        $scope.setor = setor;
        $scope.setor.edited = true;
    };

    $scope.isSetorSelecionado = function (setores) {
        return setores.some(function (contato) {
            return contato.selecionado;
        });
    };

    $scope.ordernarPor = function (campo) {
        $scope.criterioDeOrdenacao = campo;
        $scope.direcaoDaOrdenacao = !$scope.direcaoDaOrdenacao;
    };

    carregarSetores();
    carregarTypes();
});