<p ng-if="message" class="trigger accept">{{message}}<span class="ajax_close"></span></p> 

<table class="table table-striped table-hover" ng-if="equipamentos">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Setor</th>
            <th>Data Ativação</th>
            <th>Ultima Atulização</th>
            <th>Painel</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="equipamento in equipamentos">
            <td><a href="#equip_create" ng-click="equipamentoId(equipamento)" data-toggle="tab">{{equipamento.equip_title| name}}</a></td>
            <td>{{equipamento.equip_content| name}}</td>
            <td>{{equipamento.setor_content}}</td>
            <td>{{equipamento.equip_date| timestampBr}}</td>
            <td>{{equipamento.equip_lastupdate| timestampBr}}</td>
            <td>
                <ul class="info post_actions" style="width: 100px;">
                    <li ng-if="equipamento.equip_status == false"><a class="act_ative" href="" ng-click="alterStatus(equipamento)" title="Ativar">Ativar</a></li>
                    <li ng-if="equipamento.equip_status == true"><a class="act_inative" href="" ng-click="alterStatus(equipamento)" title="Inativar">Inativar</a></li>
                    <li><a class="act_delete" href="" ng-click="apagarEquipamento(equipamento)" title="Excluir">Deletar</a></li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>