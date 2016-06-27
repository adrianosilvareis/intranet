angular.module('eventoIndesejado').controller('dashboard', function ($scope, $routeParams, $http, config, $filter) {

    $scope.registros = [];
    $scope.regAtivos = [];
    $scope.userReg = [];
    $scope.areaReg = [];
    var _user = [];
    var _areas = [];
    var _totalRegistros = 0;

    var carregarUsuarios = function () {
        $http.get(config.apiURL + "/usuarios.api.php").success(function (data) {
            _user = data;
            _mixinUser();
        });
    };

    var carregarAreas = function () {
        $http.get(config.apiURL + "/area.api.php").success(function (data) {
            _areas = data;
            _mixinAreas();
        });
    };

    var carregarRegistros = function () {
        $http.get(config.apiURL + "/registro.api.php").success(function (data) {
            $scope.registros = data;
            _totalRegistros = data.length;
            $scope.regAtivos = $filter("regAtivo")(data);
            $scope.userReg = $filter('regUsuarios')(data);
            $scope.cadastroReg = $filter('regUsuarios')(data, true);
            $scope.areaReg = $filter('regAreas')(data);
            _mixinUser();
            _mixinAreas();
        });
    };

    var contUser = 0;
    var _mixinUser = function () {
        contUser++;
        if (contUser === 2) {
            $scope.userReg.map(function (data) {
                var conta = data.quant * 100 / _totalRegistros;
                data.pcent = parseFloat(conta.toFixed(2));
                data.usuario = _user.filter(function (userData) {
                    return userData.user_id === data.user_id;
                })[0];
            });

            $scope.cadastroReg.map(function (data) {
                var conta = data.quant * 100 / _totalRegistros;
                data.pcent = parseFloat(conta.toFixed(2));
                data.usuario = _user.filter(function (userData) {
                    return userData.user_id === data.user_id;
                })[0];
            });
        }
    };

    var contArea = 0;
    var _mixinAreas = function () {
        contArea++;
        if (contArea === 2) {
            $scope.areaReg.map(function (data) {
                var conta = data.quant * 100 / _totalRegistros;
                data.pcent = parseFloat(conta.toFixed(2));
                data.areas = _areas.filter(function (areaData) {
                    return areaData.area_id === data.area_id;
                })[0];
            });
        }
    };


    var link = "/intranet/include/evento-indesejado/partials/admin/dashboard/";
    $scope.partials = "";

    if ($routeParams.dash) {
        $scope.partials = link + $routeParams.dash + ".html";
    } else {
        $scope.partials = $scope.partials = link + "geral.html";
    }

    carregarRegistros();
    carregarUsuarios();
    carregarAreas();
});