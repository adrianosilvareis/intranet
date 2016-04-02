/**
 * ****************************************
 * ******* Serviço do tipo SERVICES *******
 * ****************************************
 */

angular.module("agenda").service("setorAPI", function ($http, config) {

    this.getSetor = function () {
        return $http.get(config.apiURL + '/setores.api.php');
    };

    this.saveSetor = function (setor) {
        return $http.post(config.apiURL + "/setores.api.php", setor);
    };
});