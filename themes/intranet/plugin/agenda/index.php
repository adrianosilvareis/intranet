<?php
//registro de script Angular
Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/model.app.js'></script>");
Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/config.value.js'></script>");
Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/controller/home.ctrl.js'></script>");
Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/services/objetoAPI.services.js'></script>");
Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/filter/name.filter.js'></script>");
Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/filter/maxlength.filter.js'></script>");
?>

<div ng-app="agenda">
    <?php
    if (!empty($Link->getLocal()[2]) && $Link->getLocal()[2] == "admin" && Check::UserLogin(3)):
        Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/controller/setor.ctrl.js'></script>");
        Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/controller/contato.ctrl.js'></script>");
        Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/services/contatoAPI.services.js'></script>");
        Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/services/setorAPI.services.js'></script>");
        Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/directive/uiTel.directive.js'></script>");
        Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/directive/uiCep.directive.js'></script>");
        Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/directive/uiSite.directive.js'></script>");
        include 'admin.php';
    else:
        Register::addRegister("<script src='" . HOME . DIRECTORY_SEPARATOR . REQUIRE_PATH . "/plugin/agenda/js/controller/user.ctrl.js'></script>");
        include 'user.php';
    endif;
    ?>
</div>