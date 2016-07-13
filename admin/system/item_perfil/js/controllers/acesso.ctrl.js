angular.module("itemPerfil").controller('acesso', function ($scope, objetoAPI, config, $timeout) {

    var itens = [];
    var position = 0;

    $scope.carregando = true;
    $scope.list = [];
    $scope.list2 = [];
    $scope.list3 = [];

    $scope.menu = function (item) {
        item.class = (item.class === 'active' ? null : 'active');
        menu($scope.list2, item.acesso_id);
    };

    var menu = function (list, condition) {
        var tam = list.length;
        cleanList(list);
        
        var data = itens.filter(function (item) {
            return item.acesso_parent === condition;
        });
        
        $timeout(function () {
            addItem(list, data);
        }, 100 * tam);
    };

    var carregarItens = function () {
        objetoAPI.getObjeto(config.apiURL + '/acesso.api.php').success(function (data) {
            $scope.carregando = false;
            itens = data;
            menu($scope.list, null);
        });
    };

    //
    // ESTILIZAR
    //
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