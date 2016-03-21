<?php

require_once ('../../_app/Config.inc.php');

$estado = filter_input(INPUT_POST, 'estado', FILTER_VALIDATE_INT);
$readCityes = new Controle('app_cidades');
$readCityes->Query("estado_id = :uf", "uf={$estado}");

sleep(1);

echo "<option value=\"\" disabled selected> Selecione a cidade </option>";
foreach ($readCityes->getResult() as $cidades):
    extract((array)$cidades);
    echo "<option value=\"{$cidade_id}\" ";
    /*
    if($cidade_id == $_SESSION['city']):
        echo ' selected="seleted" ';
    endif;
    */
    echo "> {$cidade_nome} </option>";
endforeach;
