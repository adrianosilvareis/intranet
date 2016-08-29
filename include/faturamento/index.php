<?php
$url = HOME . '/include/faturamento';

if (!PRODUCAO):
    Register::addScript($url . '/js/app.module.js');
    Register::addScript($url . '/js/config/route.config.js');
    Register::addScript($url . '/js/config/interceptors.config.js');
    Register::addScript($url . '/js/config/config.value.js');
    Register::addScript($url . '/js/directives/uiAlert.directive.js');
    Register::addScript($url . '/js/controllers/convenio.ctrl.js');
    Register::addScript($url . '/js/controllers/convenios.ctrl.js');
    Register::addScript($url . '/js/controllers/naoconformidade.ctrl.js');
    Register::addScript($url . '/js/controllers/naoconformidades.ctrl.js');
    Register::addScript($url . '/js/controllers/glosa.ctrl.js');
    Register::addScript($url . '/js/controllers/glosas.ctrl.js');
    Register::addScript($url . '/js/controllers/inconsistencia.ctrl.js');
    Register::addScript($url . '/js/controllers/inconsistencias.ctrl.js');
    Register::addScript($url . '/js/controllers/particular.ctrl.js');
    Register::addScript($url . '/js/controllers/uploadParticular.ctrl.js');
    Register::addScript($url . '/js/interceptors/timestamp.interceptor.js');
    Register::addScript($url . '/js/interceptors/error.interceptor.js');
    Register::addScript($url . '/js/interceptors/loading.interceptor.js');
endif;
?>

<div ng-app="faturamento" class="conteiner">

    <div ng-show="loading" class="col-md-offset-4">
        <img src="<?= HOME . "/include/faturamento/img/carregando.gif"; ?>" class="img img-responsive"/>
    </div>

    <div ng-hide="loading">
        <div ng-view></div>
    </div>

    <div ng-include="'<?= $url; ?>/partials/footer.html'" class="text-center"></div>
</div>