<?php
if (!PRODUCAO):
    define("EVENTO", HOME . "/include/evento-indesejado/js");
    Register::addRegister("<script src='" . EVENTO . "/app.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/config/config.values.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/config/routes.config.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/controllers/registro.ctrl.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/controllers/registros.ctrl.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/controllers/masterList.ctrl.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/controllers/admin/dashboard.ctrl.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/controllers/admin/origens.ctrl.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/controllers/admin/origem.ctrl.js'></script>");
endif;
?>

<div ng-app="ej" class="conteiner">

    <div ng-view></div>

</div>