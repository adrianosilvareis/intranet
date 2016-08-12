angular.module('faturamento').value('config', {
    URL: CONFIG,
    urlAPI: CONFIG.API + "/faturamento",
    tiny: CONFIG.HOME + '/tim.php?src=',
    partials: CONFIG.HOME + '/include/faturamento/partials',
    perfilUsuario: perfilUsuario
});