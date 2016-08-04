/**
 * ****************************************
 * ******* Serviço do tipo SERVICES *******
 * ****************************************
 */
angular.module("objetoAPI").service("objetoAPI", function ($http) {

    this.getObjeto = function (url) {
        return $http.get(url);
    };

    this.saveObjeto = function (url, objeto) {
        return $http.post(url, objeto);
    };

    this.deleteObjeto = function (url) {
        return $http.delete(url);
    };
});