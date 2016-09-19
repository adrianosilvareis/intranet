<?php

$Read = new PeEquipamento();

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setEquip_id($id);
            $Read->Execute()->find();
            if ($Read->Execute()->getResult()) :
                echo json_encode($Read->Execute()->getResult());
            else :
                http_response_code(404);
            endif;
        elseif (!empty($query) && $query == 'ativos'):
            $Read->Execute()->Query("equip_status=1");
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhum equipamento cadastrado!', '204');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhum equipamento  cadastrado!', '204');
        endif;
        break;
    case "POST":
        if (!empty($request->equip_id)):
            //update
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'equip_id');
            echo json_encode($request);
        else:
            //salvar            
            $Read->setThis($request);
            $insert = $Read->Execute()->insert();
            if ($insert):
                $request->equip_id = (int) $Read->Execute()->MaxFild("equip_id");
            endif;
            echo json_encode($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $Read->setEquip_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}
