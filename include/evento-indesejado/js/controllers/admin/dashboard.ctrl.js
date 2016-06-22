angular.module('ej').controller('dashboard', function($scope,$routeParams){
    var link = "/intranet/include/evento-indesejado/partials/admin/";
    $scope.teste = "teste de configuração";
    $scope.partials = "";
    
    if($routeParams.id){
        $scope.partials = link + $routeParams.id + ".html";
    }else{
        $scope.partials = "";
    }
});