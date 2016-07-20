angular.module('aplication', ['ngRoute']);  

angular.module('aplication').config(function($routeProvider){
    
    var link = "/intranet/include/debug/partials";
    
    $routeProvider.when('/teste',{
        templateUrl: link + "/teste.html",
        controller: "control"
    });
    
    $routeProvider.otherwise({redirectTo: '/teste'});
});