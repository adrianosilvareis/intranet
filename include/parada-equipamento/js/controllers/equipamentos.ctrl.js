angular.module('parada-equipamento').controller('equipamentos', function ($scope, equipamentos, objetoAPI, config) {

    $scope.remover = function (equip) {
        objetoAPI.deleteObjeto(config.urlAPI + '/equipamentos/&id=' + equip.equip_id)
                .then(function (success) {
                    carregarEquipamentos();
                }, function (error) {
                    console.log(error);
                });
    };

    var carregarEquipamentos = function () {
        objetoAPI.getObjeto(config.urlAPI + '/equipamentos')
                .success(function (data) {
                    if (Array.isArray(data)) {
                        $scope.equipamentos = data;
                    }

                });
    };

    var init = function (equip) {
        if (Array.isArray(equip))
            $scope.equipamentos = equip;
    };

    init(equipamentos.data);

});