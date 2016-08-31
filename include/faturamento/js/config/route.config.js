angular.module('faturamento')
        .config(function ($routeProvider) {

            var partials = CONFIG.HOME + '/include/faturamento/partials';

            $routeProvider
                    .when('/', {
                        templateUrl: partials + '/index.html',
                        resolve: {
                            access: function ($location) {
                                var liberado = perfilUsuario.acessos.some(function (auth) {
                                    return auth.acesso_name === 'faturamento';
                                });

                                if (!liberado)
                                    $location.path('/report');
                            }
                        }
                    });

            $routeProvider
                    .when('/inconsistencias', {
                        templateUrl: partials + '/inconsistencia/index.html',
                        controller: 'inconsistencias',
                        resolve: {
                            inconsistencias: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/inconsistencias');
                            },
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
                        controller: 'glosas',
                        resolve: {
                            glosas: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/glosas');
                            },
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
                    .when('/glosa', {
                        templateUrl: partials + '/glosa/glosa.html',
                        controller: 'glosa',
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
                    .when('/glosa/:id', {
                        templateUrl: partials + '/glosa/glosa.html',
                        controller: 'glosa',
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
                    .when('/os-nao-pagas', {
                        templateUrl: partials + '/os-nao-pagas/index.html',
                        controller: 'particular',
                        resolve: {
                            particular: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/particular');
                            },
                            unidades: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/unidades');
                            },
                            atendentes: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/atendentes');
                            }
                        }
                    });

            $routeProvider
                    .when('/os-nao-pagas/uploads', {
                        templateUrl: partials + '/os-nao-pagas/uploads.html',
                        controller: 'uploadParticular'
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
                    .when('/report', {
                        templateUrl: partials + '/relatorios/relatorios.html'
                    });

            $routeProvider
                    .when('/report/inconsistencias', {
                        templateUrl: partials + '/relatorios/inconsistencias.html',
                        controller: 'inconsistencias',
                        resolve: {
                            inconsistencias: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/inconsistencias');
                            },
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
                    .when('/report/glosas', {
                        templateUrl: partials + '/relatorios/glosas.html',
                        resolve: {
                            glosas: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/glosas');
                            },
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
                    .when('/report/os-nao-pagas', {
                        templateUrl: partials + '/relatorios/os-nao-pagas.html',
                        controller: 'particular',
                        resolve: {
                            particular: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/particular');
                            },
                            unidades: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/unidades');
                            },
                            atendentes: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/atendentes');
                            }
                        }
                    });

            $routeProvider
                    .when('/error', {
                        templateUrl: partials + '/error.html'
                    });

            $routeProvider
                    .when('/auth', {
                        templateUrl: partials + '/unauth.html'
                    });

            $routeProvider.otherwise({redirectTo: '/'});
        });