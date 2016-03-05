
<div >
    <div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Categoria</th>
                    <th>Data Criação</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="setor in setores">
                    <td><a href="#set_create" ng-click="setorId(setor)" data-toggle="tab">{{setor.setor_content| name}}</a></td>
                    <td>{{setor.setor_email}}</td>
                    <td>{{setor.setor_category| name}}</td>
                    <td>{{setor.setor_date| timestampBr}}</td>
                    <td>
                        <ul class="info post_actions">
                            <li ng-if="setor.setor_status"><a class="act_ative" href="#" ng-click="alterStatus(setor)" title="Ativar">Ativar</a></li>
                            <li ng-if="setor.setor_status"><a class="act_inative" href="#" ng-click="alterStatus(setor)" title="Inativar">Inativar</a></li>
                            <li><a class="act_delete" href="painel.php?exe=posts/index&post=<?= $post_id; ?>&action=delete" title="Excluir">Deletar</a></li>
                        </ul>
                    </td>
                    
                    <td>{{setor.setor_status}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>