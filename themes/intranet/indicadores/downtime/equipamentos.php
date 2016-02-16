<section class="section" ng-app="downtime">
    <h1><span style="font-size: 0.8em;color: #787878">Indicadores</span></h1>

    <div ng-controller="user">

        <div ng-if="!carregando">;
            <img src="<?= HOME ?>/<?= REQUIRE_PATH ?>/images/ajax-loader.gif">
        </div>

        <table class="table" ng-if="carregando">

            <thead>
                <tr>
                    <th>Equipamento</th>
                    <th>Ultima Alteração</th>
                    <th>Responsavel</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="equip in equipamentos">
                    <td>{{equip.equip_title| name}}</td>
                    <td>{{equip.equip_lastupdate}}</td>
                    <td>{{equip.equip_author}}</td>
                    <td ng-if="equip.stoped"><button ng-disabled="!equip.author" class="btn btn-success" title="start"><span class="glyphicon glyphicon-ok" ng-click="update(equip)"></span></button></td>
                    <td ng-if="!equip.stoped"><button ng-disabled="!equip.author" class="btn btn-danger" title="stop"><span class="glyphicon glyphicon-off" ng-click="update(equip)"></span></button></td>
                    <td><input class="form-control" type="text" placeholder="Digite seu nome" ng-model="equip.author" ng-required="true" ng-minlength="3"/></td>
                </tr>
            </tbody>
            {{form}}
        </table>

    </div>

</section>