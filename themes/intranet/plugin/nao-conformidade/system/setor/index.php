<p ng-if="message" class="trigger accept">{{message}}<span class="ajax_close"></span></p> 

<table class="table table-striped table-hover" ng-if="setores">
    <thead>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Categoria</th>
            <th>Data Criação</th>
            <th>Staus</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="setor in setores">
            <td><a href="#set_create" ng-click="setorId(setor)" data-toggle="tab">{{setor.setor_content| name}}</a></td>
            <td>{{setor.setor_email}}</td>
            <td>{{setor.setor_category| name}}</td>
            <td>{{setor.setor_date| timestampBr}}</td>
            <td>
                <ul class="info post_actions" style="width: 100px;">
                    <li ng-if="setor.setor_status === '0'"><a class="act_ative" href="" ng-click="alterStatus(setor)" title="Ativar">Ativar</a></li>
                    <li ng-if="setor.setor_status === '1'"><a class="act_inative" href="" ng-click="alterStatus(setor)" title="Inativar">Inativar</a></li>
                    <li><a class="act_delete" href="" ng-click="apagarSetor(setor)" title="Excluir">Deletar</a></li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>