<?php

/**
 * @category Administrador
 * @copyright (c) 2016, Adriano Reis
 */
class AdminPerfil {

    private $Data;
    private $Perfil;
    private $Error;
    private $Result;

    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um perfil, favor preencha todos os campos!", WS_ALERT];
            $this->Result = FALSE;
        else:
            $this->setData();
            $this->setName();
            $this->Create();
        endif;
        $this->Data = null;
    }

    public function ExeUpdate($PerfilId, array $Data) {
        $this->Perfil = (int) $PerfilId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este perfil, preencha todos os campos", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();
            $this->Update();
            $this->ExeStatus($PerfilId, $Data['perfil_status']);
            $this->Data = null;
        endif;
    }

    public function ExeDelete($PerfilId) {
        $this->Perfil = (int) $PerfilId;

        $ReadPerfil = new WsPerfil();
        $ReadPerfil->setPerfil_id($this->Perfil);
        $ReadPerfil->Execute()->find();

        if (!$ReadPerfil->Execute()->getResult()):
            $this->Error = ['O perfil que você tentou deletar não existe no sistema!', WS_ERROR];
            $this->Result = false;
        else:

            $WsUsers = new WsUsers();
            $WsUsers->setPerfil_id($this->Perfil);
            $WsUsers->Execute()->find();

            $PerfilDelete = $ReadPerfil->Execute()->getResult();
            $ReadPerfil->setThis($PerfilDelete);
            
            if ($WsUsers->Execute()->getResult()):
                $this->Error = ["<b>{$ReadPerfil->getPerfil_title()}</b> não pode ser deletado, pois esta sendo utilizado!", WS_ERROR];
                $this->Result = false;
            else:
                $ReadPerfil->Execute()->delete();
                $this->Error = ["<b>{$PerfilDelete->perfil_title}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
            endif;

        endif;
    }

    public function ExeStatus($PostId, $PostStatus) {
        $this->Data = null;
        $this->Perfil = (int) $PostId;
        $this->Data['perfil_status'] = (string) $PostStatus;
        $this->Data['perfil_id'] = $this->Perfil;

        $Read = new Controle('ws_perfil');
        $Read->update($this->Data, "perfil_id");
    }

    function getError() {
        return $this->Error;
    }

    function getResult() {
        return $this->Result;
    }

    /**
     * ****************************************
     * *************** PRIVATES ***************
     * ****************************************
     */
    private function setData() {
        $Content = $this->Data['perfil_content'];
        unset($this->Data['perfil_content']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['perfil_name'] = Check::Name($this->Data['perfil_title']);
        $this->Data['perfil_date'] = Check::Data($this->Data['perfil_date']);

        $this->Data['perfil_content'] = $Content;
    }

    private function setName() {
        $Where = (isset($this->Perfil) ? "perfil_id != {$this->Perfil} AND " : "");
        $WsPerfil = new WsPerfil();
        $WsPerfil->setPerfil_title($this->Data['perfil_title']);
        $WsPerfil->Execute()->Query("{$Where}#perfil_title#");

        if ($WsPerfil->Execute()->getResult()):
            $this->Data['perfil_name'] = $this->Data['perfil_name'] . '-' . $WsPerfil->Execute()->getRowCount();
        endif;
    }

    private function Create() {
        $cadastra = new WsPerfil();
        $this->Data['perfil_id'] = null;
        $cadastra->setThis((object) $this->Data);
        $result = $cadastra->Execute()->insert();

        $this->Message($this->Data['perfil_title'], "cadastrado", $cadastra->Execute()->MaxFild("perfil_id"), $result);
    }

    private function Update() {
        $WsPerfil = new WsPerfil();
        $this->Data['perfil_id'] = $this->Perfil;
        $this->Data['perfil_date'] = date('Y-m-d H:i:s');

        $WsPerfil->setThis((object) $this->Data);
        $result = $WsPerfil->Execute()->update(null, 'perfil_id');

        $this->Message($this->Data['perfil_title'], "atualizado", true, $result);
    }

    private function Message($Title, $Action, $Return, $Condicao) {
        if ($Condicao):
            $this->Error = ["O perfil <b>{$Title}</b> foi {$Action} com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $Return;
        endif;
    }

}
