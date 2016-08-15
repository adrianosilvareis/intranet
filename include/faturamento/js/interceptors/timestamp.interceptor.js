angular.module('faturamento').factory("timestampInterceptor", function(){
    return {
        request: function(config){
            var url = config.url;
            //verifica se uma url não é um include
            if(url.indexOf('partials') > -1) return config;
            
            //para toda requisição ao backend, cria-se uma url unica para burlar o cacheamento.
            var timestamp = new Date().getTime();
            config.url = url + "&timestamp=" + timestamp;
            return config;
        }
    };
});