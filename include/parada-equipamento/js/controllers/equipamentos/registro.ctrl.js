angular.module('parada-equipamento').controller('registro', function ($scope, $location, objetoAPI, config, equipamento, tipos, user) {

    $scope.log = {};

    $scope.save = function (log) {
        objetoAPI.saveObjeto(config.urlAPI + '/log-parada/', log)
                .success(success)
                .error(error);
    };

    var updateEquip = function (equip) {
        objetoAPI.saveObjeto(config.urlAPI + '/equipamentos/', equip)
                .success(function (data) {
                    $location.path('/equipamentos/');
                })
                .error(error);
    };

    var success = function (success) {
        updateEquip($scope.log.equip);
    };

    var error = function (error) {
        console.log('error');
        console.log(error);
    };

    var init = function (user, tipo, equipamento) {
        $scope.tipos = tipo.data;
        $scope.log.autor_id = user.user_id;
        isWork(equipamento);
    };

    var isWork = function (equipamento) {
        var equip = equipamento.data;

        if (!equip.equip_operation)
            equip.equip_operation = '1';

        equip.equip_operation = (equip.equip_operation == '1' ? '0' : '1');

        $scope.log.equip_id = equip.equip_id;
        $scope.log.log_start = equip.equip_operation;
        $scope.log.equip = equip;
    };

    init(user, tipos, equipamento);
});