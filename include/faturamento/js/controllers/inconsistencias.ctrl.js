angular.module('faturamento')
        .controller(
                'inconsistencias',
                function ($scope, $filter, objetoAPI, config, inconsistencias, unidades, convenios, naoconformidades, atendentes) {

                    $scope.info = {};
                    $scope.view = "estatisticas";
                    $scope.limit = 5;
                    var Inconsistencias = [];
                    $scope.inconsistencias = [];
                    $scope.unidades = [];
                    $scope.convenios = [];
                    $scope.atendentes = [];
                    $scope.naoconformidades = [];

                    var init = function () {
                        var data = inconsistencias.data;
                        if (Array.isArray(data)) {
                            $scope.inconsistencias = data;
                            setAdicionais();
                        } else {
                            $scope.info = data;
                        }
                    };

                    var setAdicionais = function () {
                        $scope.unidades = (Array.isArray(unidades.data) ? unidades.data : []);
                        $scope.convenios = (Array.isArray(convenios.data) ? convenios.data : []);
                        $scope.atendentes = (Array.isArray(atendentes.data) ? atendentes.data : []);
                        $scope.naoconformidades = (Array.isArray(naoconformidades.data) ? naoconformidades.data : []);

                        $scope.inconsistencias.map(function (data) {
                            //adiciona o posto
                            data.unid = $scope.unidades.filter(function (unid) {
                                return data.postos_id === unid.postos_id;
                            })[0];
                            //adiciona o convenio
                            data.conv = $scope.convenios.filter(function (conv) {
                                return data.conv_id === conv.conv_id;
                            })[0];
                            //adiciona atendente
                            data.aten = $scope.atendentes.filter(function (aten) {
                                return data.aten_id === aten.user_id;
                            })[0];
                            //adiciona não conformidade
                            data.ncon = $scope.naoconformidades.filter(function (ncon) {
                                return data.ncon_id === ncon.ncon_id;
                            })[0];
                            //adiciona faturista
                            data.fatur = $scope.atendentes.filter(function (aten) {
                                return data.faturista_id === aten.user_id;
                            })[0];
                        });

                        Inconsistencias = $scope.inconsistencias;
                    };

                    $scope.filtrarData = function (dataInicial, dataFinal) {
                        $scope.inconsistencias = Inconsistencias.filter(function (inco) {
                            if (inco.inco_date >= dataInicial && inco.inco_date <= dataFinal)
                                return inco;
                        });
                    };

                    $scope.filtrar = function (search) {
                        $scope.inconsistencias = $filter('filter')(Inconsistencias, search);
                    };

                    $scope.progressSize = function (size, position) {
                        var result = 100 * position / size;
                        return parseInt(result);
                    };

                    $scope.toCsv = function (inconsistencias) {
                        objetoAPI.saveObjeto(config.urlAPI + '/inconsistencias', inconsistencias)
                                .success(function (data) {

                                    var uri = 'data:text/csv;charset=utf-8,' + escape(data);

                                    var downloadLink = document.createElement("a");
                                    downloadLink.href = uri;
                                    downloadLink.download = "data.csv";

                                    document.body.appendChild(downloadLink);
                                    downloadLink.click();
                                    document.body.removeChild(downloadLink);

                                });
                    };

                    init();
                });