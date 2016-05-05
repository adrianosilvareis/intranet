angular.module("naoConformidade").controller('registroUser', function ($scope, objetoAPI, config, Upload) {

    _registerHasOrigens = [];
    _registerHasFile = [];
    _registerHasImage = [];
    
    _clearObjetc = function () {
        $scope.registros = [];
        $scope.origens = [];
        $scope.usuarios = [];
        $scope.setores = [];
        $scope.userlogin = {};
        _carregarRegistrosUser();
    };

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

    _carregarRegistrosUser = function () {
        objetoAPI.getObjeto(config.apiURL + "/registroHasOrigem.api.php").success(function (data) {
            _registerHasOrigens = data;
            mixin();
        });
        objetoAPI.getObjeto(config.apiURL + "/registroHasFile.api.php").success(function (data) {
            _registerHasFile = data;
            mixin();
        });
        objetoAPI.getObjeto(config.apiURL + "/registroHasImage.api.php").success(function (data) {
            _registerHasImage = data;
            mixin();
        });

        objetoAPI.getObjeto(config.apiURL + "/registro.api.php").success(function (data) {
            $scope.registros = data;
            mixin();
        });

        objetoAPI.getObjeto(config.apiURL + "/usuarios.api.php").success(function (data) {
            $scope.usuarios = data;
            mixin();
        });

        objetoAPI.getObjeto(config.apiURL + "/setor.api.php").success(function (data) {
            $scope.setores = data;
            mixin();
        });

        var data = {userOnline: true};
        objetoAPI.saveObjeto(config.apiURL + "/usuarios.api.php", data).success(function (data) {
            $scope.userlogin = data;
        });

        objetoAPI.getObjeto(config.apiURL + "/origem.api.php").success(function (data) {
            $scope.origens = data;
            mixin();
        });
    };

    var _cont = 0;
    var mixin = function () {
//        $scope.registros.length > 0 && $scope.usuarios.length > 0 && $scope.setores.length > 0 && $scope.origens.length > 0 && _registerHasOrigens.length > 0

        _cont++;
        if (_cont === 7) {
            $scope.registros.map(function (reg) {
                reg.user_lastupdate = $scope.usuarios.filter(function (user) {
                    if (user.user_id === reg.user_lastupdate)
                        return user;
                })[0];

                reg.user_cadastro = $scope.usuarios.filter(function (user) {
                    if (user.user_id === reg.user_cadastro)
                        return user;
                })[0];

                reg.user_recebimento = $scope.usuarios.filter(function (user) {
                    if (user.user_id === reg.user_recebimento)
                        return user;
                })[0];

                reg.setor_recebimento = $scope.setores.filter(function (setor) {
                    if (reg.setor_recebimento === setor.setor_id)
                        return setor;
                })[0];

                _registerHasOrigens.filter(function (origem) {
                    if (reg.reg_id === origem.reg_id) {
                        reg.origens = $scope.origens.filter(function (object) {
                            if (origem.origem_id === object.origem_id) {
                                return object;
                            }
                        });
                    }
                });

                reg.images = _registerHasImage.filter(function (image) {
                    if (reg.reg_id === image.reg_id)
                        return image;
                });

                reg.files = _registerHasFile.filter(function (file) {
                    if (reg.reg_id === file.reg_id)
                        return file;
                });
            });
        }
    };

    $scope.addOrigem = function (origem) {
        _objetcInit();
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
        _objetcInit();
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
        _carregarRegistrosUser();
        _objetcInit();
        $scope.registroForm.$setPristine();
    };

    $scope.openView = function (view) {
        $scope.view = view;
    };

    $scope.getAllList = function () {
        return "/intranet/include/nao-conformidade/system/user/listasAll/" + $scope.view + ".html";
    };

    $scope.openRegistro = function (reg) {
        reg.disabled = true;
        $scope.registro = reg;
    };

    $scope.closeRegistro = function () {
        delete $scope.registro;
        _clearObjetc();
    };

    $scope.openView('todos');
    _clearObjetc();

});