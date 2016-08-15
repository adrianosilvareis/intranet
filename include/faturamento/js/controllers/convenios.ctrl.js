angular.module('faturamento').controller('convenios', function ($scope, config, objetoAPI, convenios, posts) {

    $scope.info = {};
    $scope.convenios = [];

    var init = function () {
        var data = convenios.data;
        if (Array.isArray(data)) {
            $scope.convenios = data;
        } else {
            $scope.info = data;
        }
    };

    $scope.alterarStatus = function (conv) {
        conv.conv_status = (conv.conv_status == '1' ? '0' : '1');

        objetoAPI.saveObjeto(config.urlAPI + '/convenios', conv)
                .success(function (data) {
                    conv = data;
                });
    };

    //carrega o post do convenio
    $scope.carregaPost = function (idPost) {
        var _posts = posts.data;
        var post = _posts.filter(function (post) {
            return post.post_id === idPost;
        })[0];

        return config.tiny + config.URL.HOME + "/uploads/" + post.post_cover + "&w=50&h=50";
    };

    init();
});