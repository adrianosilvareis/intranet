<?php
if (!Check::UserPermission('evento-indesejado')):
    header("Location: " . HOME . "/401");
endif;

if (!PRODUCAO):
    define("EVENTO", HOME . "/include/nao-conformidade/js");
    Register::addRegister("<script src='" . EVENTO . "/app.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/config/config.values.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/config/routes.config.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/config/interceptors.config.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/interceptors/error.interceptor.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/interceptors/loading.interceptor.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/interceptors/timestamp.interceptor.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/controllers/registro.ctrl.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/controllers/registros.ctrl.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/controllers/masterList.ctrl.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/controllers/admin/dashboard.ctrl.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/controllers/admin/origens.ctrl.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/controllers/admin/origem.ctrl.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/filters/ativos.filter.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/filters/regUsuarios.filter.js'></script>");
    Register::addRegister("<script src='" . EVENTO . "/filters/regAreas.filter.js'></script>");
endif;
?>

<div ng-app="naoConformidade" class="conteiner">
    
     <div ng-show="loading" class="col-md-offset-4">
        <img src="<?= HOME . "/include/nao-conformidade/img/carregando.gif"; ?>" class="img img-responsive"/>
    </div>

    <div ng-hide="loading">
        <div ng-view></div>
    </div>

</div>