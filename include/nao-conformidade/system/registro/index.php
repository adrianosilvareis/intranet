<article ng-controller="registroList">
    
    <header>
        <h1>Registros:<small>Lista</small></h1>
    </header>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <td>Titulo</td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="reg in registros">
                <td>{{reg.reg_id}}</td>
                <td>{{reg.user_cadastro}}</td>
                <td>{{reg.reg_date_cadastro}}</td>
                <td>{{reg.user_recebimento}}</td>
                <td>{{reg.setor_recebimento}}</td>
            </tr>
        </tbody>
    </table>
</article>