<?php

$Read = new PeStopLog();

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setLog_id($id);
            $Read->Execute()->find();
            if ($Read->Execute()->getResult()) :
                echo json_encode($Read->Execute()->getResult());
            else :
                http_response_code(404);
            endif;
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhum log registrado!', '204');
        endif;
        break;
    case "POST":
        if (!empty($request->log_id)):
            //update
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'log_id');
            echo json_encode($request);
        else:
            //salvar      
            $request->log_date = date('Y-m-d H:m:i');
            $Read->setThis($request);
            $insert = $Read->Execute()->insert();
            if ($insert):
                $request->log_id = (int) $Read->Execute()->MaxFild("log_id");
            endif;
            echo json_encode($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $Read->setLog_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}
