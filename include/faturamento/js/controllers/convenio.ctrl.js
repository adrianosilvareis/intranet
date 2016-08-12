angular.module('faturamento').controller('convenio', function ($scope, config, $routeParams, objetoAPI, posts) {
    
    $scope.info = {};

    //
    // Funções publicas
    //

    //salva as alterações
    $scope.save = function (conv) {
        objetoAPI.saveObjeto(config.urlAPI + '/convenios', conv)
                .success(function (data) {
                    if (data.conv_id) {
                        $scope.conv = data;
                        carregaPost();
                        $scope.info = {
                            status: '200',
                            message: 'Convênio salvo com sucesso!'
                        };
                    } else {
                        $scope.info = data;
                    }
                })
                .error(error);
    };

    //limpa os dados
    $scope.novo = function () {
        $scope.conv = {};
    };

    //exibe a imagem
    $scope.tinyImg = function (url) {
        return config.tiny + config.URL.HOME + "/uploads/" + url + "&w=100&h=100";
    };

    //adiciona o post
    $scope.addPost = function (post) {
        delete $scope.search;
        $scope.conv.post = post;
    };

    //remove post do convênio
    $scope.removePost = function () {
        delete $scope.conv.post;
    };

    //
    // Funções privadas
    //

    //inicia a aplicação
    var init = function () {
        if ($routeParams.id) {
            carregarConvenio($routeParams.id);
        }
    };

    var carregarConvenio = function (id) {
        objetoAPI.getObjeto(config.urlAPI + '/convenios/&id=' + id)
                .success(success)
                .error(error);
    };

    //busca com sucesso
    var success = function (data) {
        if (data.conv_id) {
            $scope.conv = data;
            carregaPost();
        } else {
            $scope.info = data;
        }
    };

    //erro na busca
    var error = function (error) {
        $scope.info = error;
    };

    //carrega o post do convenio
    var carregaPost = function () {
        $scope.conv.post = $scope.posts.filter(function (post) {
            return post.post_id === $scope.conv.post_id;
        })[0];
    };

    //
    // Execuções
    //

    //executa função de inicio
    init();
});