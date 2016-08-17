<?php

$Upload = new Upload();
$Upload->File($file);

$filename = DOCUMENT_ROOT . NAME . "/uploads/" . $Upload->getResult();

function FindCod($Cod) {
    $Read = new ImpPostos();

    $Read->setPostos_numero($Cod);
    $Result = $Read->Execute()->Query("#postos_numero#");
    if (!empty($Result)):
        return $Result[0]->postos_id;
    endif;
}

function FindUser($User) {
    $Read = new WsUsers();
    
    $Read->setUser_nickname("%{$User}%");
    $Result = $Read->Execute()->Query("user_nickname like '%$User%'");
    
    if (!empty($Result)):
        return $Result[0]->user_id;
    endif;
}

function Error($error, $message = null) {

    if ($error === 501) {
        $message = [
            'message' => 'Ops, o arquivo informado deve esta no formato [.csv]',
            'status' => '501'
        ];
        http_response_code(501);
    }

    echo json_encode($message);
}

function ExeCreate($Linha) {
    $SftParticular = new SftParticular();
    $Linha['part_date'] = Check::Data($Linha['part_date']);
    $SftParticular->setThis((object) $Linha);
    $SftParticular->Execute()->insert();
}

function getErros($Erros) {
    echo json_encode((object) $Erros);
}

if (file_exists($filename)):

    if (!strpos($filename, '.csv')):
        Error(501);
    else:
        $FileRead = fopen($filename, "r");

        $Erros = [];
        while (!feof($FileRead)):
            $file = fgets($FileRead);

            $Linha = (!empty($file) ? explode(";", utf8_encode($file)) : null);

            if (is_array($Linha) && count($Linha) == 12):
                $Erro = null;

                $findUser = explode(" - ", $Linha[2])[0];
                $atendente = FindUser($findUser);

                $findCode = explode('-', $Linha[0])[0];
                $unidade = FindCod($findCode);

                if (!$atendente):
                    $Erro = true;
                    $Erros[] = $findUser . ' - Atendente não encontrado';
                endif;

                if (!$unidade):
                    $Erro = true;
                    $Erros[] = $findCode . ' - Unidade não encontrado';
                endif;

                $Linha['part_os'] = $Linha[0];
                $Linha['part_date'] = $Linha[1];
                $Linha['aten_id'] = $atendente;
                $Linha['unid_id'] = $unidade;
                $Linha['part_nm_paciente'] = $Linha[4];
                $Linha['part_vl_total'] = (int) $Linha[6];
                $Linha['part_vl_desc'] = (int) $Linha[7];
                $Linha['part_vl_liquido'] = (int) $Linha[9];
                $Linha['part_vl_pago'] = (int) $Linha[10];
                $Linha['part_vl_debito'] = (int) $Linha[11];
                
                if (!$Erro):
                    ExeCreate($Linha);
                endif;
            endif;
        endwhile;
        getErros($Erros);
    endif;    
endif;
