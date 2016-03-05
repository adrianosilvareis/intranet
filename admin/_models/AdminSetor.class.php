<?php

class AdminSetor {

    private $Read;
    private $Result;
    private $Error;
    private $Data;

    function __construct() {
        $this->Read = new WsSetor();
    }

    function ExeCreate($Data) {
        if ($this->setDados($Data)):
            $this->Create();
        endif;
    }

    function ExeUpdate($Data) {
        if ($this->setDados($Data)):
            $this->Update();
        endif;
    }

    function ExeStatus($setId, $status) {
        $this->Read->Execute()->update("setor_id={$setId}&setor_status={$status}", 'setor_id');
    }

    function ExeDelete($setor_id) {
        $this->Read->setSetor_id($setor_id);
        $find = $this->Read->Execute()->find();
        $this->Read->Execute()->delete();
        $this->Error[0] = $find->setor_content;
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
            $this->Data['setor_date'] = Check::Data($this->Data['setor_date']);
            return true;
        endif;
    }

    private function Create() {
        $this->Data['setor_id'] = null;
        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        if ($insert):
            $this->Result = $this->Read->Execute()->MaxFild('setor_id');
            $this->Error = ["<b>Sucesso:</b> O Setor <b>{$this->Data['setor_content']}</b> foi cadastrado no sistema!", WS_ACCEPT];
        endif;
    }

    private function Update() {
        $update = $this->Read->Execute()->update($this->Data, 'setor_id');
        if ($update):
            $this->Result = $this->Read->Execute()->MaxFild('setor_id');
            $this->Error = ["<b>Sucesso:</b> O Setor <b>{$this->Data['setor_content']}</b> foi atualizado no sistema!", WS_ACCEPT];
        endif;
    }

}
