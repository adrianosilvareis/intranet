<article>
    <h1>Contato:</h1>
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
</article>