angular.module('parada-equipamento').controller('metas', function ($scope, objetoAPI, config, metas, users) {

    $scope.metas = [];
    var init = function (metas) {
        if (metas === undefined)
            return;
        if (Array.isArray(metas.data)) {
            $scope.metas = metas.data;
            setUser();
        }
    };
    var setUser = function () {
        $scope.metas.map(function (meta) {
            var user = users.data.filter(function (user) {
                return user.user_id === meta.autor_id;
            })[0];
            user ?
                    meta.autor_name = user.user_nickname :
                    meta.autor_name = 'usuario não encontrado';
        });
    };
    
    $scope.remover = function (metas) {
        objetoAPI.deleteObjeto(config.urlAPI + '/metas/&id=' + metas.meta_id)
                .then(carregarMetas, error);
    };
    var carregarMetas = function (data) {
        console.log(data);
        $scope.metas = [];
        objetoAPI.getObjeto(config.urlAPI + '/metas/')
                .success(function (data) {
                    var dados = {data: data};
                    init(dados);
                })
                .error(error);
    };
    var error = function () {
        console.log(error);
    };
    init(metas);
});