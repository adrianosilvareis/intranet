angular.module('naoConformidade').controller('masterList', function (registros, usuarios, session, $scope, $routeParams) {

    $scope.title = "";
    $scope.status = "";
    var Usuarios = [];
    var Registros = [];
    var Session = [];
    var Local = "";
    var init = function (local) {
        addLocal(local);
        Session = session;
        Registros = registros.data;
        Usuarios = usuarios.data;
        addUsuario();
    };

    var addLocal = function (_local) {
        Local = _local;
        if (_local === 'abertos_enviados') {
            $scope.title = "Enviado";
            $scope.status = "Aberto";
        }

        if (_local === 'fechados_recebidos') {
            $scope.title = "Recebido";
            $scope.status = "Fechado";
        }

        if (_local === 'fechados_enviados') {
            $scope.title = "Enviado";
            $scope.status = "Fechado";
        }

        if (_local === 'abertos_recebidos') {
            $scope.title = "Recebido";
            $scope.status = "Aberto";
        }
    };

    var addUsuario = function () {
        Usuarios.filter(function (user) {
            Registros.map(function (reg) {
                if (reg.user_recebimento === user.user_id)
                    reg.recebimento = user;
                if (reg.user_cadastro === user.user_id)
                    reg.cadastro = user;
                reg.reg_impacto_paciente == 1 ?
                        reg.impacto = "Sim" :
                        reg.impacto = "Não";
            });
        });
        filterRegistros(Registros);
    };
    var filterRegistros = function (data) {
        if (Local === 'abertos_enviados') {
            $scope.registros = data.filter(function (reg) {
                return reg.reg_finalizado == '0' && Session.user_id == reg.user_cadastro;
            });
        }

        if (Local === 'fechados_enviados') {
            $scope.registros = data.filter(function (reg) {
                return reg.reg_finalizado == '1' && Session.user_id == reg.user_cadastro;
            });
        }

        if (Local === 'abertos_recebidos') {
            $scope.registros = data.filter(function (reg) {
                return reg.reg_finalizado == '0' && Session.user_id == reg.user_recebimento || reg.reg_finalizado == '0' && Session.area_id == reg.area_recebimento;
            });
        }

        if (Local === 'fechados_recebidos') {
            $scope.registros = data.filter(function (reg) {
                return reg.reg_finalizado == '1' && Session.user_id == reg.user_recebimento || reg.reg_finalizado == '1' && Session.area_id == reg.area_recebimento;
            });
        }
    };
    
    init($routeParams.local);
});