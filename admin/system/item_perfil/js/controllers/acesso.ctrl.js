angular.module("itemPerfil").controller('acesso', function ($scope, objetoAPI, config) {
    $('#menu2').hide();

    $scope.acessos = [];
    $scope.submenu1 = [];
    $scope.submenu2 = [];

    $scope.submenu = function (select) {
        $scope.submenu1 = filterAcessos(select.acesso_id);
        $('#menu2').toggle('slow');
    };

    $scope.submenu2 = function (select) {
        $scope.submenu2 = filterAcessos(select.acesso_id);
        $('#menu3').toggle('slow');
    };

    var filterAcessos = function (acesso_id) {
        return $scope.acessos.filter(function (submenu) {
            return submenu.acesso_parent === acesso_id;
        });
    };

    var carregarItens = function () {
        objetoAPI.getObjeto(config.apiURL + '/acesso.api.php').success(function (data) {
            $scope.acessos = data;
        });
    };

    carregarItens();
});