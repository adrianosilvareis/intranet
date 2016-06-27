angular.module('eventoIndesejado').controller('registro', function ($scope, objetoAPI, config, $routeParams, Upload) {

    $scope.registros = [];
    $scope.origens = [];
    $scope.areas = [];
    $scope.users = [];
    $scope.reg = {};

    var _registerHasOrigens = [];
    var _registerHasFile = [];
    var _registerHasImage = [];

    _objetcInit = function () {
        if ($scope.message === undefined)
            $scope.message = {};
        if ($scope.message.texto === undefined)
            $scope.message.texto = '';
        if ($scope.message.class === undefined)
            $scope.message.class = '';

        if ($scope.reg === undefined)
            $scope.reg = {};
        if ($scope.reg.origens === undefined)
            $scope.reg.origens = [];
        if ($scope.reg.images === undefined)
            $scope.reg.images = [];
        if ($scope.reg.files === undefined)
            $scope.reg.files = [];
    };

    var init = function () {
        _carregarRegistros();
        _carregarUsers();
        _carregarAreas();
        _carregarOrigens();
        _objetcInit();
    };

    var message = function (texto, classe) {
        $scope.message.texto = texto;
        $scope.message.class = classe;
    };
    
    $scope.addUser = function(user){
        $scope.reg.user_recebimento = user.user_id;
        $scope.reg.user = user;
        delete $scope.user_search;
    };
    
    $scope.addArea = function(area){
        $scope.reg.area_recebimento = area.area_id;
        $scope.reg.setor = area;
        delete $scope.area_search;
    };
    
    $scope.addOrigem = function (origem) {
        if ($scope.reg.disabled)
            return;

        origem.classe = !origem.classe;
        var _pos = $scope.reg.origens.indexOf(origem);
        if (_pos !== -1) {
            $scope.reg.origens.splice(_pos, 1);
        } else {
            $scope.reg.origens.push(origem);
        }
    };

    $scope.activeItem = function (origem) {
        if (origem.classe)
            return "list-group-item-success";
    };


    $scope.origemValid = function () {
        if ($scope.reg.origens && $scope.reg.origens.length > 0 || $scope.reg.reg_origem_outros && $scope.reg.reg_origem_outros.length > 3)
            return false;

        return true;
    };

    $scope.causaValid = function () {
        var _size = 5;
        if ($scope.reg.reg_aval_processo && $scope.reg.reg_aval_processo.length > _size || $scope.reg.reg_aval_materia_prima && $scope.reg.reg_aval_materia_prima.length > _size || $scope.reg.reg_aval_mao_obra && $scope.reg.reg_aval_mao_obra.length > _size || $scope.reg.reg_aval_equipamento && $scope.reg.reg_aval_equipamento.length > _size || $scope.reg.reg_aval_meio_ambiente && $scope.reg.reg_aval_meio_ambiente.length > _size || $scope.reg.reg_aval_outros && $scope.reg.reg_aval_outros.length > _size || $scope.reg.reg_aval_outros && $scope.reg.reg_aval_outros.length > _size)
            return false;

        return true;
    };

    $scope.removeFile = function (file) {
        if ($scope.reg.disabled)
            return;

        objetoAPI.saveObjeto(config.apiURL + '/removeFile.api.php', file).success(function (data) {
            $scope.reg.images = $scope.reg.images.filter(function (imagem) {
                if (imagem !== file)
                    return imagem;
            });

            $scope.reg.files = $scope.reg.files.filter(function (f) {
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
            _preview(resp.data);
        });
    };

    var _preview = function (data) {
        if (Array.isArray(data)) {
            data.filter(function (file) {
                if (file.FILE.type.indexOf('image') !== -1 && !file.ERROS)
                    $scope.reg.images.push(file);

            });
            
            data.filter(function (file) {
                if (file.FILE.type.indexOf('image') === -1 && !file.ERROS)
                    $scope.reg.files.push(file);
            });
            
            complete();
        } else {
            message(data, 'alert-danger');
            complete();
        }
    };

    var _params = function () {
        if ($routeParams.regId) {
            var idRegistro = $routeParams.regId;
            var registro = $scope.registros.filter(function (reg) {
                return reg.reg_id == idRegistro;
            })[0];

            if (registro) {
                $scope.reg = registro;
                $scope.reg.disabled = true;
                registro.edited = true;

                _carregarOther();
            } else {
                message('Registro não encontrado', 'alert-danger');
            }
        }
    };

    var cont = 0;
    var _mixins = function () {
        cont++;
        if (cont == 6) {

            $scope.reg.files = [];
            $scope.reg.files = _registerHasFile.filter(function (file) {
                return file.reg_id == $scope.reg.reg_id;
            });

            $scope.reg.images = [];
            $scope.reg.images = _registerHasImage.filter(function (image) {
                return image.reg_id == $scope.reg.reg_id;
            });


            var origens = _registerHasOrigens.filter(function (origem) {
                return origem.reg_id == $scope.reg.reg_id;
            });

            $scope.reg.origens = [];
            origens.filter(function (origem) {
                $scope.reg.origens = $scope.origens.filter(function (ori) {
                    return ori.origem_id == origem.origem_id;
                });
            });

            $scope.reg.area = [];
            $scope.reg.area = $scope.areas.filter(function (area) {
                return area.area_id == $scope.reg.area_recebimento;
            })[0];

            $scope.reg.user = [];
            $scope.reg.user = $scope.users.filter(function (user) {
                return user.user_id == $scope.reg.user_recebimento;
            })[0];
        }
    };

    $scope.save = function (registro) {
        objetoAPI.saveObjeto(config.apiURL + "/registro.api.php", registro).success(function (data) {
            message(data, 'alert-success');
            _novoRegistro();
        });
    };

    _novoRegistro = function () {
        reset();
        delete $scope.reg;
        _carregarRegistros();
        _objetcInit();
        $scope.registroForm.$setPristine();
    };

    var _carregarOther = function () {

        objetoAPI.getObjeto(config.apiURL + "/registroHasOrigem.api.php").success(function (data) {
            _registerHasOrigens = data;
            _mixins();
        });

        objetoAPI.getObjeto(config.apiURL + "/registroHasFile.api.php").success(function (data) {
            _registerHasFile = data;
            _mixins();
        });

        objetoAPI.getObjeto(config.apiURL + "/registroHasImage.api.php").success(function (data) {
            _registerHasImage = data;
            _mixins();
        });
    };

    var _carregarOrigens = function () {
        objetoAPI.getObjeto(config.apiURL + "/origem.api.php")
                .success(function (data) {
                    $scope.origens = data;
                    _mixins();
                })
                .error(function (error) {
                    message('Erro ao carregar Origens', 'alert-danger');
                    console.log(error);
                });
    };

    var _carregarAreas = function () {
        objetoAPI.getObjeto(config.apiURL + "/area.api.php")
                .then(
                        function (success) {
                            $scope.areas = success.data;
                            _mixins();
                        },
                        function (error) {
                            message('Erro ao carregar areas de trabalho', 'alert-danger');
                            console.log(error);
                        }
                );
    };

    var _carregarRegistros = function () {
        objetoAPI.getObjeto(config.apiURL + '/registro.api.php')
                .then(
                        function (success) {
                            $scope.registros = success.data;
                            _params();
                        },
                        function (error) {
                            message('Erro ao carregar Registros', 'alert-danger');
                            console.log(error);
                        }
                );
    };
    var _carregarUsers = function () {
        objetoAPI.getObjeto(config.apiURL + '/usuarios.api.php')
                .then(
                        function (success) {
                            $scope.users = success.data;
                            _mixins();
                        },
                        function (error) {
                            message('Erro ao carregar Usuários', 'alert-danger');
                            console.log(error);
                        }
                );
    };
    init();
});