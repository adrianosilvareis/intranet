<?php
$Read = new Controle();
//Lista de Registros
$Read->FullRead("select t.equip_id, t.time_id, t.time_stop, t.time_start, "
        . "t.time_lastupdate, t.equip_author, e.equip_title, e.equip_content, "
        . "e.equip_date, e.equip_status, e.equip_lastupdate "
        . "from dt_downtime t JOIN dt_equipamentos e ON(e.equip_id = t.equip_id)  ORDER BY t.time_start");
?>

<script>
    var titlecolumn = "Parada de equipamento";
    var datacolumn = <?php require HOME . '/api/downtime/column_chart.api.php';?>;  
    var titledonut = "Tempo total parado";
    var datadonut = <?php require HOME . '/api/downtime/donut_chart.api.php';?>;  
</script>

<div class="row">
    <div id="columnchart_values" style="width: 50%; height: 350px; float: left;"></div>
    <div id="donutchart" style="width: 50%; height: 350px; float: left;"></div>
</div>

<h2>Meta: <small>48 Hours.</small></h2>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Equipamento</th>
                <th>Descrição</th>
                <th>Data ativação</th>
                <th>Ultima atualização</th>
                <th>Hora da parada</th>
                <th>Hora da reativação</th>
                <th>Responsável</th>
                <th>Tempo de parada</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Read->getResult() as $key): ?>
                <tr>
                    <td><?= $key->equip_title; ?></td>
                    <td><?= $key->equip_content; ?></td>
                    <td><?= date("d/m/Y H:i", strtotime($key->equip_date)); ?></td>
                    <td><?= date("d/m/Y H:i", strtotime($key->equip_lastupdate)); ?></td>
                    <td><?= date("d/m/Y H:i", strtotime($key->time_stop)); ?></td>
                    <td><?= ($key->time_start != "0000-00-00 00:00:00" ? date("d/m/Y H:i", strtotime($key->time_start)) : ""); ?></td>
                    <td><?= $key->equip_author; ?></td>
                    <td><?= (!empty($key->time_start) ? Check::DataDiff($key->time_stop, $key->time_start, 2) : ""); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>