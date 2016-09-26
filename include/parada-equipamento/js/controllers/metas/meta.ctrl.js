angular.module('parada-equipamento').controller('meta', function ($scope, $location, objetoAPI, config, meta) {

    $scope.meta = {};

    var init = function (meta) {
        if (meta !== undefined)
            $scope.meta = meta.data;
    };

    $scope.save = function (meta) {
        var autor = config.userLogin.user_id;
        meta.autor_id = autor;
        objetoAPI.saveObjeto(config.urlAPI + '/metas', meta)
                .success(success)
                .error(error);
    };

    var success = function (data) {
        if (data.meta_id > 0)
            $location.path('/meta/' + data.meta_id);
    };

    var error = function (error) {
        console.log('Error: ' + error);
    };

    $scope.isActive = function () {
        if (!$scope.meta.meta_status)
            $scope.meta.meta_status = '1';

        $scope.meta.meta_status = ($scope.meta.meta_status == '1' ? '0' : '1');
    };
    
    init(meta);
});