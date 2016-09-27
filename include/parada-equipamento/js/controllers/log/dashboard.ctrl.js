angular.module('parada-equipamento').controller('dashboard', function ($scope, logs, equipamentos, users, tipos, metas) {
    $scope.logs = [];
    var Equipamentos = equipamentos.data;
    var Metas = metas.data;
    var Tipos = tipos.data;
    var Users = users.data;

    var init = function (logs) {
        if (Array.isArray(logs.data)) {
            $scope.logs = logs.data;
            setAll();
        }
    };

    var setAll = function () {
        $scope.logs.map(function (log) {
            log.equip = Equipamentos.filter(function (equip) {
                return log.equip_id === equip.equip_id;
            })[0];

            log.autor = Users.filter(function (user) {
                return log.autor_id === user.user_id;
            })[0];

            log.tipo = Tipos.filter(function (tipo) {
                return log.tipo_id === tipo.tipo_id;
            })[0];
            
            log.meta = Metas.filter(function(meta){
                return log.tipo.meta_id === meta.meta_id;
            })[0];
        });

    };

    init(logs);

});