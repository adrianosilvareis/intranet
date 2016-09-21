angular.module('parada-equipamento').factory("timestampInterceptor", function ($location) {

    var auth = function (urlAtual) {
        var userAuth = perfilUsuario.acessos;

        var paginas = [
//            {link: 'inconsistencia/inconsistencia.html', acesso: 'inco-cadastro'};
        ];

        paginas.forEach(function (page) {
            if (urlAtual.indexOf(page.link) > -1) {
                
                var teste = userAuth.some(function (auth) {
                    return auth.acesso_name === page.acesso;
                });
                
                if (!teste)
                    $location.path("/auth");
            }
        });
    };

    return {
        request: function (config) {
            var url = config.url;
            //verifica se uma url não é um include
            if (url.indexOf('partials') > -1) {
                auth(url);
                return config;
            }

            //para toda requisição ao backend, cria-se uma url unica para burlar o cacheamento.
            var timestamp = new Date().getTime();
            config.url = url + "&timestamp=" + timestamp;
            return config;
        }
    };
});
