function down() {
    $("#list").slideUp("slow", function () {
        $("#form").slideDown();
    });
}

function up() {
    $("#form").slideUp(function () {
        $("#list").slideDown("slow");
    });
}

function notify(title, icon, content, link) {
    Notification.requestPermission(function () {
        var notification = new Notification(title, {
            icon: icon,
            body: content
        });
        notification.onclick = function () {
            window.open(link);
        };
    });
}

$(function () {
    $(".formDateTime").mask("99/99/9999 99:99:99", {placeholder: " "});
});

$(function () {
    $(".formDate").mask("99/99/9999", {placeholder: " "});
});

$("documents").ready(function () {

    $("#updatePassword").hide();

    $("#openPass").click(function (e) {
        e.preventDefault();
        $("#updatePassword").toggle('slow');
    });

    // Obtém todos os cookies do documento
    var cookies = document.cookie;

    // Verifica se o cookie existe
    if (cookies.indexOf("usuarioVisualizouNotificacao") === -1 && notification > 0) {
        // Entra aqui caso o cookie não exista no  navegador do usuário

        // Crio um objeto Date do Javascript pegando a data de hoje e incrementando + N min nessa data
        var min = 30;

        var prazo = new Date();
        prazo.setTime(prazo.getTime() + (min * 60 * 1000));

        // Converte a data para string
        prazo = prazo.toUTCString();

        // Crio o cookie com a data de expiração
        document.cookie = 'usuarioVisualizouNotificacao=SIM; expires=' + prazo + '; path=/';

        //Exibe a notificação da não conformidade;
        notify(title, icon, content, link);
    }

    // Verifica se o cookie existe
    if (cookies.indexOf("usuarioVisualizouModal") === -1) {
        // Entra aqui caso o cookie não exista no  navegador do usuário

        // Crio um objeto Date do Javascript pegando a data de hoje e incrementando + 1 dias nessa data
        var diasparaexpirar = 1;
        var horas = 2;

        var expiracao = new Date();
        expiracao.setTime(expiracao.getTime() + (diasparaexpirar * horas * 60 * 60 * 1000));

        // Converte a data para string
        expiracao = expiracao.toUTCString();

        // Crio o cookie com a data de expiração
        document.cookie = 'usuarioVisualizouModal=SIM; expires=' + expiracao + '; path=/';

        // Exibo o modal
        $("#myModal").modal("show");
    }

    // Verifica se o cookie existe
    if (cookies.indexOf("usuarioAtualizouPerfil") === -1) {
        // Entra aqui caso o cookie não exista no  navegador do usuário

        // Crio um objeto Date do Javascript pegando a data de hoje e incrementando + 1 dias nessa data
        var diasparaexpirar = 1;
        var min = 30;

        var expiracao = new Date();
        expiracao.setTime(expiracao.getTime() + (diasparaexpirar * min * 60 * 1000));

        // Converte a data para string
        expiracao = expiracao.toUTCString();

        // Crio o cookie com a data de expiração
        document.cookie = 'usuarioAtualizouPerfil=SIM; expires=' + expiracao + '; path=/';

        // Exibo o modal
        $("#updateInfo").modal("show");
    }
});