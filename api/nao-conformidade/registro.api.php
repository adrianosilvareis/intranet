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
//        $insert = $Read->Execute()->insert();

        if (true):
            $regId = $Read->Execute()->MaxFild('reg_id');
            $Upload = new Upload();

            if (!empty($request->origens)):

                $many = new RegistroHasOrigem();
                foreach ($request->origens as $origem):
                    //satisfaz a relação many to many do banco de dados
                    $many->setReg_id($regId);
                    $many->setOrigem_id($origem->origem_id);
//                    $many->Execute()->insert();
                endforeach;

            endif;

            if (!empty($request->files)):

                $regFile = new NcRegFile();
                foreach ($request->files as $file):
                    $Title = Check::Name(substr($file->NAME, 0, strrpos($file->NAME, '.')));
                    $FileName = $Title . strrchr($file->NAME, '.');

                    $regFile->setFile_name($FileName);
                    $regFile->setFile_url($file->URL);
                    $regFile->setFile_date(date('Y-m-d H:i:s'));
                    $regFile->setReg_id($regId);

                    $insert = $regFile->Execute()->insert();

                    if ($insert):
                        echo $Upload->File((array) $file->FILE);
                    endif;
                endforeach;
            endif;

            if (!empty($request->images)):
            endif;
        endif;


//        echo "Registro adicionado com sucesso!";
    endif;
else:
    $Read->Execute()->findAll();
    echo json_encode($Read->Execute()->getResult());
endif;
