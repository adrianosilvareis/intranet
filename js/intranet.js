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
    $(".formDate").mask("99/99/9999 99:99:99", {placeholder: " "});
});

$("documents").ready(function () {
    
    // Obtém todos os cookies do documento
    var cookies = document.cookie;

    // Verifica se o cookie existe
    if (cookies.indexOf("usuarioVisualizouNotificacao") === -1 && notification > 0) {
        // Entra aqui caso o cookie não exista no  navegador do usuário

        // Crio um objeto Date do Javascript pegando a data de hoje e incrementando + 1 dias nessa data
        var diasparaexpirar = 1;
        var horas = 1;

        var expiracao = new Date();
        expiracao.setTime(expiracao.getTime() + (diasparaexpirar * horas * 60 * 60 * 1000));

        // Converte a data para string
        expiracao = expiracao.toUTCString();

        // Crio o cookie com a data de expiração
        document.cookie = 'usuarioVisualizouNotificacao=SIM; expires=' + expiracao + '; path=/';

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
});