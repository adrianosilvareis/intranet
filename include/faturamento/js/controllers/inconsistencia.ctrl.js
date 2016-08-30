angular.module('faturamento').controller('inconsistencia', function ($scope, config, objetoAPI, $routeParams, unidades, convenios, atendentes, naoconformidades) {

    $scope.inco = {};
    $scope.info = {};
    $scope.unidades = (Array.isArray(unidades.data) ? unidades.data : []);
    $scope.convenios = (Array.isArray(convenios.data) ? convenios.data : []);
    $scope.atendentes = (Array.isArray(atendentes.data) ? atendentes.data : []);
    $scope.naoconformidades = (Array.isArray(naoconformidades.data) ? naoconformidades.data : []);

    var init = function () {
        if ($routeParams.id) {
            carregarInconsistencia($routeParams.id);
        }
    };

    var carregarInconsistencia = function (id) {
        objetoAPI.getObjeto(config.urlAPI + '/inconsistencias&id=' + id)
                .success(function (data) {
                    if (data.inco_id) {
                        $scope.inco = data;
                        setAdicionais(data);
                    } else {
                        $scope.info = data;
                    }
                })
                .error(function (error) {
                    console.log(error);
                });
    };

    $scope.novo = function () {
        $scope.inco = {};
        $scope.info = {};
        $scope.incoForm.$setPristine();
    };

    $scope.save = function (inco) {
        objetoAPI.saveObjeto(config.urlAPI + '/inconsistencias', inco)
                .success(function (data) {
                    if (data.inco_id) {
                        $scope.inco = data;
                        setAdicionais(data);
                        $scope.info = {
                            message: 'Inconsistência salva com sucesso!',
                            status: '200'
                        };
                        $scope.incoForm.$setPristine();
                    } else {
                        console.log(data);
                    }
                })
                .error(function (error) {
                    console.log(error);
                });
    };

    $scope.carregaImg = function (url) {
        return config.tiny + config.URL.HOME + "/uploads/" + url + "&w=50&h=50";
    };

    $scope.addConvenio = function (conv) {
        $scope.inco.conv_id = conv.conv_id;
        $scope.inco.conv = conv;
        delete $scope.search_conv;
    };

    $scope.addUnidade = function (unid) {
        $scope.inco.postos_id = unid.postos_id;
        $scope.inco.unid = unid;
        delete $scope.search_unid;
    };

    $scope.addAtendente = function (aten) {
        $scope.inco.aten_id = aten.user_id;
        $scope.inco.aten = aten;
        delete $scope.search_aten;
    };

    var setAdicionais = function (data) {
        //adiciona o posto
        $scope.inco.unid = $scope.unidades.filter(function (unid) {
            return data.postos_id === unid.postos_id;
        })[0];

        //adiciona o convenio
        $scope.inco.conv = $scope.convenios.filter(function (conv) {
            return data.conv_id === conv.conv_id;
        })[0];

        //adiciona atendente
        $scope.inco.aten = $scope.atendentes.filter(function (aten) {
            return data.aten_id === aten.user_id;
        })[0];
    };

    init();
});