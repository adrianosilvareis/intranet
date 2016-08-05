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
                        controller: 'convenio'
                    });

            $routeProvider
                    .when('/convenio/:id', {
                        templateUrl: partials + '/convenio/convenio.html',
                        controller: 'convenio'
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
                        templateUrl: partials + '/glosas/index.html',
                        controller: 'glosas'
                    });
                    
            $routeProvider
                    .when('/glosa', {
                        templateUrl: partials + '/glosas/glosa.html',
                        controller: 'glosa'
                    });
            $routeProvider
                    .when('/glosa/:id', {
                        templateUrl: partials + '/glosas/glosa.html',
                        controller: 'glosa'
                    });

            $routeProvider
                    .when('/admin', {
                        templateUrl: partials + '/admin.html'
                    });

            $routeProvider.otherwise({redirectTo: '/'});
        });