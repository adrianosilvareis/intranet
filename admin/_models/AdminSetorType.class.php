<?php

class AdminSetorType {

    private $Read;
    private $Result;
    private $Dados;

    function __construct() {
        $this->Read = new Controle("ws_setor_type");
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
