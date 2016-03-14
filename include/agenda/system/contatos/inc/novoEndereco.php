<div class="col-md-4">

    <label>Endereço:</label>

    <form class="form" name="enderecoForm">

        <div class="row">
            <div class="col-md-10">
                <input class="form-control" type="text" placeholder="Lagradouro" name="endereco_lagradouro" ng-model="contato.endereco.endereco_lagradouro" ng-required="true" ng-minlength="10"/>
            </div>
            <div class="col-md-2">
                <input class="form-control" type="text" placeholder="Nº" name="endereco_numero" ng-model="contato.endereco.endereco_numero"/> 
            </div>
            <div class="col-md-8">
                <input class="form-control" type="text" placeholder="Bairro" name="endereco_bairro" ng-model="contato.endereco.endereco_bairro" ng-required="true" ng-minlength="3"/>
            </div>
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Cep" name="endereco_cep" ng-model="contato.endereco.endereco_cep" ng-required="true" ui-format-cep/>
            </div>

            <div class="col-md-6">
                <select class="form-control" ng-model="contato.endereco.app_estado" ng-options="estado.estado_uf as estado.estado_nome for estado in estados" ng-required="true">
                    <option value="">Selecione um estado</option>
                </select>
            </div>

            <div class="col-md-6" ng-if="contato.endereco.app_estado">
                <select class="form-control" ng-model="contato.endereco.app_cidade" ng-options="cidade.cidade_id as cidade.cidade_nome for cidade in cidades| filter:{cidade_uf: contato.endereco.app_estado}" ng-required="true">
                    <option value="">Selecione um estado</option>
                </select>
            </div>

            <div class="btn-group" style="margin-top: 15px; margin-left: 50%;">
                <input class="btn btn-primary btn-block" type="submit" value="Adicionar Enderço" ng-click="salvarEndereco(contato.endereco)" ng-if="!contato.endereco.edited" ng-disabled="enderecoForm.$invalid"/>
                <input class="btn btn-success btn-block" type="submit" value="Salvar" ng-click="salvarEndereco(contato.endereco)" ng-if="contato.endereco.edited" ng-disabled="enderecoForm.$invalid"/>
                <input class="btn btn-info btn-block" type="submit" value="Vincular a Contato" ng-click="vincularEndereco(contato)" ng-if="contato.endereco.edited"/>
                <input class="btn btn-danger btn-block" type="submit" value="Apagar Enderço" ng-click="apagarEnderecos(enderecos)" ng-disabled="!isEnderecoSelecionado(enderecos)"/>
            </div>
        </div>

    </form>

    <div style="margin-top: 15px;">
        <div ng-messages="enderecoForm.endereco_lagradouro.$error">

            <div ng-message="required" class="alert alert-danger" ng-show="enderecoForm.endereco_lagradouro.$dirty">
                Por Favor, Preencha o campo Lagradouro.
            </div>

            <div ng-message="minlength" class="alert alert-danger">
                O campo Lagradouro deve ter no mínimo 10 caracteres.
            </div>

        </div>

        <div ng-messages="enderecoForm.endereco_bairro.$error">

            <div ng-message="required" class="alert alert-danger" ng-show="enderecoForm.endereco_bairro.$dirty">
                Por Favor, Preencha o campo Bairro.
            </div>

            <div ng-message="minlength" class="alert alert-danger">
                O campo Bairro deve ter no mínimo 3 caracteres.
            </div>

        </div>

        <div ng-messages="enderecoForm.endereco_cep.$error">

            <div ng-message="required" class="alert alert-danger" ng-show="enderecoForm.endereco_cep.$dirty">
                Por Favor, Preencha o campo Cep.
            </div>

        </div>

    </div>

</div>