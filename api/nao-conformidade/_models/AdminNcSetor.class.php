<?php

/**
 * AdminNcSetor.class [TIPO]
 * Descricao
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class AdminNcSetor {

    private $Data;
    private $Result;
    private $Read;

    function __construct() {
        $this->Read = new NcSetor();
    }

    function ExeCreate($Data) {
        $this->setData($Data);

        $this->Read->setThis((object) $this->Data);
        $this->Result = ($this->Read->Execute()->insert() ? $this->Read->Execute()->MaxFild("setor_id") : false);

        return $this->Result;
    }

    function ExeUpdate($Data) {
        $this->setData($Data);

        if ($this->Read->Execute()->update(NULL, "setor_id") || $this->ExeStatus()):
            return true;
        else:
            return false;
        endif;
    }

    function ExeDelete($Data) {
        $this->setData($Data);
        $this->Read->setSetor_id($this->Data['setor_id']);
        $this->Read->Execute()->delete();
    }

    function ExeStatus($Data = NULL) {
        if(!empty($Data))
            $this->setData ($Data);
        
        return $this->Read->Execute()->update("setor_id={$this->Data['setor)id]']}&setor_ativo={$this->Data['setor_ativo']}", "setor_id");
    }

    function getResult() {
        return $this->Result;
    }

    /**
     * ****************************************
     * ************* PRIVATE ******************
     * ****************************************
     */
    private function setData($Data) {
        $this->Data = Data;
        $this->Data = array_map("trim", $this->Data);
        $this->Data = array_map("strip_tags", $this->Data);
    }

}
