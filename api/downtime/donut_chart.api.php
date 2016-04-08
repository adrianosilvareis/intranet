<?php

include '../../_app/Config.inc.php';

$Read = new Controle();

//Grafico de Donuts
$Read->FullRead("SELECT e.equip_title, e.equip_date, t.time_stop, t.time_start
                from dt_downtime t JOIN dt_equipamentos e ON(e.equip_id = t.equip_id)
                WHERE e.equip_status AND t.time_start ORDER BY e.equip_id;");

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

$dataarray[] = ['Equipamento', 'Tempo total parado'];
foreach ($arrayEquip as $key => $value):
    $dataarray[] = [$key, (int) $value];
endforeach;

echo json_encode($dataarray);