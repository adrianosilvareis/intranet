angular.module('parada-equipamento').controller('tipos', function ($scope, objetoAPI, config, tipos, users, metas) {

    $scope.tipos = [];

    var init = function (tipos) {
        if (tipos === undefined)
            return;
        if (Array.isArray(tipos.data)) {
            $scope.tipos = tipos.data;
            setAll();
        }
    };

    var setAll = function () {
        $scope.tipos.map(function (tipo) {
            var user = users.data.filter(function (user) {
                return user.user_id === tipo.autor_id;
            })[0];
            user ?
                    tipo.autor_name = user.user_nickname :
                    tipo.autor_name = 'usuario não encontrado';

            var meta = metas.data.filter(function (meta) {
                return tipo.meta_id === meta.meta_id;
            })[0];
            meta ?
                    tipo.meta_name = meta.meta_title :
                    tipo.meta_name = "meta não encontrada";
        });
    };

    $scope.remover = function (tipo) {
        objetoAPI.deleteObjeto(config.urlAPI + '/tipos-de-parada/&id=' + tipo.tipo_id)
                .then(carregarTipos, error);
    };

    var carregarTipos = function (data) {
        console.log(data);
        $scope.tipos = [];
        objetoAPI.getObjeto(config.urlAPI + '/tipos-de-parada/')
                .success(function (data) {
                    var dados = {data: data};
                    init(dados);
                })
                .error(error);
    };

    var error = function () {
        console.log(error);
    };

    init(tipos);
});