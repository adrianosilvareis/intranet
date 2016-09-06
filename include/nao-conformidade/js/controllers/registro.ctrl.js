angular.module('naoConformidade').controller('registro',
        function (registro, registroHasOrigem, registroHasFile, registroHasImage, usuarios, origens, areas, $scope, objetoAPI, config, $routeParams, Upload) {

            //
            //variaveis
            //
            $scope.partials = CONFIG.HOME + '/include/nao-conformidade/partials';
            $scope.urlMessage = CONFIG.HOME + '/include/nao-conformidade/partials/message/message-registro.html';
            $scope.area_search = "";
            $scope.registros = [];
            $scope.origens = [];
            $scope.areas = [];
            $scope.users = [];
            $scope.reg = {};

            //
            //variaveis privadas
            //
            var _registerHasOrigens = [];
            var _registerHasFile = [];
            var _registerHasImage = [];

            //
            //inicio da palicação
            //
            var init = function () {
                $scope.users = usuarios.data;
                $scope.areas = areas.data;
                $scope.origens = origens.data;
                _objetcInit();
                _params();
            };

            //
            //verifica que foi passado id de um registro
            //
            var _params = function () {
                if ($routeParams.regId) {                    
                    $scope.reg = registro.data;
                    $scope.reg.disabled = true;
                    _registerHasOrigens = registroHasOrigem.data;
                    _registerHasFile = registroHasFile.data;
                    _registerHasImage = registroHasImage.data;
                    addAtributos();
                } else {
                    if ($scope.origens && $scope.areas && $scope.users) {
                        $scope.carregando = false;
                    }
                }
            };

            //
            //Quando tudo estiver carregado, executa a adição das informações ao registro
            //
            var addAtributos = function () {

                $scope.reg.files = [];
                if (Array.isArray(_registerHasFile)) {
                    $scope.reg.files = _registerHasFile.filter(function (file) {
                        return file.reg_id == $scope.reg.reg_id;
                    });
                }

                $scope.reg.images = [];
                if (Array.isArray(_registerHasImage)) {
                    $scope.reg.images = _registerHasImage.filter(function (image) {
                        return image.reg_id == $scope.reg.reg_id;
                    });
                }

                if (Array.isArray(_registerHasOrigens)) {
                    var origens = _registerHasOrigens.filter(function (origem) {
                        return origem.reg_id == $scope.reg.reg_id;
                    });

                    $scope.reg.origens = [];
                    origens.filter(function (origem) {
                        $scope.reg.origens = $scope.origens.filter(function (ori) {
                            return ori.origem_id == origem.origem_id;
                        });
                    });
                }

                $scope.reg.area = [];
                $scope.reg.area = $scope.areas.filter(function (area) {
                    return area.area_id == $scope.reg.area_recebimento;
                })[0];

                $scope.reg.user = [];
                $scope.reg.user = $scope.users.filter(function (user) {
                    return user.user_id == $scope.reg.user_recebimento;
                })[0];
            };

            //
            //iniciar objeto message e registro
            //
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

            var message = function (texto, classe) {
                $scope.message.texto = texto;
                $scope.message.class = classe;
            };

            //
            //Adicionar usuario
            //    
            $scope.addUser = function (user) {
                $scope.reg.user_recebimento = user.user_id;
                $scope.reg.user = user;
                delete $scope.user_search;
            };

            //
            //Adicionar area
            //    
            $scope.addArea = function (area) {
                $scope.reg.area_recebimento = area.area_id;
                $scope.reg.area = area;
                delete $scope.area_search;
            };

            //
            //Adicionar origem
            //    
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

            //
            //origem selecionada
            //    
            $scope.activeItem = function (origem) {
                if (origem.classe)
                    return "list-group-item-success";
            };

            //
            //Validação de formulario para origem
            //    
            $scope.origemValid = function () {
                if ($scope.reg.origens && $scope.reg.origens.length > 0 || $scope.reg.reg_origem_outros && $scope.reg.reg_origem_outros.length > 3)
                    return false;

                return true;
            };

            //
            //Validação de formulario para avaliação de causa
            //
            $scope.causaValid = function () {
                var _size = 5;
                if ($scope.reg.reg_aval_processo && $scope.reg.reg_aval_processo.length > _size || $scope.reg.reg_aval_materia_prima && $scope.reg.reg_aval_materia_prima.length > _size || $scope.reg.reg_aval_mao_obra && $scope.reg.reg_aval_mao_obra.length > _size || $scope.reg.reg_aval_equipamento && $scope.reg.reg_aval_equipamento.length > _size || $scope.reg.reg_aval_meio_ambiente && $scope.reg.reg_aval_meio_ambiente.length > _size || $scope.reg.reg_aval_outros && $scope.reg.reg_aval_outros.length > _size || $scope.reg.reg_aval_outros && $scope.reg.reg_aval_outros.length > _size)
                    return false;

                return true;
            };

            //
            //Remover arquivo selecionado
            //
            $scope.removeFile = function (file) {

                var urlFile = file.FILE.tmp_name;
                if ($scope.reg.disabled)
                    return;

                objetoAPI.deleteObjeto(config.apiURL + '/upload/&fileUrl=' + urlFile).success(function (data) {
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

            //
            //Upload de arquivo automatico
            //
            $scope.onFileSelect = function (files) {
                if (!files)
                    return;
                start();
                Upload.upload({
                    url: config.apiURL + '/upload',
                    data: {files: files}
                }).then(function (resp) {
                    delete $scope.uploads;
                    _preview(resp.data);
                });
            };

            //
            //Visualização de arquivo adicionado
            //
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

            //
            //Savar registro
            //
            $scope.save = function (registro) {
                objetoAPI.saveObjeto(config.apiURL + "/registro", registro).success(function (data) {
                    message("adicionado com sucesso!", 'alert-success');
                    $scope.reg = data;
                });
            };

            //
            //Limpar formulario
            //
            $scope.novoRegistro = function (reg) {
                delete $scope.reg;
                reset();
                _objetcInit();
                $scope.registroForm.$setPristine();
            };

            //
            //iniciar aplicação
            //
            init();
        });