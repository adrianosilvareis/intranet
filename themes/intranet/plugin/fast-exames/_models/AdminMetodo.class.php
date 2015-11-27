<?php

/**
 * AdminMetodo.class [TIPO]
 * Descricao
 * @copyright (c) year, Adriano S. Reis Programador
 */
class AdminMetodo {

    private $Read;
    private $Data;
    private $Result;

    function __construct() {
        $this->Read = new FeMetodo();
    }

    /**
     * Cria Metodos no sistema
     * 
     * @param array $Data
     * @return boolean
     */
    public function ExeCreate($Data) {
        $this->Data = $Data;
        $this->setData();

        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        $this->Result = $this->Read->Execute()->MaxFild("met_id");
        return $insert;
    }

    /**
     * Atualiza status dos metodos do sistema
     * 
     * @param int $MetodoId
     * @param boolean $MetodoStatus
     * @return boolean
     */
    public function ExeStatus($MetodoId, $MetodoStatus) {
        return $this->Read->Execute()->update("met_id$MetodoId&met_status=$MetodoStatus", "met_id");
    }

    /**
     * retorna resultado da ultima operação
     * 
     * @return type
     */
    function getResult() {
        return $this->Result;
    }

    /**
     * Retorna Metodo com descrição informada
     * 
     * @param string $met_descricao
     * @return object
     */
    public function FindName($met_descricao) {
        $this->Read->setMet_descricao($met_descricao);
        return $this->Read->Execute()->Query("#met_descricao#");
    }

    /**
     * ****************************************
     * ************** PRIVATES ****************
     * ****************************************
     */
    
    /**
     * Tratamento de entrada de dados
     * 
     * Limpa campos em branco e codigos indevidos, na entrada de dados
     */
    private function setData() {
        $this->Data = array_map("strip_tags", $this->Data);
        $this->Data = array_map("trim", $this->Data);
    }

}
