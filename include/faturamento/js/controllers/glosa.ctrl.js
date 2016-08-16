angular.module('faturamento').controller('glosa', function ($scope, config, objetoAPI, $routeParams, unidades, convenios, atendentes, naoconformidades) {

    $scope.glosa = {};
    $scope.info = {};
    $scope.unidades = (Array.isArray(unidades.data) ? unidades.data : []);
    $scope.convenios = (Array.isArray(convenios.data) ? convenios.data : []);
    $scope.atendentes = (Array.isArray(atendentes.data) ? atendentes.data : []);
    $scope.naoconformidades = (Array.isArray(naoconformidades.data) ? naoconformidades.data : []);

    var init = function () {
        if ($routeParams.id) {
            carregarGlosas($routeParams.id);
        }
    };

    var carregarGlosas = function (id) {
        objetoAPI.getObjeto(config.urlAPI + '/glosas&id=' + id)
                .success(function (data) {
                    if (data.glosa_id) {
                        $scope.glosa = data;
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
        $scope.glosa = {};
        $scope.info = {};
    };

    $scope.save = function (glosa) {
        objetoAPI.saveObjeto(config.urlAPI + '/glosas', glosa)
                .success(function (data) {
                    if (data.glosa_id) {
                        $scope.glosa = data;
                        setAdicionais(data);
                        $scope.info = {
                            message: 'Glosa salva com sucesso!',
                            status: '200'
                        };
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
        $scope.glosa.conv_id = conv.conv_id;
        $scope.glosa.conv = conv;
        delete $scope.search_conv;
    };

    $scope.addUnidade = function (unid) {
        $scope.glosa.postos_id = unid.postos_id;
        $scope.glosa.unid = unid;
        delete $scope.search_unid;
    };

    $scope.addAtendente = function (aten) {
        $scope.glosa.aten_id = aten.user_id;
        $scope.glosa.aten = aten;
        delete $scope.search_aten;
    };

    var setAdicionais = function (data) {
        //adiciona o posto
        $scope.glosa.unid = $scope.unidades.filter(function (unid) {
            return data.postos_id === unid.postos_id;
        })[0];

        //adiciona o convenio
        $scope.glosa.conv = $scope.convenios.filter(function (conv) {
            return data.conv_id === conv.conv_id;
        })[0];

        //adiciona atendente
        $scope.glosa.aten = $scope.atendentes.filter(function (aten) {
            return data.aten_id === aten.user_id;
        })[0];
    };

    init();
});