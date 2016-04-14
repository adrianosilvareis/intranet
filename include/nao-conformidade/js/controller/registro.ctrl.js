angular.module("naoConformidade").controller("registro", function ($scope, objetoAPI, config, Upload) {

    $scope.origens = [];
    $scope.setores = [];
    $scope.usuarios = [];

    $scope.carregarObjetos = function () {
        objetoAPI.getObjeto(config.apiURL + "/origem.api.php").success(function (data) {
            $scope.origens = data;
        });

        objetoAPI.getObjeto(config.apiURL + "/setor.api.php").success(function (data) {
            $scope.setores = data;
        });

        objetoAPI.getObjeto(config.apiURL + "/usuarios.api.php").success(function (data) {
            $scope.usuarios = data;
        });
    };

    $scope.addOrigem = function (origem) {
        origem.classe = !origem.classe;
        if ($scope.registro === undefined) {
            $scope.registro = {};
            $scope.registro.origens = [];
        }

        if ($scope.registro.origens === undefined)
            $scope.registro.origens = [];

        var _pos = $scope.registro.origens.indexOf(origem);
        if (_pos !== -1) {
            $scope.registro.origens.splice(_pos, 1);
        } else {
            $scope.registro.origens.push(origem);
        }
    };

    $scope.activeItem = function (origem) {
        if (origem.classe)
            return "list-group-item-success";
    };

    $scope.onFileSelect = function (files) {
        if (!files)
            return;
        Upload.upload({
            url: config.apiURL + '/upload.api.php',
            data: {files: files}
        }).then(function (resp) {
            // file is uploaded successfully
            console.log(resp.data);
        });
    };

    $scope.saveRegistro = function (registro) {
        console.log(registro);
        objetoAPI.saveObjeto(config.apiURL + "/registro.api.php", registro).success(function (data) {
            console.log(data);
        });
    };

    $scope.novoRegistro = function () {
        delete $scope.registro;
        $scope.carregarObjetos();
    };

    $scope.carregarObjetos();
});