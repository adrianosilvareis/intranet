<section class="section" ng-app="downtime">
    <h1><span style="font-size: 0.8em;color: #787878">Indicadores</span></h1>

    <div ng-controller="user">

        <div ng-if="!carregando">
            <img src="<?= HOME ?>/<?= REQUIRE_PATH ?>/images/ajax-loader.gif">
        </div>
        <div class="well">
            <form class="form-inline">
                <span class="form-control">{{equip.equip_title}}</span>
                <input class="form-control" type="text" placeholder="Digite seu nome" ng-model="equip.equip_author"/>
                <button ng-if="equip.downtime[0]" class="btn btn-success" title="start"><span class="glyphicon glyphicon-ok" ng-click="update(equip)"></span></button>
                <button ng-if="!equip.downtime[0]" class="btn btn-danger" title="stop"><span class="glyphicon glyphicon-off" ng-click="update(equip)"></span></button>
            </form>
        </div>
        
        {{equip}}

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

                    <td><a href="" ng-click="isEquipSelected(equip)">{{equip.equip_title}}</a></td>
                    <td>{{equip.equip_lastupdate}}</td>
                    <td>{{equip.equip_author}}</td>

                </tr>
            </tbody>
        </table>

    </div>

</section>