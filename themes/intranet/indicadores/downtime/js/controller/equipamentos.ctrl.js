appDt.controller("equipamentos", function ($scope, objetoAPI, config) {

    $scope.equipamentos = [];
    $scope.setores = [];
    $scope.equipamento = "";

    var carregarEquipamentos = function () {
        objetoAPI.getObjeto(config.apiURL + "/equip.api.php").success(function (data) {
            $scope.equipamentos = data;
        });
    };

    var carregarSetores = function () {
        objetoAPI.getObjeto(config.apiURL + "/setor.api.php").success(function (data) {
            $scope.setores = data;
        });
    };

    $scope.saveEquipamento = function (equip) {
        objetoAPI.saveObjeto(config.apiURL + "/equip.api.php", equip).success(function (date, status) {
            delete $scope.equipamento;
            $scope.equipForm.$setPristine();
            carregarEquipamentos();
            $scope.message = date;
            if (status === 200) {
                console.log(date);
            }
        });
    };

    $scope.apagarEquipamento = function (equip) {
        apagar = [equip];
        $scope.saveEquipamento(apagar);
    };

    $scope.equipamentoId = function (equip) {
        equip.edited = true;
        $scope.equipamento = equip;
    };

    $scope.novoEquipamento = function () {
        delete $scope.equipamento;
        $scope.equipForm.$setPristine();
    };

    $scope.alterStatus = function (equip) {
        equip.equip_status = (equip.equip_status === "0" ? true : false);
        equip.edited = true;
        $scope.saveEquipamento(equip);
    };

    carregarEquipamentos();
    carregarSetores();
});