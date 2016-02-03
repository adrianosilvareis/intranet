<div class="col-md-4">

    <label>Dados Pessoais:</label>

    <form class="form" name="contatoForm">

        <input class="form-control" type="text" name="contato_descricao" placeholder="Nome / Descrição" ng-model="contato.contato_descricao" ng-required="true" ng-minlength="3"/>
        <input class="form-control" type="tel" name="contato_telefone" placeholder="Telefone" ng-model="contato.contato_telefone"  ng-required="true" ui-format-tel/>
        <input class="form-control" type="email" name="contato_email" placeholder="email@site.com.br" ng-model="contato.contato_email"/>
        <input class="form-control" type="url" name="contato_site" placeholder="site.com.br" ng-model="contato.contato_site" ui-format-site/>
        <textarea class="form-control" name="contato_obs" placeholder="informações adicionais" ng-model="contato.contato_obs" rows="3">
        </textarea>
        <select class="form-control" name="setor_id" ng-model="contato.setor_id" ng-options="setor.setor_id as setor.setor_descricao for setor in setores"  ng-required="true">
            <option value="">Selecione um setor para continuar</option>
        </select>
        <div class="btn-group" style="margin-top: 15px; margin-left: 50%;">
            <input class="btn btn-primary btn-block" type="submit" value="Adicionar Contato" ng-click="salvarContato(contato)" ng-if="!contato.edited" ng-disabled="contatoForm.$invalid"/>
            <input class="btn btn-success btn-block" type="submit" value="Salvar" ng-click="salvarContato(contato)" ng-if="contato.edited" ng-disabled="contatoForm.$invalid"/>
            <input class="btn btn-danger btn-block" type="submit" value="Apagar Contato" ng-click="apagarContatos(contatos)" ng-disabled="!isContatoSelecionado(contatos)" />
        </div>

    </form>
    
    <div style="margin-top: 15px;">
        <div ng-messages="contatoForm.contato_descricao.$error">

            <div ng-message="required" class="alert alert-danger" ng-show="contatoForm.contato_descricao.$dirty">
                Por Favor, Preencha o campo Nome.
            </div>

            <div ng-message="minlength" class="alert alert-danger">
                O campo Nome deve ter no mínimo 3 caracteres.
            </div>

        </div>

        <div ng-messages="contatoForm.contato_telefone.$error">

            <div ng-message="required" class="alert alert-danger" ng-show="contatoForm.contato_telefone.$dirty">
                Por Favor, Preencha o campo Telefone.
            </div>

        </div>
    </div>

</div>