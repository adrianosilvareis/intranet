<section>
    <h1>Lista de Contatos</h1>
    <div ng-repeat="setor in setores">
        <a data-toggle="collapse" href="#{{setor.setor_id}}" ng-click="setorSelecionado(setor)">
            <div class="btn btn-primary col-md-1" style="padding: 3% 0; margin: 10px 2px;">
                {{setor.setor_content| name}}
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
                        <tr ng-repeat="contato in contatos| filter:{setor_id:setor.setor_id} | orderBy:criterioDeOrdenacao:direcaoDaOrdenacao">
                            <td><a href="" ng-click="contatoSelecionado(contato)">{{contato.contato_descricao| name}}</a></td>
                            <td>{{contato.contato_telefone}}</td>
                            <td>{{contato.contato_email}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>