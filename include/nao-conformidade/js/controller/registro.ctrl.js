angular.module("naoConformidade").controller("registro", function ($scope, objetoAPI, config, Upload) {

    $scope.origens = [];
    $scope.setores = [];
    $scope.usuarios = [];
    $scope.registros = [];
    
    _objetcInit = function () {
        if ($scope.registro === undefined)
            $scope.registro = {};
        if ($scope.registro.origens === undefined)
            $scope.registro.origens = [];
        if ($scope.registro.images === undefined)
            $scope.registro.images = [];
        if ($scope.registro.files === undefined)
            $scope.registro.files = [];
    };

    _carregarRegistros = function () {
        objetoAPI.getObjeto(config.apiURL + "/origem.api.php").success(function (data) {
            $scope.origens = data;
        });

        objetoAPI.getObjeto(config.apiURL + "/area.api.php").success(function (data) {
            $scope.setores = data;
        });

        objetoAPI.getObjeto(config.apiURL + "/usuarios.api.php").success(function (data) {
            $scope.usuarios = data;
        });

        objetoAPI.getObjeto(config.apiURL + "/registro.api.php").success(function (data) {
            $scope.registros = data;
        });
    };

    $scope.addOrigem = function (origem) {
        if ($scope.registro.disabled)
            return;

        origem.classe = !origem.classe;
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

    $scope.origemValid = function () {
        if ($scope.registro.origens && $scope.registro.origens.length > 0 || $scope.registro.reg_origem_outros && $scope.registro.reg_origem_outros.length > 3)
            return false;

        return true;
    };

    $scope.removeFile = function (file) {
        if ($scope.registro.disabled)
            return;

        objetoAPI.saveObjeto(config.apiURL + '/removeFile.api.php', file).success(function (data) {
            $scope.registro.images = $scope.registro.images.filter(function (imagem) {
                if (imagem !== file)
                    return imagem;
            });

            $scope.registro.files = $scope.registro.files.filter(function (f) {
                if (f !== file)
                    return f;
            });
        });
    };

    $scope.onFileSelect = function (files) {
        if (!files)
            return;
        start();
        Upload.upload({
            url: config.apiURL + '/upload.api.php',
            data: {files: files}
        }).then(function (resp) {
            delete $scope.uploads;
            preview(resp.data);
        });
    };
    
    preview = function (data) {
        if (Array.isArray(data)) {
            data.filter(function (file) {
                if (file.FILE.type.indexOf('image') !== -1)
                    $scope.registro.images.push(file);
            });
            data.filter(function (file) {
                if (file.FILE.type.indexOf('image') === -1)
                    $scope.registro.files.push(file);
            });
            complete();
        }
    };

    $scope.saveRegistro = function (registro) {
        objetoAPI.saveObjeto(config.apiURL + "/registro.api.php", registro).success(function (data) {
            $scope.message = data;
            $scope.novoRegistro();
        });
    };

    $scope.novoRegistro = function () {
        reset();
        delete $scope.registro;
        _carregarRegistros();
        _objetcInit();
        $scope.registroForm.$setPristine();
    };

    _carregarRegistros();
    _objetcInit();
});