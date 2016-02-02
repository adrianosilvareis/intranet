<!--setor-->
<div class="panel panel-default" ng-controller="agendaSetor">

    {{message}}
    <div class="row">
        
        <form class="form form-horizontal col-md-4 ">
            <input class="form-control" type="text" placeholder="Descrição" name="descricao" ng-model="setor.setor_descricao"/>
            <div class="btn-group" style="margin-top: 15px; margin-left: 50%">
                <input class="btn btn-primary btn-block" type="submit" ng-click="salvarSetor(setor)" ng-disabled="!setor.setor_descricao" ng-if="!setor.edited" value="Adicionar Setor"/>
                <input class="btn btn-success btn-block" type="submit" ng-click="salvarSetor(setor)" ng-disabled="!setor.setor_descricao" ng-if="setor.edited" value="Salvar Edição"/>
                <input class="btn btn-danger btn-block" type="submit" ng-click="apagarSetores(setores)" ng-disabled="!isSetorSelecionado(setores)" value="Apagar Setor"/> 
            </div>
        </form>

        <div class="col-md-8">
            <input class="form-control" type="text" name="criterioDeBusca" ng-model="criterioDeBusca" placeholder="Criterio de Busca"/> 

            <table class="table" ng-if="setores.length > 0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><a href="" ng-click="ordernarPor('setor.setor_descricao')">Nome Setor</a></th>
                    </tr>
                </thead>

                <tbody>
                    <tr ng-class="{warning: setor.selecionado}" ng-repeat="setor in setores| filter:criterioDeBusca | orderBy:criterioDeOrdenacao:direcaoDaOrdenacao">
                        <td><input class="form-control" type="checkbox" ng-model="setor.selecionado"></td>
                        <td><a href="" ng-click="isSetorEdited(setor)">{{setor.setor_descricao}}</a></td>
                    </tr>
                </tbody>
            </table>

            <div ng-if="setores.length <= 0">
                <?php WSErro("Olá, não temos nenhum setor cadastrado. sejá você o primeiro a cadastrar!", WS_INFOR); ?>
            </div>
        </div>
    </div>
</div>