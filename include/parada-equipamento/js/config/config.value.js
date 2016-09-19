angular.module('parada-equipamento').value('config', {
    URL: CONFIG,
    urlAPI: CONFIG.API + "/parada-equipamento",
    tiny: CONFIG.HOME + '/tim.php?src=',
    partials: CONFIG.HOME + '/include/parada-equipamento/partials',
    perfilUsuario: perfilUsuario
});