angular.module('naoConformidade').factory("timestampInterceptor", function ($location) {

    var auth = function (urlAtual) {
        var userAuth = perfilUsuario.acessos;

        var paginas = [
            {link: 'painel.html', acesso: 'evento-indesejado'},
            {link: 'painel_master.html', acesso: 'evento-indesejado'},
            {link: 'registro.html', acesso: 'evento-cadastro'},
            {link: 'registro.html', acesso: 'evento-view'},
            {link: 'avaliacao.html', acesso: 'evento-avaliacao'},
            {link: 'admin/dashboard/geral.html', acesso: 'evento-admin'},
            {link: 'admin/dashboard/geral.html', acesso: 'evento-admin-relatorio'},
            {link: 'admin/dashboard/charts.html', acesso: 'evento-admin-grafico'},
            {link: 'admin/origens/listar.html', acesso: 'evento-origem'},
            {link: 'admin/origens/origem.html', acesso: 'evento-origem-cadastro'},
            {link: 'admin/origens/origem.html', acesso: 'evento-origem-update'},
            {link: 'admin/dashboard/registro.html', acesso: 'evento-admin-registro'},
            {link: 'admin/dashboard/avaliacao.html', acesso: 'evento-admin-avaliacao'}
        ];

        paginas.forEach(function (page) {
            if (urlAtual.indexOf(page.link) > -1) {

                var teste = userAuth.some(function (auth) {
                    return auth.acesso_name === page.acesso;
                });

                if (!teste)
                    $location.path("/blocked");
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
