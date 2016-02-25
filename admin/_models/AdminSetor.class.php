<?php

class AdminSetor {

    private $Read;
    private $Result;
    private $Error;
    private $Dados;

    function __construct() {
        $this->Read = new Controle("ws_setor");
    }

    function ExeCreate($Dados) {
        $this->setDados($Dados);
    }

    function ExeUpdate($Dados) {
        $this->setDados($Dados);
    }

    function ExeStatus($Dados) {
        $this->setDados($Dados);
    }

    function ExeDelete($Dados) {
        $this->setDados($Dados);
    }

    function getResult() {
        return $this->Result;
    }
    
    function getError(){
        return $this->Error;
    }

    /**
     * ****************************************
     * *********** PRIVATES *******************
     * ****************************************
     */
    private function setDados($Dados) {
        $this->Dados = $Dados;
        $this->Dados = array_map("trim", $this->Dados);
        $this->Dados = array_map("strip_tags", $this->Dados);
    }

}
