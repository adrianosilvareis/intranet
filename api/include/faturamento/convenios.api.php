<?php

$Read = new SftConvenio();

function setData($request) {

    if (!empty($request->post)) {
        $request->post_id = $request->post->post_id;
        unset($request->post);
    };

    $request = (object) array_map("trim", (array) $request);
    $request = (object) array_map("strip_tags", (array) $request);

    if (empty($request->conv_id)) {
        $request->conv_name = Check::Name($request->conv_title);
        $request->conv_date = date("Y-m-d");
        $request->conv_status = 1;
    }

    return $request;
}

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setConv_id($id);
            $Read->Execute()->find();
            if ($Read->Execute()->getResult()) :
                echo json_encode($Read->Execute()->getResult());
            else :
                http_response_code(404);
            endif;
        elseif (!empty($query) && $query == 'ativos'):
            $Read->Execute()->Query("conv_status=1");
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma convênio cadastrada!', '204');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma convênio cadastrada!', '204');
        endif;
        break;
    case "POST":
        if (!empty($request->conv_id)):
            //update
            $request = setData($request);

            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'conv_id');
            echo json_encode($request);
        else:
            //salvar            
            $request = setData($request);

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
