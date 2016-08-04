<?php

$Read = new NcRegistro();

$user = (object) $_SESSION['userlogin'];

function addOrigens($origens, $regId) {
    if (!empty($origens)):

        $many = new RegistroHasOrigem();
        foreach ($origens as $origem):
            //satisfaz a relação many to many do banco de dados
            $many->setReg_id($regId);
            $many->setOrigem_id($origem->origem_id);
            $many->Execute()->insert();
        endforeach;
    endif;
}

function uploadFiles($files, $regId) {

    if (!empty($files)):

        $Upload = new Upload();
        $regFile = new NcRegFile();

        foreach ($files as $file):
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
}

function uploadImages($images, $regId) {
    $Upload = new Upload();
    $regImage = new NcRegImage();

    if (!empty($images)):
        foreach ($images as $img):
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
}

switch ($method) {
    case "GET":
        //retorna todos os itens
        if ($id):
            $Read->setReg_id($id);
            $Read->Execute()->find();
            Check::JsonReturn($Read->Execute()->getResult(), 'Registro não encontrado!', '204');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma registro cadastrado!', '204');
        endif;
        break;
    case "POST":

        if (isset($request->reg_id)):

            //update
            $regId = $request->reg_id;
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
                uploadFiles($request->files, $regId);
                uploadImages($request->images, $regId);
            endif;

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

                addOrigens($request->origens, $regId);
                uploadFiles($request->files, $regId);
                uploadImages($request->images, $regId);
            endif;

            $request->reg_id = $Read->Execute()->MaxFild("reg_id");
        endif;

        echo json_encode($request);
        break;
    case "DELETE":
        //deleta não implementado
        $Read->setReg_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}