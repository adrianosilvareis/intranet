/**
 * ****************************************
 * ******** Serviço tipo FACTORY **********
 * ****************************************
 */

appAgenda.factory("contatosAPI", function ($http, config) {

    var _getContatos = function () {
        return $http.get(config.apiURL + "/contatos.api.php");
    };

    var _saveContato = function (contato) {
        return $http.post(config.apiURL + "/contatos.api.php", contato);
    };

    return {
        getContatos: _getContatos,
        saveContato: _saveContato
    };
});