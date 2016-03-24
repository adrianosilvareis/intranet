<?php

include '../../_app/Config.inc.php';

$Read = new Controle();

//Grafico de colunas Numero de paradas por equipamento
$Read->FullRead("SELECT e.equip_title as 'title', count(t.equip_id) as 'cont' FROM dt_downtime t 
                JOIN dt_equipamentos e ON(e.equip_id = t.equip_id)
                GROUP BY e.equip_id;");

$dataarray[] = ['Equipamento', 'Numero de paradas'];
foreach ($Read->getResult() as $value):
    $dataarray[] = [$value->title, (int) $value->cont];
endforeach;

echo json_encode($dataarray);
