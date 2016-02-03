
<div style="min-height: 400px;" ng-controller="user">

    <div class="form row" style="margin-bottom: 10px" ng-if="contato">
        <div class="col-md-6"> 
            <div class="col-md-12">
                <input class="form-control" type="text" name="contato_descricao" placeholder="Nome" disabled="true" ng-model="contato.contato_descricao"/>    
            </div>
            <div class="col-md-12">
                <input class="form-control" type="tel" name="contato_telefone" placeholder="Telefone" disabled="true" ng-model="contato.contato_telefone"/>
            </div>
            <div class="col-md-6">
                <a class="form-control" href="mailto:{{contato.contato_email}}" title="enviar uma mensagem" target="_blank">{{contato.contato_email| maxlength:26}}</a>                
            </div>
            <div class="col-md-6">
                <a class="form-control" href="{{contato.contato_site}}" title="{{contato.contato_descricao}}" target="_blank">{{contato.contato_site| maxlength:26}}</a>
            </div>
            <div class="col-md-12" style="margin-top: 5px">
                <textarea class="form-control" name="contato_obs" placeholder="Observações" disabled="true" ng-model="contato.contato_obs" rows="3"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-10">
                <input class="form-control" type="text" name="endereco_lagradouro" placeholder="Lagradouro" disabled="true" ng-model="contato.endereco.endereco_lagradouro"/>
            </div>
            <div class="col-md-2">
                <input class="form-control" type="tel" name="endereco_numero" placeholder="Nº" disabled="true" ng-model="contato.endereco.endereco_numero"/>
            </div>
            <div class="col-md-7">
                <input class="form-control" type="text" name="endereco_bairro" placeholder="Bairro" disabled="true" ng-model="contato.endereco.endereco_bairro"/>
            </div>
            <div class="col-md-5">
                <input class="form-control" type="text" name="endereco_bairro" placeholder="Cep" disabled="true" ng-model="contato.endereco.endereco_cep"/>
            </div>
            <div class="col-md-8">
                <input class="form-control" type="text" name="app_cidade" placeholder="Cidade" disabled="true" ng-model="contato.endereco.cidade.cidade_nome"/>
            </div>
            <div class="col-md-4">
                <input class="form-control" type="text" name="UF" placeholder="UF" disabled="true" ng-model="contato.endereco.cidade.cidade_uf"/>
            </div>
            <div class="col-md-12"></div>
        </div>
        <div class="col-md-12">
            <input class="btn btn-info btn-block" type="submit" value="Voltar" ng-click="limparContato()" />
        </div>
    </div>

    <div class="row col-md-12" ng-if="!contato">
        <div ng-repeat="setor in setores">

            <a data-toggle="collapse" href="#{{setor.setor_id}}" aria-controls="collapseExample" aria-expanded="false" ng-click="setorSelecionado(setor)">
                <div class="btn btn-primary col-md-1" style="padding: 3% 0; margin: 10px 2px;">
                    {{setor.setor_descricao| name}}
                </div>
            </a>

            <div class="collapse col-md-12" id="{{setor.setor_id}}">
                <div class="well">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><a href="" ng-click="ordernarPor('contato_descricao')">Nome</a></th>
                                <th><a href="" ng-click="ordernarPor('contato_telefone')">Telefone</a></th>
                                <th><a href="" ng-click="ordernarPor('contato_email')">Email</a></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr ng-repeat="contato in contatos | filter:{setor_id:setor.setor_id} | orderBy:criterioDeOrdenacao:direcaoDaOrdenacao">
                                <td><a href="" ng-click="contatoSelecionado(contato)">{{contato.contato_descricao| name}}</a></td>
                                <td>{{contato.contato_telefone}}</td>
                                <td>{{contato.contato_email}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div ng-if="setores.length === 0">
        <div ng-if="carregando.length === 4">
            <?php WSErro("Não exite contatos Cadastrados", WS_INFOR); ?>
        </div>
        <div ng-if="carregando.length !== 4">
            <img src="<?= HOME ?>/<?= REQUIRE_PATH ?>/images/ajax-loader.gif" class="img-responsive">
        </div>
    </div>
</div>