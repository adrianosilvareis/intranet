<div ng-app="naoConformidade">
    <div ng-controller="setor">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="setor in setores">
                    <td>{{setor.setor_content| name}}</td>
                    <td>{{setor.setor_email}}</td>
                    <td>{{setor.setor_category| name}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>