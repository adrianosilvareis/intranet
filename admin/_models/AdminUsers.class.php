<?php

/**
 * AdminUsers.class.php [ Models Admin ]
 * Responsavel por gerenciar os Usuarios do sistema no Admin
 *
 * @copyright (c) 2015 AdrianoReis PROGRAMADOR
 */
class AdminUsers {

    private $Data;
    private $Users;
    private $Error;
    private $Result;
    private $Read;

    public function ExeCreate(array $Dados) {
        $this->Data = $Dados;
        $this->setNome();
        $this->setData();
        if ($this->Error == null):
            $this->CreateImage();
        endif;
    }

    public function ExeUpdate($UserId, array $Data) {
        $this->Users = (int) $UserId;
        $this->Data = $Data;

        $this->setNome();
        $this->setData();
        if ($this->Error == null):
            $this->UpdateImage();
        endif;
    }

    public function ExeDelete($UserId) {
        $this->Users = (int) $UserId;

        $WsUsers = new WsUsers();
        $WsUsers->setUser_id($this->Users);
        $usuario = $WsUsers->Execute()->find();
        if (!$WsUsers->Execute()->getResult()):
            $this->Result = false;
            $this->Error = ['Oppsss, você tentou remover um usuário que não existe no sistema!', WS_INFOR];
        else:
            $WsUsers->setUser_id(null);
            $WsUsers->setUser_level(3);
            $WsUsers->Execute()->Query("#user_level#");
            if ($WsUsers->Execute()->getRowCount() == 1 && $usuario->user_level == 3):
                $this->Result = false;
                $this->Error = ['<b>Oppsss</b>, você não pode excluir todos os usuários administradores do sistema!', WS_ERROR];
            else:
                $this->Result = true;
                $WsUsers->setUser_id($this->Users);
                $WsUsers->setUser_level(null);
                $WsUsers->Execute()->delete();
                $this->Error = ["<b>Sucesso:</b> O usuário <b>{$usuario->user_name}</b> foi excluido do sistema!", WS_ACCEPT];
            endif;
        endif;
    }

    public function checkLast() {
        $WsUsers = new WsUsers;
        $WsUsers->Execute()->findAll();
        if ($WsUsers->Execute()->getRowCount() == 1):
            $WsUsers->setThis($WsUsers->Execute()->getResult()[0]);
            $WsUsers->setUser_level(1);
            $WsUsers->Execute()->update(null, "user_id");
            $WsUsers->Execute()->findAll();
        endif;
        return $WsUsers;
    }

    function getError() {
        return $this->Error;
    }

    function getResult() {
        return $this->Result;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    private function setData() {
        $cover = (!empty($this->Data['user_cover']) ? $this->Data['user_cover'] : NULL);

        unset($this->Data['user_cover']);
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['user_birthday'] = Check::Data($this->Data['user_birthday']);
        $this->Data['user_cover'] = (!empty($cover) ? $cover : NULL);

        if (!Check::Email($this->Data['user_email'])):
            $this->Error = ['<b>Oppss, email Inválido</b>, por favor preencha corretamente o campo.', WS_ALERT];
            $this->Data['user_email'] = null;
            $this->Result = null;
        endif;

//        $this->Data['user_level'] = 5;
        $this->Data['user_status'] = 1;
        $this->Data['user_registration'] = date('Y-m-d H:i:s', time());
        $this->Data['user_lastupdate'] = date('Y-m-d H:i:s', time());
        if (!empty($this->Data['user_password'])):
            $this->Data['user_password'] = md5($this->Data['user_password']);
        else:
            unset($this->Data['user_password']);
        endif;
    }

    private function deletaArquivo($Url) {
        if (file_exists($Url) && !is_dir($Url)):
            unlink($Url);
        endif;
    }

    private function CreateImage() {
        if ($this->Data['user_cover']):
            $upload = new upload();
            $upload->Image($this->Data['user_cover'], $this->Data['user_name']);
        endif;

        if (isset($upload) && $upload->getResult()):
            $this->Data['user_cover'] = $upload->getResult();
            $this->Create();
        else:
            $this->Data['user_cover'] = null;
            $_SESSION['errCapa'] = "<b>ERRO AO ENVIAR CAPA: </b>Tipo de arquivo inválido, envie imagens JPG e PNG!";
            $this->Create();
        endif;
    }

    private function UpdateImage() {

        if (is_array($this->Data['user_cover'])):
            $WsUsers = new WsUsers();
            $WsUsers->setUser_id($this->Users);
            $WsUsers->Execute()->find();

            $this->deletaArquivo('../uploads/' . $WsUsers->Execute()->getResult()->user_cover);

            $upload = new Upload;
            $upload->Image($this->Data['user_cover'], $this->Data['user_name']);
        endif;

        if (isset($upload) && $upload->getResult()):
            $this->Data['user_cover'] = $upload->getResult();
            $this->Update();
        else:
            unset($this->Data['user_cover']);
            if (!empty($upload) && $upload->getError()):
                WSErro("<b>ERRO AO ENVIAR CAPA: </b>" . $upload->getError(), E_USER_WARNING);
            endif;
            $this->Update();
        endif;
    }

    private function setNome() {
        $Where = (!empty($this->Users) ? "user_id != {$this->Users} AND " : '');
        $this->Read = new WsUsers();
        $this->Read->setUser_email($this->Data['user_email']);
        $this->Read->setUser_nickname($this->Data['user_nickname']);
        $this->Read->Execute()->Query("{$Where}#user_email# OR {$Where}#user_nickname#");
        if ($this->Read->Execute()->getResult()):
            $this->Error = ['<b>Opppsss, email ou usuario já cadastrado</b>, por favor preencha um novo email ou usuario.', WS_INFOR];
            $this->Result = null;
        endif;
    }

    private function Create() {
        $this->Data['user_id'] = null;
        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();

        $this->Messagem("cadastrada", $this->Read->Execute()->MaxFild('user_id'), $insert);
    }

    private function Update() {
        $this->Data['user_id'] = $this->Users;
        $this->Read->setThis((object) $this->Data);
        $update = $this->Read->Execute()->update(null, 'user_id');

        $this->Messagem("atualizada", $this->Read->Execute()->MaxFild('user_id'), $update);
    }

    private function Messagem($Action, $Return, $Criterio) {
        if ($Criterio):
            $this->Result = $Return;
            $this->Error = ["<b>Sucesso:</b> Usuário <b>{$this->Data['user_nickname']}</b> foi {$Action} corretamente no sistema!", WS_ACCEPT];
        endif;
    }

}
