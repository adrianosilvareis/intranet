<?php

class AdminSftOutputPart {

    private $Read;
    private $Dados;

    function __construct() {
        $this->Read = new SftOutputPart();
    }

    public function ExeCreate($Dados) {
        $this->Dados = $Dados;
        $this->setDados();
        $this->Read->setThis((object) $this->Dados);
        $this->Read->Execute()->insert();
    }

    public function ExeTruncate() {
        $this->Read->Execute()->truncate();
    }

    private function setDados() {
        $this->Dados = array_map("trim", $this->Dados);
        $this->Dados = array_map("strip_tags", $this->Dados);
    }

}
