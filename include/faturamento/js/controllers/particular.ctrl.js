angular.module('faturamento')
        .controller(
                'particular',
                function ($scope, $filter, objetoAPI, config, particular, unidades, atendentes) {


                    $scope.info = {};
                    $scope.view = "estatisticas";
                    $scope.limit = 5;
                    var Particulares = [];
                    $scope.particulares = [];
                    $scope.unidades = [];
                    $scope.atendentes = [];

                    var init = function (data) {
                        var data = data;
                        if (Array.isArray(data)) {
                            $scope.particulares = data;
                            setAdicionais();
                        } else {
                            $scope.info = data;
                        }
                    };

                    var setAdicionais = function () {
                        $scope.unidades = (Array.isArray(unidades.data) ? unidades.data : []);
                        $scope.atendentes = (Array.isArray(atendentes.data) ? atendentes.data : []);

                        $scope.particulares.map(function (data) {
                            //adiciona o posto
                            data.unid = $scope.unidades.filter(function (unid) {
                                return data.unid_id === unid.postos_id;
                            })[0];
                            //adiciona atendente
                            data.aten = $scope.atendentes.filter(function (aten) {
                                return data.aten_id === aten.user_id;
                            })[0];
                        });

                        Particulares = $scope.particulares;
                    };

                    $scope.filtrarData = function (dataInicial, dataFinal) {
                        $scope.particulares = Particulares.filter(function (part) {
                            if (part.part_date >= dataInicial && part.part_date <= dataFinal)
                                return part;
                        });
                    };

                    $scope.filtrar = function (search) {
                        $scope.particulares = $filter('filter')(Particulares, search);
                    };

                    $scope.progressSize = function (size, position) {
                        var result = 100 * position / size;
                        return parseInt(result);
                    };

                    $scope.toCsv = function (particular) {
                        
                        if (particular.length === 0)
                            return;
                        
                        objetoAPI.saveObjeto(config.urlAPI + '/particular', particular)
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

                    init(particular.data);
                });