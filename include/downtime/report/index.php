<?php
$Read = new Controle();

//Grafico de colunas
$Read->FullRead("SELECT e.equip_title as 'title', count(t.equip_id) as 'cont' FROM dt_downtime t 
                JOIN dt_equipamentos e ON(e.equip_id = t.equip_id)
                GROUP BY e.equip_id;");

$datacolumn = "[";
$datacolumn .= "['Equipamento','Numero de paradas'],";
foreach ($Read->getResult() as $value):
    $datacolumn .= "['{$value->title}',{$value->cont}],";
endforeach;
$datacolumn .= "]";

//Grafico de Donuts
$Read->FullRead("SELECT e.equip_title, e.equip_date, t.time_stop, t.time_start
                from dt_downtime t JOIN dt_equipamentos e ON(e.equip_id = t.equip_id)
                WHERE e.equip_status ORDER BY e.equip_id;");

array_map(function($value) {
    $value->diff = Check::DateToInteger($value->time_start) - Check::DateToInteger($value->time_stop);
}, $Read->getResult());

$arrayEquip = [];
foreach ($Read->getResult() as $value):
    if (!array_key_exists($value->equip_title, $arrayEquip)):
        $arrayEquip[$value->equip_title] = $value->diff;
    else:
        $arrayEquip[$value->equip_title] += $value->diff;
    endif;
endforeach;

$datadonut = "[['Equipamento', 'Tempo total parado'],";
foreach ($arrayEquip as $key => $value):
    $datadonut .= "['$key',$value],";
endforeach;
$datadonut .= ']';

//Lista de Registros
$Read->FullRead("select t.equip_id, t.time_id, t.time_stop, t.time_start, "
        . "t.time_lastupdate, t.equip_author, e.equip_title, e.equip_content, "
        . "e.equip_date, e.equip_status, e.equip_lastupdate "
        . "from dt_downtime t JOIN dt_equipamentos e ON(e.equip_id = t.equip_id)");


//Declaração de SCRIPT
Register::addRegister("<script src=\"{$dir}js/google-chart/column.js\"></script>");
Register::addRegister("<script src=\"{$dir}js/google-chart/donut.js\"></script>");
?>

<script type="text/javascript">
    var datadonut = <?= $datadonut; ?>;
    var datacolumn = <?= $datacolumn; ?>;
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
                    <td><?= ($key->time_start != "0000-00-00 00:00:00" ? Check::DataDiff($key->time_stop, $key->time_start, 2) : ""); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>