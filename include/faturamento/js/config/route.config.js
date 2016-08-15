angular.module('faturamento')
        .config(function ($routeProvider) {

            var partials = CONFIG.HOME + '/include/faturamento/partials';
            $routeProvider
                    .when('/', {
                        templateUrl: partials + '/inconsistencia/index.html',
                        controller: 'inconsistencias'
                    });

            $routeProvider
                    .when('/inconsistencia', {
                        templateUrl: partials + '/inconsistencia/inconsistencia.html',
                        controller: 'inconsistencia',
                        resolve: {
                            unidades: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/unidades&query=ativos');
                            },
                            convenios: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/convenios&query=ativos');
                            },
                            naoconformidades: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/naoconformidade&query=ativos');
                            },
                            atendentes: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/atendentes&query=ativos');
                            }
                        }
                    });

            $routeProvider
                    .when('/inconsistencia/:id', {
                        templateUrl: partials + '/inconsistencia/inconsistencia.html',
                        controller: 'inconsistencia',
                        resolve: {
                            unidades: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/unidades&query=ativos');
                            },
                            convenios: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/convenios&query=ativos');
                            },
                            naoconformidades: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/naoconformidade&query=ativos');
                            },
                            atendentes: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/atendentes&query=ativos');
                            }
                        }
                    });

            $routeProvider
                    .when('/glosas', {
                        templateUrl: partials + '/glosa/index.html',
                        controller: 'glosas'
                    });

            $routeProvider
                    .when('/glosa', {
                        templateUrl: partials + '/glosa/glosa.html',
                        controller: 'glosa'
                    });

            $routeProvider
                    .when('/glosa/:id', {
                        templateUrl: partials + '/glosa/glosa.html',
                        controller: 'glosa'
                    });

            $routeProvider
                    .when('/convenios', {
                        templateUrl: partials + '/convenio/index.html',
                        controller: 'convenios',
                        resolve: {
                            convenios: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/convenios');
                            },
                            posts: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/posts');
                            }
                        }
                    });
            $routeProvider
                    .when('/convenio', {
                        templateUrl: partials + '/convenio/convenio.html',
                        controller: 'convenio',
                        resolve: {
                            posts: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/posts');
                            }
                        }
                    });

            $routeProvider
                    .when('/convenio/:id', {
                        templateUrl: partials + '/convenio/convenio.html',
                        controller: 'convenio',
                        resolve: {
                            posts: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/posts');
                            }
                        }
                    });

            $routeProvider
                    .when('/naoconformidades', {
                        templateUrl: partials + '/naoconformidade/index.html',
                        controller: 'naoconformidades',
                        resolve: {
                            naoconformidades: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/naoconformidade');
                            }
                        }
                    });

            $routeProvider
                    .when('/naoconformidade', {
                        templateUrl: partials + '/naoconformidade/naoconformidade.html',
                        controller: 'naoconformidade'
                    });

            $routeProvider
                    .when('/naoconformidade/:id', {
                        templateUrl: partials + '/naoconformidade/naoconformidade.html',
                        controller: 'naoconformidade'
                    });

            $routeProvider
                    .when('/admin', {
                        templateUrl: partials + '/admin.html'
                    });

            $routeProvider
                    .when('/error', {
                        templateUrl: partials + '/error.html',
                    });

            $routeProvider.otherwise({redirectTo: '/'});
        });