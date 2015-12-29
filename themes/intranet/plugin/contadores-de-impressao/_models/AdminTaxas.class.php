<?php

/**
 * AdminTaxas.class.php [ Models Admin ]
 * Responsavel por gerenciar as taxas do sistema de impressora no Admin
 *
 * @copyright (c) 2015, Adriano Reis
 */
class AdminTaxas {

    private $Read;
    private $Result;
    private $Data;

    function __construct() {
        $this->Read = new ImpTaxaImpress();
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
        $this->Result = $this->Read->Execute()->MaxFild("taxa_id");
        return $insert;
    }
    
    /**
     * Executa a atualização das taxas de impressoras
     * 
     * @param array $Data
     * @return boolean
     */
    public function ExeUpdate($Data) {
        $this->Data = $Data;
        $this->setData();
        $this->Read->setThis((object) $this->Data);
        return $this->Read->Execute()->update(null, "taxa_id");
    }
    
    /**
     * Atualiza o status das taxas de impressoras no sistema
     * 
     * @param int $Taxa_id
     * @param boolean $Taxa_status
     * @return booelan
     */
    public function ExeStatus($Taxa_id, $Taxa_status){
        return $this->Read->Execute()->update("taxa_id=$Taxa_id&taxa_status=$Taxa_status", "taxa_id");
    }

    /**
     * Retorna o taxa de impressora com Id informado
     * 
     * @param int $Id
     * @return object:taxa
     */
    public function FindId($Id) {
        $this->Read->setTaxa_id($Id);
        $this->Read->Execute()->Query("#taxa_id#");
        return (!empty($this->Read->Execute()->getResult()[0]) ? $this->Read->Execute()->getResult()[0] : null);
    }

    /**
     * Retorna a taxa de impressora com Nome informado
     * 
     * @param string $Nome
     * @return object:taxa
     */
    public function FindNome($Nome) {
        $this->Read->setTaxa_descricao($Nome);
        $this->Read->Execute()->Query("#taxa_descricao#");
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
