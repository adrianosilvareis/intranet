angular.module("itemPerfil").controller('item_perfil', function ($scope, objetoAPI, config, $timeout, $routeParams) {

    var todosItens = [];

    $scope.message = {};
    $scope.carregando = true;
    $scope.showPlugin = true;
    $scope.list = [];
    $scope.list2 = [];
    $scope.list3 = [];
    $scope.list4 = [];
    $scope.select = [];
    $scope.perfilId = "";
    $scope.alert = {};

    $scope.salvar = function () {
        var objeto = {
            id: $scope.perfilId,
            list: $scope.select
        };

        objetoAPI.saveObjeto(config.urlAPI + '/perfilHasAcesso', objeto).success(function (data) {
            $scope.alert = data;
            $scope.alert.class = 'trigger accept';
        }).error(function (error) {
            $scope.alert = error;
            $scope.alert.class = 'trigger danger';
        });
    };

    //
    // remove o item selecionado
    //
    $scope.remover = function (item) {
        $scope.select.splice($scope.select.indexOf(item), 1);
    };

    //
    // abre a lista de acordo com item selecionado, alem de adicionalo a lista de seleção.
    //
    $scope.menu = function (item) {

        var existe = $scope.select.some(function (element) {
            return element.acesso_id === item.acesso_id;
        });

        if (!existe) {
            $scope.select.push(item);
        }

        if ($scope.list.indexOf(item) !== -1) {

            clearItens($scope.list3);
            clearItens($scope.list2);

            $timeout(function () {
                menu($scope.list2, item.acesso_id);
            }, 100 * $scope.list2.length);

        } else if ($scope.list2.indexOf(item) !== -1) {
            $scope.showPlugin = true;

            clearItens($scope.list3);

            $timeout(function () {
                menu($scope.list3, item.acesso_id);
            }, 100 * $scope.list3.length);

        } else if ($scope.list3.indexOf(item) !== -1) {
            $scope.showPlugin = false;
            
            clearItens($scope.list4);
            
            $timeout(function () {
                menu($scope.list4, item.acesso_id);
            }, 100 * $scope.list4.length);
        }
    };

    //
    // Carregas todos os itens   
    //
    var carregarItens = function () {
        objetoAPI.getObjeto(config.urlAPI + '/acesso').success(function (data) {
            if (Array.isArray(data)) {
                todosItens = data;
                menu($scope.list, null);
            } else {
                $scope.message = data;
            }
            $scope.carregando = false;
        });
    };

    //
    // carregar itens do perfil
    //
    var carregarPerfil = function () {
        $scope.perfilId = $routeParams.id;
        objetoAPI.getObjeto(config.urlAPI + '/perfilHasAcesso&id=' + $routeParams.id).success(function (data) {
            if (data.status) {
                $scope.select = [];
            } else {
                addItem($scope.select, data);
            }
        }).error(function (error) {
            console.log(error);
        });
    };

    //
    // ESTILO DA PAGINA
    //
    var menu = function (list, condition) {
        var data = todosItens.filter(function (item) {
            return item.acesso_parent === condition;
        });

        $timeout(function () {
            addItem(list, data);
        }, 100 * list.length);
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

    var clearItens = function (list) {
        for (var i = 0; i < list.length; i++) {
            $timeout(function () {
                list.pop();
            }, 100 * i);
        }
    };

    carregarItens();
    carregarPerfil();
});