angular.module("naoConformidade").controller('registroList', function ($scope, objetoAPI, config) {

    $scope.registros = [];

    _carregarRegistros = function () {
        objetoAPI.getObjeto(config.apiURL + "/registro.api.php").success(function (data) {
            $scope.registros = data;
        });
    };
    
    _carregarRegistros();

});