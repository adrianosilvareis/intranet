angular.module('itemPerfil').config(function ($routeProvider) {

    $routeProvider
            .when("/", {
                templateUrl: "/intranet/admin/system/acessos/partials/index.html",
                controller: 'acessos'
            });

    $routeProvider
            .when("/create", {
                templateUrl: "/intranet/admin/system/acessos/partials/acesso.html",
                controller: 'acesso'
            });

    $routeProvider
            .when("/update/:id", {
                templateUrl: "/intranet/admin/system/acessos/partials/acesso.html",
                controller: 'acesso'
            });

    $routeProvider
            .when("/perfil/:id", {
                templateUrl: "/intranet/admin/system/acessos/partials/item_perfil.html",
                controller: 'item_perfil'
            });
            
            $routeProvider.otherwise({redirectTo: '/'});
});