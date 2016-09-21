angular.module('parada-equipamento').controller('equipamento', function ($scope, $location, equipamento, objetoAPI, config) {

    $scope.equip = {};

    var init = function (equip) {
        if (equip !== undefined)
            $scope.equip = equip.data;
    };

    $scope.save = function (equip) {
        var autor = config.userLogin.user_id;
        equip.autor_id = autor;
        objetoAPI.saveObjeto(config.urlAPI + '/equipamentos', equip)
                .success(success)
                .error(error);
    };

    var success = function (data) {
        if (data.equip_id > 0)
            $location.path('/equipamento/' + data.equip_id);
    };

    var error = function (error) {
        console.log('Error: ' + error);
    };

    $scope.isActive = function () {
        if (!$scope.equip.equip_status)
            $scope.equip.equip_status = '1';

        $scope.equip.equip_status = ($scope.equip.equip_status == '1' ? '0' : '1');
    };

    $scope.isWork = function () {
        if (!$scope.equip.equip_operation)
            $scope.equip.equip_operation = '1';

        $scope.equip.equip_operation = ($scope.equip.equip_operation == '1' ? '0' : '1');
    };

    init(equipamento);
});