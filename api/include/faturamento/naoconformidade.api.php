<?php

$Read = new SftNaoConformidade();

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setConv_id($id);
            $Read->Execute()->find();
            Check::JsonReturn($Read->Execute()->getResult(), 'Convênio não encontrado!', '404');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma convênio cadastrada!', '204');
        endif;
        break;
    case "POST":
        if (!empty($request->conv_id)):
            //update
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'conv_id');
            echo json_encode($request);
        else:
            //salvar
            $Read->setThis($request);
            $insert = $Read->Execute()->insert();
            if ($insert):
                $request->conv_id = (int) $Read->Execute()->MaxFild("conv_id");
            endif;
            echo json_encode($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $Read->setConv_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}
