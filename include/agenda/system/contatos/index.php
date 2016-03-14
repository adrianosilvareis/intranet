<!--contato-->
<div class="panel panel-default">

    {{message}}
    <hr>
    <div class="row">
        
        <?php include HOME . '/include/agenda/system/contatos/inc/novoContato.php'; ?>
        
        <label>Lista de Contatos dos sistema:</label>
        
        <div class="col-md-8">

            <div class="row">
                <div class="col-md-6">
                    <input class="form-control" type="text" name="criterioDeBusca" ng-model="criterioDeBusca" placeholder="Criterio de Busca"/> 
                </div>
                <div class="col-md-6">
                    <select class="form-control col-md-6" ng-model="setor" ng-options="setor.setor_id as setor.setor_content for setor in setores">
                        <option value="">Selecione um setor para continuar</option>
                    </select>
                </div>
            </div>

            <table class="table" ng-if="contatos.length > 0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><a href="" ng-click="ordernarPor('contato_descricao')">Nome</a></th>
                        <th><a href="" ng-click="ordernarPor('contato_telefone')">Telefone</a></th>
                        <th><a href="" ng-click="ordernarPor('contato_email')">Email</a></th>
                    </tr>
                </thead>

                <tbody>
                    <tr ng-repeat="contato in contatos | filter:{setor_id: setor}:true | filter:criterioDeBusca | orderBy:criterioDeOrdenacao:direcaoDaOrdenacao">
                        <td><input class="form-control" type="checkbox" ng-model="contato.selecionado" ></td>
                        <td><a href="" ng-click="isContatoEdited(contato)">{{contato.contato_descricao| name}}</a></td>
                        <td>{{contato.contato_telefone}}</td>
                        <td>{{contato.contato_email}}</td>
                    </tr>
                </tbody>
            </table>

            <div class="row" ng-if="contatos.length <= 0">
                <?php WSErro("Nenhum contato para este setor foi encontrado!", WS_INFOR); ?>
            </div>
        </div>

    </div>
</div>