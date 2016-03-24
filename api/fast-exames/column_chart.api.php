<?php

include '../../_app/Config.inc.php';

$Read = new Controle();

//Grafico de colunas Numero de paradas por equipamento
$Read->FullRead("SELECT count(e.ws_users) as 'cont' , u.* FROM fe_exames e "
        . "JOIN ws_users u ON(u.user_id = e.ws_users) "
        . "GROUP BY e.ws_users;");

$dataarray[] = ['Usuario', 'Total Exames'];
foreach ($Read->getResult() as $value):
    $dataarray[] = [$value->user_name, (int) $value->cont];
endforeach;

echo json_encode($dataarray);