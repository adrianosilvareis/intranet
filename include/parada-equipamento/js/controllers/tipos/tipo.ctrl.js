angular.module('parada-equipamento').controller('tipo', function ($scope, $location, objetoAPI, config, tipo, metas) {

    $scope.tipo = {};
    $scope.metas = [];

    var init = function (tipo, metas) {

        if (metas !== undefined)
            $scope.metas = metas.data;

        if (tipo !== undefined) {
            $scope.tipo = tipo.data;
            addAll();
        }

    };

    var addAll = function () {
        $scope.tipo.meta = $scope.metas.filter(function (meta) {
            return meta.meta_id === $scope.tipo.meta_id;
        })[0];
    };

    $scope.save = function (tipo) {
        var autor = config.userLogin.user_id;
        tipo.autor_id = autor;
        objetoAPI.saveObjeto(config.urlAPI + '/tipos-de-parada', tipo)
                .success(success)
                .error(error);
    };

    var success = function (data) {
        if (data.tipo_id > 0)
            $location.path('/tipo-de-parada/' + data.tipo_id);
    };

    var error = function (error) {
        console.log('Error: ' + error);
    };

    $scope.isActive = function () {
        if (!$scope.tipo.tipo_status)
            $scope.tipo.tipo_status = '1';

        $scope.tipo.tipo_status = ($scope.tipo.tipo_status == '1' ? '0' : '1');
    };

    $scope.addMetas = function (meta) {
        $scope.tipo.meta_id = meta.meta_id;
        $scope.tipo.meta = meta;
        delete $scope.search;
    };

    init(tipo, metas);
});