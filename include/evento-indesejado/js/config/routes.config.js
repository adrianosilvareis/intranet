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
            .when("/painel", {
                templateUrl: link + "partials/painel.html",
                controller: 'registros'
            });

    $routeProvider
            .when("/404", {
                templateUrl: link + "partials/404.html",
                controller: 'registro'
            });

    $routeProvider.otherwise({redirectTo: '/404'});
});