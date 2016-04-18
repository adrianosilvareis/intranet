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

    objectInit = function () {
        if ($scope.registro === undefined)
            $scope.registro = {};
        if ($scope.registro.origens === undefined)
            $scope.registro.origens = [];
        if ($scope.registro.images === undefined)
            $scope.registro.images = [];
        if ($scope.registro.files === undefined)
            $scope.registro.files = [];
    };

    $scope.addOrigem = function (origem) {
        objectInit();
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

    $scope.origemList = function () {
        objectInit();
        if ($scope.registro.origens && $scope.registro.origens.length > 0 || $scope.registro.reg_origem_outros && $scope.registro.reg_origem_outros.length > 3)
            return false;

        return true;
    };

    $scope.removeFile = function (file) {
        objetoAPI.saveObjeto(config.apiURL + '/removeFile.api.php', file).success(function (data) {
            console.log(data);
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
        objectInit();

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
        $scope.carregarObjetos();
        $scope.registroForm.$setPristine();
    };

    $scope.carregarObjetos();
});