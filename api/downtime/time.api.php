<?php
include "../../_app/Config.inc.php";
$Read = new DtDowntime();

$request = json_decode(file_get_contents("php://input"));

if (!empty($request)):

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $Read->setEquip_id($data->time_id);
            $Read->Execute()->delete();
        endforeach;
        echo "excluido com sucesso!";

    elseif (!empty($request->stoped)):
        //editar
        $newrequest = $request->stoped;
        $newrequest->down_author = $request->author;
        $newrequest->time_start = date("Y-m-d H:i:s");
        $newrequest->time_lastupdate = date("Y-m-d H:i:s");
        $newrequest->equip_lastupdate = date("Y-m-d H:i:s");
        $newrequest->equip_id = $request->equip_id;
        
        $Read->setThis($newrequest);
        $Read->Execute()->update(NULL, "time_id");
        echo "Editado com sucesso!";
    else:
        //adicionar
        $request->equip_author = $request->author;
        $request->time_stop = date("Y-m-d H:i:s");
        $request->time_lastupdate = date("Y-m-d H:i:s");

        $Read->setThis($request);
        $Read->Execute()->insert();
        echo "Adicionado com sucesso!";
    endif;
else:
    $Read->Execute()->findAll();
    echo json_encode($Read->Execute()->getResult());
endif;
