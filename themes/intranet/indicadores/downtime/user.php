<section class="section" ng-app="downtime">
    <h1><span style="font-size: 0.8em;color: #787878">Indicadores</span></h1>
    
    <div ng-controller="user">

        <form class="well form-inline" method="post">
            <input class="form-control" type="text" name="time_stop" placeholder="incio" />
            <input class="form-control" type="text" name="time_start" placeholder="fim" />
            <select class="form-control">
                <option value="">Selecione um equipamento</option>
            </select>
            <input class="form-control" type="text" placeholder="responsavel do registro">
            <input class="btn btn-success" type="submit" name="registro" value="GRAVAR">
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Inicio</th>
                    <th>Fim</th>
                    <th>Equipamento</th>
                    <th>Reponsável</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>incio</td>
                    <td>fim</td>
                    <td>equipamento</td>
                    <td>responsavel</td>
                </tr>
            </tbody>
        </table>
    </div>
    
</section>