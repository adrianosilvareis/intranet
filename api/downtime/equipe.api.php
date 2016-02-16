<?php

include "../../_app/Config.inc.php";
$Read = new DtEquipamentos();

$request = json_decode(file_get_contents("php://input"));

if (!empty($request)):

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $Read->setEquip_id($data->equip_id);
            $Read->Execute()->delete();
        endforeach;
        echo "excluido com sucesso!";

    elseif (!empty($request->equip_id)):
        //editar
        $Read->setThis($request);
        $Read->Execute()->update(NULL, "equip_id");
        echo "Editado com sucesso!";
    else:
        //adicionar
        $Read->setThis($request);
        $Read->Execute()->insert();
        echo "Adicionado com sucesso!";
    endif;
else:
    $Read->Execute()->findAll();
    echo json_encode($Read->Execute()->getResult());
endif;
