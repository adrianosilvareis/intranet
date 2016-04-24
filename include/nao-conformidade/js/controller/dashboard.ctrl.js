angular.module('naoConformidade').controller('dashboard', function ($scope, objetoAPI, config) {

    $scope.registros = [];

    _carregarObjetos = function () {
        objetoAPI.getObjeto(config.apiURL + '/registro.api.php').success(function (data) {
            console.log(data);
        });
    };
    
    _carregarObjetos();

});