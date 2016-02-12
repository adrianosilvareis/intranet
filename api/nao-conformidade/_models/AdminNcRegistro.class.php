<?php

/**
 * AdminNcRegistro.class [TIPO]
 *
 * @copyright (c) 2016, Adriano Reis
 */
class AdminNcRegistro {

    private $Read;
    private $Data;
    private $Result;

    function __construct() {
        $this->Read = new NcRegistro();
    }

    function ExeCreate($Data) {
        $this->setData($Data);

        $this->Read->setThis((object) $this->Data);
        $this->Result = ($this->Read->Execute()->insert() ? $this->Read->Execute()->MaxFild("reg_id") : false);

        return $this->Result;
    }

    function ExeUpdate($Data) {
        $this->setData($Data);

        return $this->Read->Execute()->update(NULL, "reg_id");
    }

    function ExeDelete($Data) {
        $this->setData($Data);
        $this->Read->setReg_id($this->Data['reg_id']);
        return $this->Read->Execute()->delete();
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
        $this->Data = $Data;
        $this->Data = array_map("trim", $this->Data);
        $this->Data = array_map("strip_tags", $this->Data);
    }

}
