<?php

include_once '../../_app/Config.inc.php';
$Read = new NcRegistro();

$request = json_decode(file_get_contents("php://input"));
$Session = new Session;

$user = (object) $_SESSION['userlogin'];

if (!empty($request)):

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $Read->setSetor_id($data->reg_id);
            $Read->Execute()->delete();
        endforeach;
        echo "Registro excluido com sucesso!";

    elseif (!empty($request->edited)):
        //editar
        $Read->setThis($request);
        $Read->Execute()->update(NULL, "reg_id");
        echo "Registro editado com sucesso!";
    else:
        //adicionar
        $request->user_cadastro = $user->user_id;
        $request->user_lastupdate = $user->user_id;
        $request->reg_date_cadastro = date('Y-m-d H:i:s');
        $request->reg_date_lastupdate = date('Y-m-d H:i:s');
        if (!empty($request->reg_date_correcao)):
            $request->reg_date_correcao = date('Y-m-d H:i:s', strtotime($request->reg_date_correcao));
        endif;
        $Read->setThis($request);
        $Read->Execute()->insert();

        echo "Registro adicionado com sucesso!";
    endif;
else:
    $Read->Execute()->findAll();
    echo json_encode($Read->Execute()->getResult());
endif;
