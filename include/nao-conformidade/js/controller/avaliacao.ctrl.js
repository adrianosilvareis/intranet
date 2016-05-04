angular.module('naoConformidade').controller('avaliacao', function ($scope, objetoAPI, config) {
    
    $scope.saveRegistro = function (registro) {
        registro.edited = true;
        objetoAPI.saveObjeto(config.apiURL + "/registro.api.php", registro).success(function (data) {
            $scope.message = data;
            $scope.closeRegistro();
        });
    };

    $scope.causaValid = function () {
        var _size = 5;
        if ($scope.registro.reg_aval_processo && $scope.registro.reg_aval_processo.length > _size || $scope.registro.reg_aval_materia_prima && $scope.registro.reg_aval_materia_prima.length > _size || $scope.registro.reg_aval_mao_obra && $scope.registro.reg_aval_mao_obra.length > _size || $scope.registro.reg_aval_equipamento && $scope.registro.reg_aval_equipamento.length > _size || $scope.registro.reg_aval_meio_ambiente && $scope.registro.reg_aval_meio_ambiente.length > _size || $scope.registro.reg_aval_outros && $scope.registro.reg_aval_outros.length > _size || $scope.registro.reg_aval_outros && $scope.registro.reg_aval_outros.length > _size)
            return false;

        return true;
    };
});