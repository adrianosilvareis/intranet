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
                        controller: 'inconsistencia'
                    });
            $routeProvider
                    .when('/inconsistencia/:id', {
                        templateUrl: partials + '/inconsistencia/inconsistencia.html',
                        controller: 'inconsistencia'
                    });
            $routeProvider
                    .when('/convenios', {
                        templateUrl: partials + '/convenio/index.html',
                        controller: 'convenios'
                    });
            $routeProvider
                    .when('/convenio', {
                        templateUrl: partials + '/convenio/convenio.html',
                        controller: 'convenio',
                        resolve: {
                            posts: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/posts')
                            }
                        }
                    });

            $routeProvider
                    .when('/convenio/:id', {
                        templateUrl: partials + '/convenio/convenio.html',
                        controller: 'convenio',
                        resolve: {
                            posts: function (objetoAPI, config) {
                                return objetoAPI.getObjeto(config.urlAPI + '/posts')
                            },
                            convenio: function (objetoAPI, config, $routeParams) {
                                console.log($routeParams.id);
                                return objetoAPI.getObjeto(config.urlAPI + '/convenios/&id=' + $routeParams.id)
                            }
                        }
                    });

            $routeProvider
                    .when('/naoconformidades', {
                        templateUrl: partials + '/naoconformidade/index.html',
                        controller: 'naoconformidades'
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
                    .when('/admin', {
                        templateUrl: partials + '/admin.html'
                    });

            $routeProvider.otherwise({redirectTo: '/'});
        });