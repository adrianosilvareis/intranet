<?php

$File = filter_input(INPUT_GET, "file", FILTER_DEFAULT);
$Erros = array();

$DIR = REQUIRE_PATH . DIRECTORY_SEPARATOR . 'plugin' . DIRECTORY_SEPARATOR . 'os-nao-pagas';
include ($DIR . "/system/_models/AdminSftInputAten.class.php");
include ($DIR . "/system/_models/AdminSftInputUnid.class.php");
include ($DIR . "/system/_models/AdminSftOutputPart.class.php");

$Aten = new AdminSftInputAten();
$Unid = new AdminSftInputUnid();
$Part = new AdminSftOutputPart();

$filename = DOCUMENT_ROOT . NAME . "/uploads/" . $File;
if (file_exists($filename)):

    $FileRead = fopen($filename, "r");

    $i = 0;
    $size = count(file($filename));

    $Part->ExeTruncate();

    while (!feof($FileRead)):
        $Dado = fgets($FileRead);

        if (!empty($Dado)):
            $Dado = explode(";", utf8_encode($Dado));

            if (is_array($Dado) && count($Dado) == 12):
                $Erro = null;
                $atendente = $Aten->FindUser("USER" . explode(" - ", $Dado[2])[0]);
                $unidade = $Unid->FindCod(explode('-', $Dado[0])[0]);

                if (empty($atendente)):
                    $Erro = true;
                    $Erros[] = $Aten->getErro();
                endif;

                if (empty($unidade)):
                    $Erro = true;
                    $Erros[] = $Unid->getErro();
                endif;

                $Linha['part_os_ospart'] = $Dado[0];
                $Linha['part_data_regist'] = $Dado[1];
                $Linha['fk_aten'] = $atendente;
                $Linha['fk_unid'] = $unidade;
                $Linha['part_nm_paciente'] = $Dado[4];
                $Linha['part_vl_total'] = (int) $Dado[6];
                $Linha['part_vl_desc'] = (int) $Dado[7];
                $Linha['part_vl_liquido'] = (int) $Dado[9];
                $Linha['part_vl_pago'] = (int) $Dado[10];
                $Linha['part_vl_debito'] = (int) $Dado[11];

                if (!$Erro):
                    $Part->ExeCreate($Linha);
                endif;

            endif;
        endif;
    endwhile;

    if (!empty($Erros)):
        WSErro("Atenção ao seguintes erros:", WS_INFOR);
        foreach ($Erros as $erro) :
            echo $erro . "<br>";
        endforeach;
    else:
        WSErro("Arquivo salvo com sucesso!", WS_ACCEPT);
    endif;
endif;