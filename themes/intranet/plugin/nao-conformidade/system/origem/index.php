<p ng-if="message" class="trigger accept">{{message}}<span class="ajax_close"></span></p> 

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Staus</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="origem in origens">
            <td><a href="#ori_create" ng-click="origemId(origem)" data-toggle="tab">{{origem.origem_title| name}}</a></td>
            <td>
                <ul class="post_actions" style="width: 100px; margin: 0;">
                    <li ng-if="origem.origem_status == '0'"><a class="act_ative" href="" ng-click="alterStatus(origem)" title="Ativar">Ativar</a></li>
                    <li ng-if="origem.origem_status == '1'"><a class="act_inative" href="" ng-click="alterStatus(origem)" title="Inativar">Inativar</a></li>
                    <li><a class="act_delete" href="" ng-click="apagarOrigem(origem)" title="Excluir">Deletar</a></li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>