angular.module('eventoIndesejado').config(function ($routeProvider) {

    var link = "/intranet/include/evento-indesejado/partials";

    /**
     * Acesso ao seu usuario
     */
    $routeProvider
            .when("/registro", {
                templateUrl: link + "/registro.html",
                controller: 'registro'
            });

    $routeProvider
            .when("/registro/:regId", {
                templateUrl: link + "/registro.html",
                controller: 'registro'
            });

    $routeProvider
            .when("/avaliacao/:regId", {
                templateUrl: link + "/avaliacao.html",
                controller: 'registro'
            });

    $routeProvider
            .when("/painel", {
                templateUrl: link + "/painel.html",
                controller: 'registros'
            });

    $routeProvider
            .when("/painel/:local", {
                templateUrl: link + "/painel_master.html",
                controller: 'masterList'
            });

    //Origens
    $routeProvider
            .when("/admin/origens", {
                templateUrl: link + '/admin/origens/listar.html',
                controller: 'origens'
            });

    //criação de origem
    $routeProvider
            .when("/admin/origem", {
                templateUrl: link + '/admin/origens/origem.html',
                controller: 'origem'
            });

    //Edição de origem
    $routeProvider
            .when("/admin/origem/:id", {
                templateUrl: link + '/admin/origens/origem.html',
                controller: 'origem'
            });

    /**
     * Acesso restrito, Admin
     */

    //Dashboard ADMIN
    $routeProvider
            .when("/admin", {
                templateUrl: link + '/admin/dashboard/geral.html',
                controller: 'dashboard'
            });
    //Dashboard ADMIN
    $routeProvider
            .when("/admin/charts", {
                templateUrl: link + '/admin/dashboard/charts.html',
                controller: 'dashboard'
            });
    //Dashboard ADMIN
    $routeProvider
            .when("/admin/report", {
                templateUrl: link + '/admin/dashboard/report.html',
                controller: 'dashboard'
            });

    $routeProvider
            .when("/admin/registro/:regId", {
                templateUrl: link + '/admin/dashboard/registro.html',
                controller: 'registro'
            });

    $routeProvider
            .when("/admin/avaliacao/:regId", {
                templateUrl: link + '/admin/dashboard/avaliacao.html',
                controller: 'registro'
            });

    $routeProvider.otherwise({redirectTo: '/painel'});
});