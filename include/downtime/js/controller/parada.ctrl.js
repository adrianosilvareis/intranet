appDt.controller("parada", function ($scope, objetoAPI, config) {

    var _equipamentos = null;
    var _time = null;
    $scope.equipamentos = null;
    $scope.time = null;

    //BroadCast Recebendo equipamentos carregados da API em outro controller
    $scope.$on('handleBroadcast', function (event, args) {
        if (args.equipamentos)
            _equipamentos = args.equipamentos;
        sincroned();
    });

    var carregarEquipamentos = function () {
        objetoAPI.saveObjeto(config.apiURL + "/equip.api.php").success(function (data) {
            _equipamentos = data;
            sincroned();
        });
    };

    var carregarParadas = function () {
        objetoAPI.getObjeto(config.apiURL + "/time.api.php").success(function (data) {
            _time = data;
            sincroned();
        });
    };

    var sincroned = function () {
        if (_equipamentos && _time)
            paradasEmAberto();
    };

    var paradasEmAberto = function () {
        _equipamentos.map(function (equip) {
            equip.stoped = _time.filter(function (stop) {
                if (!stop.down_author && equip.equip_id === stop.equip_id)
                    return stop;
            })[0];
        });
        $scope.equipamentos = angular.copy(_equipamentos);
        $scope.time = angular.copy(_time);

        _equipamentos = null;
        _time = null;
    };

    var saveParada = function (parada) {
        objetoAPI.saveObjeto(config.apiURL + "/time.api.php", parada).success(function (data) {
            console.log(data);
            carregarParadas();
        });
    };

    $scope.update = function (equip) {
        if (equip.author)
            saveParada(equip);
    };

    carregarParadas();
});