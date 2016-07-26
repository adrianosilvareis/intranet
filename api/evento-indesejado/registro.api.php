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

        $request->reg_date_resposta = date('Y-m-d H:i:s');
        $request->reg_date_lastupdate = date('Y-m-d H:i:s');
        $request->user_lastupdate = $user->user_id;
        $request->reg_finalizado = 1;
        unset($request->user_cadastro);
        unset($request->user_recebimento);
        unset($request->area_recebimento);

        $Read->setThis($request);
        $update = $Read->Execute()->update(NULL, "reg_id");

        if ($update):
            $regId = $request->reg_id;
            $Upload = new Upload();
            $regFile = new NcRegFile();
            $regImage = new NcRegImage();

            if (!empty($request->files)):
                foreach ($request->files as $file):
                    if (!empty($file->FILE)):
                        $Title = Check::Name(substr($file->FILE->name, 0, strrpos($file->FILE->name, '.')));
                        $FileName = $Title . strrchr($file->FILE->name, '.');

                        $Upload->File((array) $file->FILE, null, null, 50);

                        $regFile->setFile_name($FileName);
                        $regFile->setFile_url($Upload->getResult());
                        $regFile->setFile_date(date('Y-m-d H:i:s'));
                        $regFile->setReg_id($regId);

                        $regFile->Execute()->insert();
                    endif;
                endforeach;
            endif;

            if (!empty($request->images)):
                foreach ($request->images as $img):
                    if (!empty($img->FILE)):
                        $Title = Check::Name(substr($img->FILE->name, 0, strrpos($img->FILE->name, '.')));
                        $FileName = $Title . strrchr($img->FILE->name, '.');

                        $Upload->Image((array) $img->FILE);
                        unlink($img->FILE->tmp_name);

                        $regImage->setImage_name($FileName);
                        $regImage->setImage_url($Upload->getResult());
                        $regImage->setImage_date(date('Y-m-d H:i:s'));
                        $regImage->setReg_id($regId);

                        $regImage->Execute()->insert();
                    endif;
                endforeach;
            endif;
        endif;

        echo "Registro editado com sucesso!";
    else:
        //adicionar
        $request->user_cadastro = $user->user_id;
        $request->user_lastupdate = $user->user_id;
        $request->reg_date_cadastro = date('Y-m-d H:i:s');
        $request->reg_date_correcao = Check::Data($request->reg_date_correcao);
        $request->reg_date_lastupdate = date('Y-m-d H:i:s');
        
        $Read->setThis($request);
        $insert = $Read->Execute()->insert();

        if ($insert):
            $regId = $Read->Execute()->MaxFild('reg_id');
            $Upload = new Upload();
            $regFile = new NcRegFile();
            $regImage = new NcRegImage();

            if (!empty($request->origens)):

                $many = new RegistroHasOrigem();
                foreach ($request->origens as $origem):
                    //satisfaz a relação many to many do banco de dados
                    $many->setReg_id($regId);
                    $many->setOrigem_id($origem->origem_id);
                    $many->Execute()->insert();
                endforeach;
            endif;

            if (!empty($request->files)):
                foreach ($request->files as $file):
                    $Title = Check::Name(substr($file->FILE->name, 0, strrpos($file->FILE->name, '.')));
                    $FileName = $Title . strrchr($file->FILE->name, '.');

                    $Upload->File((array) $file->FILE, null, null, 50);

                    $regFile->setFile_name($FileName);
                    $regFile->setFile_url($Upload->getResult());
                    $regFile->setFile_date(date('Y-m-d H:i:s'));
                    $regFile->setReg_id($regId);

                    $regFile->Execute()->insert();
                endforeach;
            endif;

            if (!empty($request->images)):
                foreach ($request->images as $img):
                    $Title = Check::Name(substr($img->FILE->name, 0, strrpos($img->FILE->name, '.')));
                    $FileName = $Title . strrchr($img->FILE->name, '.');

                    $Upload->Image((array) $img->FILE);
                    unlink($img->FILE->tmp_name);

                    $regImage->setImage_name($FileName);
                    $regImage->setImage_url($Upload->getResult());
                    $regImage->setImage_date(date('Y-m-d H:i:s'));
                    $regImage->setReg_id($regId);

                    $regImage->Execute()->insert();
                endforeach;
            endif;
        endif;

        echo "Registro adicionado com sucesso!";
    endif;
else:
    $Read->Execute()->FullRead("SELECT * FROM nc_registro");
    echo json_encode($Read->Execute()->getResult());
endif;
