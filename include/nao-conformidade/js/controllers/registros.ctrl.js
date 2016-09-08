angular.module('naoConformidade').controller('registros', function (registros, session, $scope) {

    $scope.abertos_enviados = [];
    $scope.fechados_enviados = [];
    $scope.abertos_recebidos = [];
    $scope.fechados_recebidos = [];

    var Session = [];

    var init = function () {
        Session = session;
        setAtributos(registros.data);
    };

    var setAtributos = function (data) {
        if (!Array.isArray(data))
            return;
        
        data.forEach(function (reg) {
            if (reg.reg_finalizado == '0') {
                //abertas
                if (Session.user_id == reg.user_cadastro)
                    //enviadas
                    $scope.abertos_enviados.push(reg);

                if (Session.user_id == reg.user_recebimento || Session.area_id == reg.area_recebimento)
                    //recebidas
                    $scope.abertos_recebidos.push(reg);

            } else {
                //fechadas
                if (Session.user_id == reg.user_cadastro)
                    //enviadas
                    $scope.fechados_enviados.push(reg);

                if (Session.user_id == reg.user_recebimento || Session.area_id == reg.area_recebimento)
                    //recebidas
                    $scope.fechados_recebidos.push(reg);
            }
        });
    };

    init();
});