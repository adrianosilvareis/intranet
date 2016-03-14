<?php
$dir = HOME . "/" . REQUIRE_PATH . "/indicadores/downtime/";
Register::addRegister("<script src=\"{$dir}js/downtime.module.js\"></script>");
Register::addRegister("<script src=" . HOME . "/" . REQUIRE_PATH . "/js/angular/filter/timestampBr.filter.js></script>");
Register::addRegister("<script src=\"{$dir}js/controller/user.ctrl.js\"></script>");
?>

<section class="section" ng-app="downtime">
    <h1><span style="font-size: 0.8em;color: #787878">Indicadores <small>Relatorio de tempo de parada</small></span></h1>

    <div class="btn-group" style="float: right;">
        <?php if (Check::UserLogin(3)): ?>
            <a href="<?= HOME ?>/indicadores/downtime/report" class="btn btn-primary glyphicon glyphicon-stats" title="relatorios"></a>
            <a href="<?= HOME ?>/indicadores/downtime/" class="btn btn-danger glyphicon glyphicon-floppy-disk" title="Registro"></a>
        <?php endif; ?>
        <?php if (Check::UserLogin(2)): ?>
            <a href="<?= HOME ?>/indicadores/downtime/admin"  class="btn btn-info glyphicon glyphicon-cog" title="Admin"></a>
        <?php endif; ?>
    </div>

    <div ng-controller="user">
        <?php
        if (!empty($Link->getLocal()[2]) && $Link->getLocal()[2] == "report" && Check::UserLogin(3)):
            Register::addRegister("<script src=\"{$dir}js/google-chart/start.js\"></script>");
            include 'report/index.php';
        elseif (!empty($Link->getLocal()[2]) && $Link->getLocal()[2] == "admin" && Check::UserLogin(2)):
            include 'system/index.php';
        else:
            include 'user.php';
        endif;
        ?>
    </div>

</section>