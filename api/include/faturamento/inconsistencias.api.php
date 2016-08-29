<?php

$Read = new SftInconsistenciaGuia();

function setDados($request, $userlogin = null) {

    unset($request->aten);
    unset($request->unid);
    unset($request->conv);

    $userlogin = (!empty($userlogin) ? (object) $userlogin : null);
    $request = (object) array_map("trim", (array) $request);
    $request = (object) array_map("strip_tags", (array) $request);

    if (empty($request->inco_id)) {
        $request->faturista_id = $userlogin->user_id;
        $request->inco_date = date('Y-m-d');
    }

    return $request;
}

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setInco_id($id);
            $Read->Execute()->find();
            Check::JsonReturn($Read->Execute()->getResult(), 'Inconsistência de Guia não encontrada!', '404');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma Inconsistência cadastrada!', '204');
        endif;
        break;
    case "POST":
        if (!empty($request) && is_array($request)):

            $unidade = [
                'postos_id' => '0',
                'postos_nome' => 'Desativado',
                'postos_numero' => '0',
                'postos_ativo' => '0'
            ];

            $usuario = [
                'user_id' => '0',
                'user_nickname' => 'DESATIVADO',
                'user_name' => '-',
                'user_lastname' => '-',
                'user_email' => '-'
            ];

            $inconsistencia = [
                'ncon_id' => '1',
                'ncon_title' => '-',
                'ncon_content' => '-',
                'ncon_date' => '16/08/2016',
                'ncon_status' => '0'
            ];

            $convenio = [
                'conv_id' => '',
                'conv_title' => '-',
                'conv_name' => '-',
                'conv_describe' => '-',
                'conv_date' => '-',
                'conv_code' => '-',
                'conv_status' => '0',
                'post_id' => '',
            ];

            foreach ($request as $inco):

                unset($inco->aten->user_password);
                unset($inco->aten->user_level);
                unset($inco->aten->user_registration);
                unset($inco->aten->user_lastupdate);
                unset($inco->aten->perfil_id);
                unset($inco->aten->area_id);
                unset($inco->aten->user_cover);
                unset($inco->aten->user_birthday);
                unset($inco->aten->user_status);

                unset($inco->fatur->user_password);
                unset($inco->fatur->user_level);
                unset($inco->fatur->user_registration);
                unset($inco->fatur->user_lastupdate);
                unset($inco->fatur->perfil_id);
                unset($inco->fatur->area_id);
                unset($inco->fatur->user_cover);
                unset($inco->fatur->user_birthday);
                unset($inco->fatur->user_status);

                if (isset($inco->fatur)):
                    $inco->faturista = new stdClass();
                    $inco->faturista->fatur_id = $inco->fatur->user_id;
                    $inco->faturista->fatur_nickname = $inco->fatur->user_nickname;
                    $inco->faturista->fatur_name = $inco->fatur->user_name;
                    $inco->faturista->fatur_lastname = $inco->fatur->user_lastname;
                    $inco->faturista->fatur_email = $inco->fatur->user_email;
                endif;

                $aten = (isset($inco->aten) ? $inco->aten : $usuario);
                $unid = (isset($inco->unid) ? $inco->unid : $unidade);
                $ncon = (isset($inco->ncon) ? $inco->ncon : $inconsistencia);
                $conv = (isset($inco->conv) ? $inco->conv : $convenio);
                $fatur = (isset($inco->faturista) ? $inco->faturista : $usuario);

                unset($inco->aten);
                unset($inco->unid);
                unset($inco->ncon);
                unset($inco->conv);
                unset($inco->fatur);
                unset($inco->faturista);

                $result[] = array_merge((array) $inco, (array) $aten, (array) $unid, (array) $ncon, (array) $conv, (array) $fatur);

            endforeach;
            
            Check::ToCsv("relatorio_de_inconsistencias", $result);
            http_response_code(200);
            
        elseif (!empty($request->inco_id)):
            //update
            $request = setDados($request);
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'inco_id');
            echo json_encode($request);
        else:
            //salvar
            $request = setDados($request, $userlogin);
            $Read->setThis($request);
            $insert = $Read->Execute()->insert();
            if ($insert):
                $request->inco_id = (int) $Read->Execute()->MaxFild("inco_id");
            endif;
            echo json_encode($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $Read->setInco_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}
