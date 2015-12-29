<?php

/**
 * AdminModelo.class.php [ Models Admin ]
 * Responsavel por gerenciar os modelos de impressoras no sistema no Admin
 *
 * @copyright (c) 2015, Adriano Reis
 */
class AdminModelo {

    private $Read;
    private $Data;
    private $Result;

    public function __construct() {
        $this->Read = new ImpModelo();
    }
    
    /**
     * Executa a criação dos modelos de impressoras
     * 
     * @param array $Data
     * @return boolean
     */
    public function ExeCreate($Data) {
        $this->Data = $Data;
        $this->setData();
        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        $this->Result = $this->Read->Execute()->MaxFild("modelo_id");
        return $insert;
    }
    
    /**
     * Executa a atualização dos modelos de impressoras
     * 
     * @param array $Data
     * @return boolean
     */
    public function ExeUpdate($Data) {
        $this->Data = $Data;
        $this->setData();
        $this->Read->setThis((object) $this->Data);
        return $this->Read->Execute()->update(null, "modelo_id");
    }
    
    /**
     * Atualiza o status dos modelos de impressoras no sistema
     * 
     * @param int $Modelo_id
     * @param boolean $Modelo_status
     * @return booelan
     */
    public function ExeStatus($Modelo_id, $Modelo_status){
        return $this->Read->Execute()->update("modelo_id=$Modelo_id&modelo_status=$Modelo_status", "modelo_id");
    }
    
    /**
     * Esta função não deve ser executada visto que as impressoras não mudas de modelo.
     */
    public function ExeDelete(){        
    }
    
    /**
     * Retorna o modelo de impressora com Id informado
     * 
     * @param int $Id
     * @return object:modelo
     */
    public function FindId($Id) {
        $this->Read->setModelo_id($Id);
        $this->Read->Execute()->Query("#modelo_id#");
        return (!empty($this->Read->Execute()->getResult()[0]) ? $this->Read->Execute()->getResult()[0] : null);
    }

    /**
     * Retorna o modelo de impressora com Nome informado
     * 
     * @param string $Nome
     * @return object:modelo
     */
    public function FindNome($Nome) {
        $this->Read->setModelo_descricao($Nome);
        $this->Read->Execute()->Query("#modelo_descricao#");
        return (!empty($this->Read->Execute()->getResult()[0]) ? $this->Read->Execute()->getResult()[0] : null);
    }
    
    /**
     * Resultado das buscas
     * 
     * @return retultado
     */
    public function getResult() {
        return $this->Result;
    }
    
    /**
     * ****************************************
     * ************** Private *****************
     * ****************************************
     */
    
    /**
     * Tratamento de entrada de dados
     */
    private function setData() {
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
    }

}
