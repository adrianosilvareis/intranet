angular.module('parada-equipamento')
        .config(function ($routeProvider) {

            var partials = CONFIG.HOME + '/include/parada-equipamento/partials';

            $routeProvider
                    .when('/', {
                        templateUrl: partials + '/log-parada/index.html',
                        controller: 'dashboard',
                        resolve: {
                            logs: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/log-parada/');
                            },
                            equipamentos: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/equipamentos');
                            },
                            tipos: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/tipos-de-parada/');
                            },
                            metas: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/metas/');
                            },
                            users: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/usuarios/');
                            }
                        }
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
                    .when('/equipamentos', {
                        templateUrl: partials + '/equipamento/index.html',
                        controller: 'equipamentos',
                        resolve: {
                            equipamentos: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/equipamentos');
                            }
                        }
                    });

            $routeProvider
                    .when('/equipamento/log/:equip_id', {
                        templateUrl: partials + '/equipamento/log.html',
                        controller: 'registro',
                        resolve: {
                            equipamento: function ($route, objetoAPI, config) {
                                var equip_id = $route.current.params.equip_id;
                                return objetoAPI.getObjeto(config.urlAPI + '/equipamentos/&id=' + equip_id);
                            },
                            tipos: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/tipos-de-parada/');
                            },
                            user: function (config) {
                                return config.userLogin;
                            }
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
                    .when('/metas', {
                        templateUrl: partials + '/metas/index.html',
                        controller: 'metas',
                        resolve: {
                            metas: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/metas/');
                            },
                            users: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/usuarios/');
                            }
                        }
                    });

            $routeProvider
                    .when('/meta', {
                        templateUrl: partials + '/metas/meta.html',
                        controller: 'meta',
                        resolve: {
                            meta: function () {
                                return {};
                            }
                        }
                    });

            $routeProvider
                    .when('/meta/:meta_id', {
                        templateUrl: partials + '/metas/meta.html',
                        controller: 'meta',
                        resolve: {
                            meta: function ($route, objetoAPI, config) {
                                var meta_id = $route.current.params.meta_id;
                                return objetoAPI.getObjeto(config.urlAPI + '/metas/&id=' + meta_id);
                            }
                        }
                    });

            $routeProvider
                    .when('/tipos-de-parada', {
                        templateUrl: partials + '/tipos-de-parada/index.html',
                        controller: 'tipos',
                        resolve: {
                            tipos: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/tipos-de-parada/');
                            },
                            users: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/usuarios/');
                            },
                            metas: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/metas/');
                            }
                        }
                    });

            $routeProvider
                    .when('/tipo-de-parada', {
                        templateUrl: partials + '/tipos-de-parada/tipo-de-parada.html',
                        controller: 'tipo',
                        resolve: {
                            tipo: function () {
                                return {};
                            },
                            metas: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/metas/');
                            }
                        }
                    });

            $routeProvider
                    .when('/tipo-de-parada/:tipo_id', {
                        templateUrl: partials + '/tipos-de-parada/tipo-de-parada.html',
                        controller: 'tipo',
                        resolve: {
                            tipo: function ($route, objetoAPI, config) {
                                var tipo_id = $route.current.params.tipo_id;
                                return objetoAPI.getObjeto(config.urlAPI + '/tipos-de-parada/&id=' + tipo_id);
                            },
                            metas: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/metas/');
                            }
                        }
                    });


            $routeProvider.otherwise({redirectTo: '/'});
        });