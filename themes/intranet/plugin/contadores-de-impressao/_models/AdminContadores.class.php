<?php

/**
 * AdminContadores.class.php [ Models Admin ]
 * Responsavel por gerenciar os contadores registrados
 * 
 * @author Adriano Reis <adriano_silvareis@hotmail.com>
 * @copyright (c) 2015, Adriano Reis
 */
class AdminContadores {

    private $Data;
    private $Result;
    private $Read;

    function __construct() {
        $this->Read = new AppContadores();
    }

    /**
     * Atualiza os contadores do systema
     * 
     * @param array $Data
     * @return boolean
     */
    public function ExeUpdate($Data) {
        $this->Data = $Data;
        $this->setData();

        $this->Read->setThis((object) $this->Data);
        $this->Result = $this->Read->Execute()->update(null, "contadores_id");
        return $this->getResult();
    }

    /**
     * Deleta o contador selecionado
     * 
     * @param int $contadores_id
     * @return boolean
     */
    public function ExeDelete($contadores_id) {
        $this->Read->setContadores_id($contadores_id);
        $this->Result = $this->Read->Execute()->delete();
        return $this->getResult();
    }

    /**
     * Retorna o resultado das ações da classe
     * 
     * @return boolean
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * Retorna um objeto contador, com sua forey_key impressora completa.
     * 
     * @param int $contadores_id
     * @return object
     */
    function FindId($contadores_id) {
        $this->Read->setThis(NULL);
        $this->Read->setContadores_id($contadores_id);
        $this->Result = $this->Read->Execute()->FullRead("SELECT * FROM app_contadores c JOIN app_impressora i ON(c.fk_impressora = i.impressora_id) WHERE #contadores_id#");
        return $this->getResult();
    }

    /**
     * ****************************************
     * ************* PRIVATES *****************
     * ****************************************
     */

    /**
     * realiza o tratamento de entrada de dados
     */
    private function setData() {
        $this->Data = array_map("trim", $this->Data);
        $this->Data = array_map("strip_tags", $this->Data);
    }

}
