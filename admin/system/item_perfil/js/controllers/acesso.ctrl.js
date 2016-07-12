angular.module("itemPerfil").controller('acesso', function ($scope, objetoAPI, config, $timeout) {

    var itens = [];

    $scope.carregando = true;
    $scope.list = [];
    $scope.list2 = [];
    $scope.list3 = [];

    $scope.menu = function (item) {
        item.class = (item.class === 'active' ? null : 'active');

        cleanList($scope.list3);
        cleanList($scope.list2);
        if (item.class && item.class === 'active') {
            $timeout(function () {
                menu($scope.list2, item.acesso_id);
            }, 100 * 6);
        }
    };

    $scope.menu2 = function (item) {
        cleanList($scope.list3);
        $timeout(function () {
            menu($scope.list3, item.acesso_id);
        }, 100 * 6);
    };

    var menu = function (list, condition) {
        var data = itens.filter(function (item) {
            return item.acesso_parent === condition;
        });

        addItem(list, data);
    };

    var carregarItens = function () {
        objetoAPI.getObjeto(config.apiURL + '/acesso.api.php').success(function (data) {
            $scope.carregando = false;
            itens = data;
            menu($scope.list, null);
        });
    };

    var addItem = function (list, data) {
        var i = 0;
        data.filter(function (item) {
            if (list.indexOf(item) !== -1)
                return;
            i++;
            $timeout(function () {
                list.push(item);
            }, 100 * i);
        });
    };

    var cleanList = function (list) {
        for (var i = 0; i < list.length; i++) {
            $timeout(function () {
                list.pop();
            }, 100 * i);
        }
    };

    carregarItens();
});