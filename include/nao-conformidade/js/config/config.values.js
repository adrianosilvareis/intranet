angular.module("naoConformidade").value("config", {
    URL: CONFIG,
    apiURL: CONFIG.API + "/nao-conformidade",
    session: "/intranet/api/session/session.api.php",
    userLogin: userLogin,
    perfilUsuario: perfilUsuario
});