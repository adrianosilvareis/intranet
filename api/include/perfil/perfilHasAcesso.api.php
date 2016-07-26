<?php

$Read = new Controle('ws_perfil_has_ws_acesso');

switch ($method) {
    case "GET":
        //retorna todos os itens
        if ($id):

            $sql = "SELECT * FROM ws_perfil_has_ws_acesso pa "
                    . "JOIN ws_perfil p ON(p.perfil_id = pa.perfil_id) "
                    . "JOIN ws_acesso a ON(a.acesso_id = pa.acesso_id) "
                    . "WHERE pa.perfil_id = :perfil_id";

            $Read->FullRead($sql, "perfil_id={$id}", true);
            Check::JsonReturn($Read->getResult(), 'Perfil sem acessos cadastrados', 204);
        else:
            $Read->findAll();
            Check::JsonReturn($Read->getResult(), 'Nenhum perfil cadastrado!', 204);
        endif;
        break;

    case "POST":
        if ($request->id):
            $message = [
                'message' => 'Salvo com sucesso!',
                'status' => 200
            ];
            
            //deleta todos os dados deste pefil
            $Read->delete("perfil_id={$request->id}");
            
            foreach ($request->list as $value) :
                $Read->insert("perfil_id=$request->id&acesso_id=$value->acesso_id");
            endforeach;
            
            echo json_encode($message);
        endif;
        break;

    case "DELETE":
        //deleta arquivo
        break;

    default:
        break;
}