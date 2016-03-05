<?php

class AdminSetorType {

    private $Read;
    private $Result;
    private $Error;
    private $Dados;

    function __construct() {
        $this->Read = new WsSetorType();
    }

    function ExeCreate($Data) {
        $Data['setor_type'] = '1';
        if ($this->setDados($Data)):
            $this->Create();
        endif;
    }

    function ExeUpdate($Data) {
        if ($this->setDados($Data)):
            $this->Update();
        endif;
    }

    function ExeStatus($typeId, $status) {
        $this->Read->Execute()->update("type_id={$typeId}&type_status={$status}", 'type_id');
    }

    function ExeDelete($type_id) {
        $this->Read->setType_id($type_id);
        $find = $this->Read->Execute()->find();
        $this->Read->Execute()->delete();
        $this->Error[0] = $find->type_content;
        $this->Error[1] = WS_ACCEPT;
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    /**
     * ****************************************
     * *********** PRIVATES *******************
     * ****************************************
     */
    private function setDados($Data) {
        if (in_array('', $Data)):
            $this->Result = false;
            $this->Error = ["<b>Erro de insersão:</b> Para efetuar esta ação, preencha todos os campos!", WS_ALERT];
        else:
            $this->Data = $Data;
            $this->Data = array_map("trim", $this->Data);
            $this->Data = array_map("strip_tags", $this->Data);
            return true;
        endif;
    }

    private function Create() {
        $this->Data['type_id'] = null;
        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        if ($insert):
            $this->Result = $this->Read->Execute()->MaxFild('type_id');
            $this->Error = ["<b>Sucesso:</b> O Tipo <b>{$this->Data['type_content']}</b> foi cadastrado no sistema!", WS_ACCEPT];
        endif;
    }

    private function Update() {
        $update = $this->Read->Execute()->update($this->Data, 'type_id');
        if ($update):
            $this->Result = $this->Read->Execute()->MaxFild('type_id');
            $this->Error = ["<b>Sucesso:</b> O Tipo <b>{$this->Data['type_content']}</b> foi atualizado no sistema!", WS_ACCEPT];
        endif;
    }

}
