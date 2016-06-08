angular.module("naoConformidade", ["ngMessages", 'ngRoute', "objetoAPI", 'uiFormat', 'filterDefault', 'ngFileUpload']);

/**
 * Não conformdiade recebida para setor e usuario 
 */
angular.module("naoConformidade").filter('userOrSetorRecebido', function () {
    return function (input, useronline) {
        var output = input.filter(function (objeto) {
            if (objeto.user_recebimento.user_id === useronline.user_id || objeto.area_recebimento.area_id === useronline.area_id) {
                return objeto;
            }
        });
        return output;
    };
});

/**
 * Não conformdiade enviada para setor e usuario 
 */
angular.module("naoConformidade").filter('userOrSetorEnviado', function () {
    return function (input, useronline) {
        
        var output = input.filter(function (objeto) {
            if (objeto.user_cadastro.user_id === useronline.user_id || objeto.user_cadastro.area_id === useronline.area_id) {
                return objeto;
            }
        });
        return output;
    };
});
