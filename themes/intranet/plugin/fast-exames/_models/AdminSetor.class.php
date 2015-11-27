<?php

/**
 * AdminSetor.class [TIPO]
 * Descricao
 * @copyright (c) year, Adriano S. Reis Programador
 */
class AdminSetor {

    private $Read;
    private $Data;
    private $Result;

    function __construct() {
        $this->Read = new FeSetor();
    }

    function ExeCreate($Data) {
        $this->Data = $Data;
        $this->setData();

        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        $this->Result = $this->Read->Execute()->MaxFild("set_id");
        return $insert;
    }

    function ExeStatus($SetorId, $SetorStatus) {
        return $this->Read->Execute()->update("set_id=$SetorId&set_status=$SetorStatus", "set_id");
    }

    function getResult() {
        return $this->Result;
    }

    function FindName($set_descricao) {
        $this->Read->setSet_descricao($set_descricao);
        return $this->Read->Execute()->Query("#set_descricao#");
    }

    /**
     * ****************************************
     * *************** PRIVATES ***************
     * ****************************************
     */
    
    /**
     * Tratamento de entrada de dados
     * 
     * Limpa campos em branco e codigos indevidos, na entrada de dados
     */
    private function setData() {
        $this->Data = array_map('trim', $this->Data);
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data['set_solicita'] = (!empty($this->Data['set_solicita']) ? '1' : '0');
        $this->Data['set_execucao'] = (!empty($this->Data['set_execucao']) ? '1' : '0');
    }

}
