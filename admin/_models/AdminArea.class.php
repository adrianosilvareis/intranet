<?php

class AdminArea {

    private $Read;
    private $Result;
    private $Error;
    private $Data;

    function __construct() {
        $this->Read = new WsAreaTrabalho();
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

    function ExeStatus($areaId, $status) {
        $this->Read->Execute()->update("area_id={$areaId}&area_status={$status}", 'area_id');
    }

    function ExeDelete($area_id) {
        $this->Read->setArea_id($area_id);
        $this->Read->Execute()->find();

        if (!$this->Read->Execute()->getResult()):
            $this->Error = ['A Área que você tentou deletar não existe no sistema!', WS_ERROR];
            $this->Result = false;
        else:

            $WsUsers = new WsUsers();
            $WsUsers->setArea_id($area_id);
            $WsUsers->Execute()->find();

            $area = $this->Read->Execute()->getResult();
            $this->Read->setThis($area);
            if ($WsUsers->Execute()->getResult()):
                $this->Error = ["<b>{$this->Read->getArea_title()}</b> não pode ser deletado, pois esta sendo utilizado!", WS_ERROR];
                $this->Result = false;
            else:
                $this->Read->Execute()->delete();
                $this->Error = ["<b>{$area->area_title}</b> foi deletado do sistema!", WS_ACCEPT];
            endif;
        endif;
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
            $this->Data['area_date'] = Check::Data($this->Data['area_date']);
            $this->Data['category_parent'] = $this->getCatParent();
            return true;
        endif;
    }

    private function getCatParent() {
        $rCat = new WsAreaCategory();
        $rCat->setCategory_id($this->Data['category_id']);
        $rCat->Execute()->find();

        if ($rCat->Execute()->getResult()):
            return $rCat->Execute()->getResult()->category_parent;
        else:
            return null;
        endif;
    }

    private function Create() {
        $this->Data['area_id'] = null;
        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        if ($insert):
            $this->Result = $this->Read->Execute()->MaxFild('area_id');
            $this->Error = ["<b>Sucesso:</b> A Área <b>{$this->Data['area_title']}</b> foi cadastrada no sistema!", WS_ACCEPT];
        endif;
    }

    private function Update() {
        $update = $this->Read->Execute()->update($this->Data, 'area_id');
        if ($update):
            $this->Result = $this->Read->Execute()->MaxFild('area_id');
            $this->Error = ["<b>Sucesso:</b> A Área <b>{$this->Data['area_title']}</b> foi atualizada no sistema!", WS_ACCEPT];
        endif;
    }

}
