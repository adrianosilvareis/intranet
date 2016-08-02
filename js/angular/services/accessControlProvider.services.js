angular.module('accessControl', []);

angular.module('accessControl').provider("accessControlProvider", function () {
    var userAccess = perfilUsuario.acessos;
    var result = {};

    this.$get = function () {
        return {
            verificaAcesso: function (auth) {
                var resposta = false;

                userAccess.filter(function (acesso) {

                    if (acesso.acesso_status) {
                        if (acesso.acesso_name === auth || acesso.acesso_tag === auth) {
                            result = {
                                message: "Aceito",
                                status: 202,
                                auth: auth
                            };
                            resposta = true;
                        } else {
                            result = {
                                message: "Não autorizado",
                                status: 401,
                                auth: auth
                            };
                        }
                    } else {
                        result = {
                            message: "Acesso desativado",
                            status: 404,
                            auth: auth
                        };
                    }
                });

                return resposta;
            },
            getResult: function () {
                return result;
            }
        };
    };
});

