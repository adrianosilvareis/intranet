angular.module('faturamento').value('config', {
    URL: CONFIG,
    apiURL: CONFIG.API + "/faturamento",
    partials: CONFIG.HOME + '/include/faturamento/partials',
    perfilUsuario: perfilUsuario
});