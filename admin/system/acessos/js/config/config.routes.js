angular.module('itemPerfil').config(function ($routeProvider) {

    $routeProvider
            .when("/", {
                templateUrl: "/intranet/admin/system/acessos/partials/item_perfil.html",
                controller: 'acesso'
            });
            
            $routeProvider.otherwise({redirectTo: '/'});
});