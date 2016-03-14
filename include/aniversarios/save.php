<?php

if (!Check::UserLogin(2)):
    header("Location: " . HOME . "/plugin/aniversarios/");
endif;

$File = filter_input(INPUT_GET, "file", FILTER_DEFAULT);
$Erros = array();

include ("/system/_models/AdminAppNiver.class.php");

$Admin = new AdminAppNiver();

$filename = DOCUMENT_ROOT . NAME . "/uploads/" . $File;
if (isset($File) && file_exists($filename)):

    $FileRead = fopen($filename, "r");

    $i = 0;
    $size = count(file($filename));

    $Admin->ExeTruncate();

    while (!feof($FileRead)):
        $Dado = fgets($FileRead);

        if (!empty($Dado)):
            $Dado = explode(";", utf8_encode($Dado));
            $Linha['niver_nome'] = $Dado[0];
            $Linha['niver_setor'] = $Dado[1];
            $Linha['niver_data'] = $Dado[2];
            $Linha['niver_ordem'] = $Dado[3];
            $Admin->ExeCreate($Linha);
        endif;
    endwhile;

    if (!empty($Erros)):
        WSErro("Atenção ao seguintes erros:", WS_INFOR);
        foreach ($Erros as $erro) :
            echo $erro . "<br>";
        endforeach;
    else:
        header("Location: " . HOME . "/plugin/aniversarios&error=save");
    endif;
else:
    header("Location: " . HOME . "/plugin/aniversarios&error=arquivo");
endif;