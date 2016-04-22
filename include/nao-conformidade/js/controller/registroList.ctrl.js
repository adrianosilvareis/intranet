angular.module("naoConformidade").controller('registroList', function ($scope, objetoAPI, config) {

    $scope.registros = [];
    $scope.usuarios = [];
    $scope.setores = [];
    $scope.userlogin = {};

    _carregarObjetos = function () {
        objetoAPI.getObjeto(config.apiURL + "/registro.api.php").success(function (data) {
            $scope.registros = data;
            if ($scope.registros.length > 0 && $scope.usuarios.length > 0 && $scope.setores.length > 0) {
                mixin();
            }
        });

        objetoAPI.getObjeto(config.apiURL + "/usuarios.api.php").success(function (data) {
            $scope.usuarios = data;
            if ($scope.registros.length > 0 && $scope.usuarios.length > 0 && $scope.setores.length > 0) {
                mixin();
            }
        });

        objetoAPI.getObjeto(config.apiURL + "/setor.api.php").success(function (data) {
            $scope.setores = data;
            if ($scope.registros.length > 0 && $scope.usuarios.length > 0 && $scope.setores.length > 0) {
                mixin();
            }
        });

        var data = {userOnline: true};
        objetoAPI.saveObjeto(config.apiURL + "/usuarios.api.php", data).success(function (data) {
            $scope.userlogin = data;
        });
    };

    var mixin = function () {
        $scope.registros.map(function (reg) {
            reg.user_lastupdate = $scope.usuarios.filter(function (user) {
                if (user.user_id === reg.user_lastupdate)
                    return user;
            })[0];

            reg.user_cadastro = $scope.usuarios.filter(function (user) {
                if (user.user_id === reg.user_cadastro)
                    return user;
            })[0];

            reg.user_recebimento = $scope.usuarios.filter(function (user) {
                if (user.user_id === reg.user_recebimento)
                    return user;
            })[0];

//            reg.setor_recebimento = $scope.setores.filter(function (setor) {
//                if (reg.setor_recebimento === setor.setor_id)
//                    return setor;
//            })[0];
        });
    };

    $scope.openView = function (view) {
        $scope.view = view;
    };

    $scope.getAllList = function () {
        return "/intranet/include/nao-conformidade/system/user/listasAll/" + $scope.view + ".html";
    };

    $scope.openView('todos');
    _carregarObjetos();

});