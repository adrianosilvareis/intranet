angular.module('parada-equipamento')
        .config(function ($routeProvider) {

            var partials = CONFIG.HOME + '/include/parada-equipamento/partials';

            $routeProvider
                    .when('/', {
                        templateUrl: partials + '/index.html'
                    });

            $routeProvider
                    .when('/equipamento', {
                        templateUrl: partials + '/equipamento/equipamento.html',
                        controller: 'equipamento',
                        resolve: {
                            equipamento: function () {}
                        }
                    });

            $routeProvider
                    .when('/equipamento/:equip_id', {
                        templateUrl: partials + '/equipamento/equipamento.html',
                        controller: 'equipamento',
                        resolve: {
                            equipamento: function ($route, objetoAPI, config) {
                                var equip_id = $route.current.params.equip_id;
                                return objetoAPI.getObjeto(config.urlAPI + '/equipamentos/&id=' + equip_id);
                            }
                        }
                    });

            $routeProvider
                    .when('/equipamentos', {
                        templateUrl: partials + '/equipamento/equipamentos.html',
                        controller: 'equipamentos',
                        resolve: {
                            equipamentos: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/equipamentos');
                            }
                        }
                    });

            $routeProvider
                    .when('/tipos-de-paradas', {
                        templateUrl: partials + '/index.html'
                    });

            $routeProvider
                    .when('/metas', {
                        templateUrl: partials + '/index.html'
                    });

            $routeProvider.otherwise({redirectTo: '/'});
        });