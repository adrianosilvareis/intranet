angular.module('itemPerfil').config(function ($routeProvider) {

    $routeProvider
            .when("/", {
                templateUrl: "/intranet/admin/system/item_perfil/partials/index.html",
                controller: 'acesso'
            });
            
            $routeProvider.otherwise({redirectTo: '/'});
});