angular.module('eventoIndesejado').controller('registros', function ($scope, objetoAPI, config, $location) {
    
    $location.auth = "evento indesejado";
    
    $scope.abertos_enviados = [];
    $scope.fechados_enviados = [];
    $scope.abertos_recebidos = [];
    $scope.fechados_recebidos = [];
    $scope.carregando = true;
    
    var session = [];

    var init = function () {
        carregarSession();
        carregarRegistros();
    };

//    reg_finalizado | user_cadastro | user_recebimento | area_recebimento

    var registros = function (data) {
        //enviados
        $scope.abertos_enviados = data.filter(function (reg) {
            return reg.reg_finalizado == '0' && session.user_id == reg.user_cadastro;
        });

        $scope.fechados_enviados = data.filter(function (reg) {
            return reg.reg_finalizado == '1' && session.user_id == reg.user_cadastro;
        });
        
        //recebidos
        $scope.abertos_recebidos = data.filter(function (reg) {
            return reg.reg_finalizado == '0' && session.user_id == reg.user_recebimento || reg.reg_finalizado == '0' && session.area_id == reg.area_recebimento;
        });

        $scope.fechados_recebidos = data.filter(function (reg) {
            return reg.reg_finalizado == '1' && session.user_id == reg.user_recebimento || reg.reg_finalizado == '1' && session.area_id == reg.area_recebimento;
        });
        $scope.carregando = false;
    };

    var carregarSession = function () {
        objetoAPI.getObjeto(config.session)
                .then(
                        function (sucess) {
                            session = sucess.data;
                        },
                        function (error) {
                            console.log(error);
                        });
    };

    var carregarRegistros = function () {
        objetoAPI.getObjeto(config.apiURL + '/registro.api.php')
                .then(
                        function (success) {
                            registros(success.data);
                        },
                        function (error) {
                            console.log(error);
                        }
                );
    };

    init();
});