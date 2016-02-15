<?php
define("NCONDIR", HOME . "/" . REQUIRE_PATH . "/plugin/nao-conformidade/js");
Register::addRegister("<script src='" . NCONDIR . "/model.app.js'></script>");
Register::addRegister("<script src='" . NCONDIR . "/config.value.js'></script>");
Register::addRegister("<script src='" . NCONDIR . "/controller/setor.ctrl.js'></script>");
?>

<div ng-app="naoConformidade">
    <div ng-controller="setor">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="setor in setores">
                    <td>{{setor.setor_descricao| name}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>