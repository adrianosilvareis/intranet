<?php

/**
 * AdminNcOrigem.class [TIPO]
 * Descricao
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class AdminNcOrigem {

    private $Data;
    private $Read;
    private $Result;

    function __construct() {
        $this->Read = new NcOrigem();
    }

    function ExeCreate($Data) {
        $this->setData($Data);

        $this->Read->setThis((object) $this->Data);
        $this->Result = ($this->Read->Execute()->insert() ? $this->Read->Execute()->MaxFild("origem_id") : false);

        return $this->Result;
    }

    function ExeUpdate($Data) {
        $this->setData($Data);

        $this->Read->setThis((object) $this->Data);
        if ($this->Read->Execute()->update(NULL, "origem_id") || $this->ExeStatus()):
            return true;
        else:
            return false;
        endif;
    }

    function ExeDelete($Data) {
        $this->setData($Data);
        $this->Read->setOrigem_id($this->Data['origem_id']);
        return $this->Read->Execute()->delete();
    }

    function ExeStatus($Data = null) {
        if (!empty($Data))
            $this->setData($Data);

        return $this->Read->Execute()->update("origem_id={$this->Data['origem_id']}&origem_ativo={$this->Data['origem_ativo']}", 'origem_id');
    }

    function getResult() {
        return $this->Result;
    }

    /**
     * ****************************************
     * ************* PRIVATES *****************
     * ****************************************
     */
    private function setData($Data) {
        $this->Data = $Data;
        $this->Data = array_map("trim", $this->Data);
        $this->Data = array_map("strip_tags", $this->Data);
    }

}
