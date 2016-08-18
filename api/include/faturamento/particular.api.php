<?php

if (!strpos($file['name'], '.csv')):
    Error(501);
else:
    $Upload = new Upload();
    $Upload->File($file);

    $filename = DOCUMENT_ROOT . NAME . "/uploads/" . $Upload->getResult();
    
    if (file_exists($filename)):
        ConvertToObject($filename);
    endif;
endif;

/*
 ******************************
 ********* PRIVATE ************ 
 ******************************
 */

function ConvertToObject($filename) {
    
    $FileRead = fopen($filename, "r");
    $Read = new Controle('sft_particular');
    $Read->truncate();

    $Erros = [];
    while (!feof($FileRead)):
        $file = fgets($FileRead);

        $Linha = (!empty($file) ? explode(";", utf8_encode($file)) : null);

        if (is_array($Linha) && count($Linha) == 12):
            $Erro = null;
            $Objeto = Array();

            $Objeto['part_os'] = $Linha[0];
            $Objeto['part_date'] = Check::Data($Linha[1]);
            $Objeto['part_nm_paciente'] = $Linha[4];
            $Objeto['part_vl_liquido'] = (int) $Linha[9];
            $Objeto['part_vl_pago'] = (int) $Linha[10];
            $Objeto['part_vl_debito'] = (int) $Linha[11];

            $findUser = explode(" - ", $Linha[2])[0];
            $atendente = FindUser($findUser);

            $findCode = explode('-', $Linha[0])[0];
            $unidade = FindCod($findCode);

            if (!$atendente):
                $Erro = true;
                $Objeto['error'] = 'Não encontrado USER' . $findUser;
                $Erros[] = $Objeto;
            else:
                $Objeto['aten_id'] = $atendente;
            endif;

            if (!$unidade):
                $Erro = true;
                $Objeto['error'] = 'Não encontradoa Unidade: ' . $findCode;
                $Erros[] = $Objeto;
            else:
                $Objeto['unid_id'] = $unidade;
            endif;

            if (!$Erro):
                ExeCreate($Objeto);
            endif;
        endif;
    endwhile;
    getErros($Erros);
}

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

function ExeCreate($Objeto) {
    $SftParticular = new SftParticular();
    $SftParticular->setThis((object) $Objeto);
    $SftParticular->Execute()->insert();
}

function getErros($Erros) {
    echo json_encode((object) $Erros);
}
