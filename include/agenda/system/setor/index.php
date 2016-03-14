<!--setor-->
<div class="panel panel-default" ng-controller="agendaSetor">

    {{message}}
    <div class="row">

        <form class="form form-horizontal col-md-4 ">
            <input class="form-control" type="text" placeholder="Descrição" name="setor_content" ng-model="setor.setor_content"/>
            <select class="form-control" name="setor_type" ng-model="setor.setor_type" ng-options="type.type_id as type.type_content for type in types">
                <option value="">Selecione um tipo</option>
            </select>
            <div class="btn-group" style="margin-top: 15px; margin-left: 50%">
                <input class="btn btn-primary btn-block" type="submit" ng-click="salvarSetor(setor)" ng-disabled="!setor.setor_content" ng-if="!setor.edited" value="Adicionar Setor"/>
                <input class="btn btn-success btn-block" type="submit" ng-click="salvarSetor(setor)" ng-disabled="!setor.setor_content" ng-if="setor.edited" value="Salvar Edição"/>
                <input class="btn btn-danger btn-block" type="submit" ng-click="apagarSetores(setores)" ng-disabled="!isSetorSelecionado(setores)" value="Apagar Setor"/> 
            </div>
        </form>

        <div class="col-md-8">
            <input class="form-control" type="text" name="criterioDeBusca" ng-model="criterioDeBusca" placeholder="Criterio de Busca"/> 

            <table class="table" ng-if="setores.length > 0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><a href="" ng-click="ordernarPor('setor.setor_content')">Nome Setor</a></th>
                    </tr>
                </thead>

                <tbody>
                    <tr ng-class="{warning: setor.selecionado}" ng-repeat="setor in setores| filter:criterioDeBusca | orderBy:criterioDeOrdenacao:direcaoDaOrdenacao">
                        <td><input class="form-control" type="checkbox" ng-model="setor.selecionado"></td>
                        <td><a href="" ng-click="isSetorEdited(setor)">{{setor.setor_content}}</a></td>
                    </tr>
                </tbody>
            </table>

            <div ng-if="setores.length <= 0">
                <?php WSErro("Olá, não temos nenhum setor cadastrado. sejá você o primeiro a cadastrar!", WS_INFOR); ?>
            </div>
        </div>
    </div>
</div>