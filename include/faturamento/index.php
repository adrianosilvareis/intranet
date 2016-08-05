<?php

$url = HOME . '/include/faturamento';

Register::addScript($url . '/js/app.model.js');
Register::addScript($url . '/js/config/route.config.js');
Register::addScript($url . '/js/config/config.value.js');
Register::addScript($url . '/js/controllers/convenio.ctrl.js');
Register::addScript($url . '/js/controllers/convenios.ctrl.js');
Register::addScript($url . '/js/controllers/naoconformidade.ctrl.js');
Register::addScript($url . '/js/controllers/naoconformidades.ctrl.js');
Register::addScript($url . '/js/controllers/glosa.ctrl.js');
Register::addScript($url . '/js/controllers/glosas.ctrl.js');
Register::addScript($url . '/js/controllers/inconsistencia.ctrl.js');
Register::addScript($url . '/js/controllers/inconsistencias.ctrl.js');
?>

<div ng-app="faturamento" class="conteiner">
    
    <div ng-view></div>
    
</div>