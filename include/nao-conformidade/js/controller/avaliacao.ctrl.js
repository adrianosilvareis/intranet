angular.module('naoConformidade').controller('avaliacao', function ($scope, objetoAPI, config) {

    $scope.saveRegistro = function (registro) {
        registro.edited = true;
        objetoAPI.saveObjeto(config.apiURL + "/registro.api.php", registro).success(function (data) {
            console.log(data);
        });
    };

    $scope.novoRegistro = function () {
        delete $scope.registro;
    };
});