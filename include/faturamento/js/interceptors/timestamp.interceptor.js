angular.module('faturamento').factory("timestampInterceptor", function ($location) {

    var auth = function (urlAtual) {
        var userAuth = perfilUsuario.acessos;

        var paginas = [
            {link: 'inconsistencia/inconsistencia.html', acesso: 'inco-cadastro'},
            {link: 'inconsistencia/index.html', acesso: 'inco-view'},
            {link: 'relatorios/inconsistencias.html', acesso: 'inco-relatorio'},
            {link: 'glosa/glosa.html', acesso: 'glosa-cadastro'},
            {link: 'glosa/index.html', acesso: 'glosa-view'},
            {link: 'relatorios/glosas.html', acesso: 'glosa-relatorio'},
            {link: 'convenio/convenio.html', acesso: 'convenio-cadastro'},
            {link: 'convenio/index.html', acesso: 'convenio-view'},
            {link: 'naoconformidade/naoconformidade.html', acesso: 'ncon-cadastro'},
            {link: 'naoconformidade/index.html', acesso: 'ncon-view'},
            {link: 'os-nao-pagas/uploads.html', acesso: 'os-nao-pagas-uploads'},
            {link: 'os-nao-pagas/index.html', acesso: 'os-nao-pagas-view'},
            {link: 'relatorios/os-nao-pagas.html', acesso: 'os-nao-pagas-relatorio'},
            {link: 'admin.html', acesso: 'faturamento-admin'},
            {link: 'relatorios/relatorios.html', acesso: 'relatorios'}
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
