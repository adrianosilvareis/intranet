angular.module('ej').config(function ($routeProvider) {

    var link = "/intranet/include/evento-indesejado/";

    $routeProvider
            .when("/registro", {
                templateUrl: link + "partials/registro.html",
                controller: 'registro'
            });

    $routeProvider
            .when("/registro/:regId", {
                templateUrl: link + "partials/registro.html",
                controller: 'registro'
            });

    $routeProvider
            .when("/avaliacao/:regId", {
                templateUrl: link + "partials/avaliacao.html",
                controller: 'registro'
            });

    $routeProvider
            .when("/painel", {
                templateUrl: link + "partials/painel.html",
                controller: 'registros'
            });

    $routeProvider
            .when("/painel/:local", {
                templateUrl: link + "partials/painel_master.html",
                controller: 'masterList'
            });
    
    $routeProvider
            .when("/teste", {
                templateUrl: link + "partials/teste.html",
                controller: 'registro'
            });

    $routeProvider.otherwise({redirectTo: '/painel'});
});