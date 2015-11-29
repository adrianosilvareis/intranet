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

    public function ExeUpdate($Data) {
        $this->Data = $Data;
        $this->setData();

        $this->Read->setThis((object) $this->Data);
        if ($this->Read->Execute()->update(NULL, "met_id") || $this->ExeStatus($this->Data['met_id'], $this->Data['met_status'])):
            return true;
        else:
            return false;
        endif;
    }

    public function ExeDelete($met_id) {
        $FeExames = new FeExames();
        $FeExames->setFe_metodo($met_id);
        $FeExames->Execute()->Query("#fe_metodo#");
        
        if (!$FeExames->Execute()->getResult()):
            $this->Read->setMet_id($met_id);
            return $this->Read->Execute()->delete();
        endif;
    }

    /**
     * Atualiza status dos metodos do sistema
     * 
     * @param int $MetodoId
     * @param boolean $MetodoStatus
     * @return boolean
     */
    public function ExeStatus($MetodoId, $MetodoStatus) {
        return $this->Read->Execute()->update("met_id=$MetodoId&met_status=$MetodoStatus", "met_id");
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
     * Retorna metodo com id informado
     * 
     * @param int $met_id
     * @return object
     */
    public function FindId($met_id) {
        $this->Read->setMet_id($met_id);
        return $this->Read->Execute()->find();
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
