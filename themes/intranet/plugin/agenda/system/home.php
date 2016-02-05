
<div class="panel panel-default" >
    <section class="row">

        <h1 class="text-center " style="font-size: 3em;">Dashboard, <small>Agenda</small></h1>
        <hr>
        <article class="col-md-6">
            <h1 class="text-center text-muted" style="font-size: 2em;">Contatos</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Setor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="contato in contatos">
                        <td>{{contato.contato_descricao| name}}</td>
                        <td>{{contato.contato_telefone}}</td>
                        <td>{{contato.setor.setor_descricao}}</td>
                    </tr>
                    <tr class="active">
                        <td>Total:</td>
                        <td colspan="2">{{contatos.length}}</td>
                    </tr>
                </tbody>
            </table>
        </article>

        <article class="col-md-4">
            <h1 class="text-center text-muted" style="font-size: 2em;">Endereços</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Lagradouro</th>
                        <th>Numero</th>
                        <th>Bairro</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="endereco in enderecos">
                        <td>{{endereco.endereco_lagradouro| name}}</td>
                        <td>{{endereco.endereco_numero}}</td>
                        <td>{{endereco.endereco_bairro| name}}</td>
                    </tr>
                    <tr class="active">
                        <td>Total:</td>
                        <td colspan="2">{{enderecos.length}}</td>
                    </tr>
                </tbody>
            </table>
        </article>

        <article class="col-md-2">
            <h1 class="text-center text-muted" style="font-size: 2em;">Setores</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="setor in setores">
                        <td>{{setor.setor_id}}</td>
                        <td>{{setor.setor_descricao| name}}</td>
                    </tr>
                    <tr class="active">
                        <td>Total: </td>
                        <td>{{setores.length}}</td>
                    </tr>
                </tbody>
            </table>
        </article>
    </section>
</div>