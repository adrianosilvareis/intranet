<?php
define("AGENDADIR", HOME . "/" . REQUIRE_PATH . "/plugin/agenda/js");
//registro de script Angular
Register::addRegister("<script src='" . AGENDADIR . "/model.app.js'></script>");
Register::addRegister("<script src='" . AGENDADIR . "/config.value.js'></script>");
Register::addRegister("<script src='" . AGENDADIR . "/controller/home.ctrl.js'></script>");
Register::addRegister("<script src='" . AGENDADIR . "/services/objetoAPI.services.js'></script>");
Register::addRegister("<script src='" . AGENDADIR . "/filter/name.filter.js'></script>");
Register::addRegister("<script src='" . AGENDADIR . "/filter/maxlength.filter.js'></script>");
?>

<div ng-app="agenda">
    <?php
    if (!empty($Link->getLocal()[2]) && $Link->getLocal()[2] == "admin" && Check::UserLogin(3)):
        Register::addRegister("<script src='" . AGENDADIR . "/controller/setor.ctrl.js'></script>");
        Register::addRegister("<script src='" . AGENDADIR . "/controller/contato.ctrl.js'></script>");
        Register::addRegister("<script src='" . AGENDADIR . "/services/contatoAPI.services.js'></script>");
        Register::addRegister("<script src='" . AGENDADIR . "/services/setorAPI.services.js'></script>");
        Register::addRegister("<script src='" . AGENDADIR . "/directive/uiTel.directive.js'></script>");
        Register::addRegister("<script src='" . AGENDADIR . "/directive/uiCep.directive.js'></script>");
        Register::addRegister("<script src='" . AGENDADIR . "/directive/uiSite.directive.js'></script>");
        include 'admin.php';
    else:
        Register::addRegister("<script src='" . AGENDADIR . "/controller/user.ctrl.js'></script>");
        include 'user.php';
    endif;
    ?>
</div>