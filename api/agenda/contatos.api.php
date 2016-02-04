<?php

include "../../_app/Config.inc.php";
$AgendaContatos = new AgendaContatos();

$request = json_decode(file_get_contents("php://input"));

if (!empty($request)):

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $AgendaContatos->setContato_id($data->contato_id);
            $AgendaContatos->Execute()->delete();
        endforeach;
        echo "excluido com sucesso!";

    elseif (!empty($request->edited)):
        //editar
        $AgendaContatos->setThis($request);
        $AgendaContatos->Execute()->update(NULL, "contato_id");
        echo "Editado com sucesso!";
    else:
        //adicionar
        $AgendaContatos->setThis($request);
        $AgendaContatos->Execute()->insert();
//        echo "Adicionado com sucesso!";
        echo json_encode("Adicionado com sucesso!");
    endif;
    
else:
    $AgendaContatos->Execute()->findAll();
    echo json_encode($AgendaContatos->Execute()->getResult());
endif;