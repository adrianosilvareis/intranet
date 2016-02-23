<?php
define("NCONDIR", HOME . "/" . REQUIRE_PATH . "/plugin/nao-conformidade/js");
Register::addRegister("<script src='" . NCONDIR . "/model.app.js'></script>");
Register::addRegister("<script src='" . NCONDIR . "/config.value.js'></script>");
Register::addRegister("<script src='" . NCONDIR . "/controller/setor.ctrl.js'></script>");
?>

<div ng-app="naoConformidade">
    <div ng-controller="setor">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="setor in setores">
                    <td>{{setor.setor_content| name}}</td>
                    <td>{{setor.setor_email}}</td>
                    <td>{{setor.setor_category | name}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>