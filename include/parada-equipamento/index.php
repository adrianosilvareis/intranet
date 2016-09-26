<?php
$url = HOME . '/include/parada-equipamento';

if (!PRODUCAO):
    Register::addScript($url . '/js/app.module.js');
    Register::addScript($url . '/js/config/route.config.js');
    Register::addScript($url . '/js/config/interceptors.config.js');
    Register::addScript($url . '/js/config/config.value.js');
    Register::addScript($url . '/js/interceptors/error.interceptor.js');
    Register::addScript($url . '/js/interceptors/loading.interceptor.js');
    Register::addScript($url . '/js/interceptors/timestamp.interceptor.js');
    Register::addScript($url . '/js/controllers/equipamentos/equipamento.ctrl.js');
    Register::addScript($url . '/js/controllers/equipamentos/equipamentos.ctrl.js');
    Register::addScript($url . '/js/controllers/metas/meta.ctrl.js');
    Register::addScript($url . '/js/controllers/metas/metas.ctrl.js');
    Register::addScript($url . '/js/controllers/tipos/tipo.ctrl.js');
    Register::addScript($url . '/js/controllers/tipos/tipos.ctrl.js');
endif;
?>

<div ng-app="parada-equipamento" class="conteiner">

    <div ng-include="'<?= $url ?>/partials/menu.html'"></div>     
    
    <div ng-show="loading" class="col-md-offset-4">
        <img ng-src="<?= $url ?>/img/carregando.gif" class="img img-responsive"/>
    </div>
    
    <div ng-hide="loading">
        <div ng-view></div>
    </div>

    <div ng-include="'<?= $url; ?>/partials/footer.html'" class="text-center"></div>
</div>