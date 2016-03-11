<?php
$dir = HOME . "/" . REQUIRE_PATH . "/indicadores/downtime/";
Register::addRegister("<script src=\"{$dir}js/downtime.module.js\"></script>");
Register::addRegister("<script src=" . HOME . "/" . REQUIRE_PATH . "/js/angular/filter/timestampBr.filter.js></script>");
Register::addRegister("<script src=\"{$dir}js/controller/user.ctrl.js\"></script>");
Register::addRegister("<script src=\"{$dir}js/controller/equipamentos.ctrl.js\"></script>");
Register::addRegister("<script src=\"{$dir}js/controller/parada.ctrl.js\"></script>");
Register::addRegister("<script src=\"{$dir}js/google-chart/start.js\"></script>");
?>

<header id="navtab">
    <nav>
        <h1><a href="#dashboard" title="Dashboard" data-toggle="tab" onclick="alterClass('#dashboard')">Dashboard</a></h1>

        <!--Query String-->
        <ul class="menu">
            <li id="equipamento" class="li"><a class="opensub" onclick="return false;" href="">Equipamento</a>
                <ul class="sub">
                    <li><a href="#equip_create" onclick="alterClass('#equipamento')" data-toggle="tab">Criar Equipamento</a></li>
                    <li><a href="#equip_list" onclick="alterClass('#equipamento')" data-toggle="tab">Listar / Editar Equipamentos</a></li>
                </ul>
            </li>

            <li id="parada" class="li"><a class="opensub" onclick="return false;" href="">Parada</a>
                <ul class="sub">
                    <li><a href="#down_create" onclick="alterClass('#parada')" data-toggle="tab">Registrar Parada</a></li>
                    <li><a href="#down_list" onclick="alterClass('#parada')" data-toggle="tab">Listar / Editar Parada</a></li>
                </ul>
            </li>

            <!--<li class="li"><a href="../" target="_blank" class="opensub">Ver Site</a></li>-->
        </ul>
    </nav>
</header>

<div class="tab-content" ng-app="downtime">

    <div class="tab-pane" id="dashboard"></div>
    <!--Equipamento-->
    <div class="tab-content" ng-controller="equipamentos">
        <div class="tab-pane" id="equip_create"><?php require '/system/equipamentos/equipamento.php'; ?></div>
        <div class="tab-pane" id="equip_list"><?php require '/system/equipamentos/index.php'; ?></div>
    </div>

    <!--downtime-->
    <div class="tab-content" ng-controller="parada">
        <div class="tab-pane" id="down_create">down criar</div>
        <div class="tab-pane" id="down_list">down listar</div>
    </div>
</div>