/**
 * ****************************************
 * ******* Serviço do tipo SERVICES *******
 * ****************************************
 */

appAgenda.service("objetoAPI", function ($http) {

    this.getObjeto = function (url) {
        return $http.get(url);
    };

    this.saveObjeto = function (url, objeto) {
        return $http.post(url, objeto);
    };
});