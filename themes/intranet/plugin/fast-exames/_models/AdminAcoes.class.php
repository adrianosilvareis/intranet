<?php

/**
 * AdminAcoes.class [TIPO]
 * Descricao
 * @copyright (c) year, Adriano S. Reis Programador
 */
class AdminAcoes {

    private $Data;
    private $Read;
    private $Result;

    function __construct() {
        $this->Read = new FeAcoes();
    }

    /**
     * Cadastra Ações do sistema
     * 
     * @param array $Data
     * @return boolean
     */
    function ExeCreate($Data) {
        $this->Data = $Data;
        $this->setData();

        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        $this->Result = $this->Read->Execute()->MaxFild("acao_id");
        return $insert;
    }

    /**
     * Atualiza Ações do sistema
     * 
     * @param array $Data
     * @return booelan
     */
    function ExeUpdate($Data) {
        $this->Data = $Data;
        $this->setData();

        $this->Read->setThis((object) $this->Data);
        if ($this->Read->Execute()->update(null, 'acao_id') || $this->ExeStatus($this->Data['acao_id'], $this->Data['acao_status'])):
            return true;
        else:
            return false;
        endif;
    }
    
    /**
     * Deleta ação de exame se não estiver sendo usado
     * 
     * @param int $acao_id
     * @return boolean
     */
    function ExeDelete($acao_id) {
        $FeExames = new FeExames();
        $FeExames->setFe_acoes($acao_id);
        $FeExames->Execute()->find();

        if (!$FeExames->Execute()->getResult()):
            $this->Read->setAcao_id($acao_id);
            return $this->Read->Execute()->delete();
        endif;
    }

    /**
     * atualiza o status as ações do sistema
     * 
     * @param int $AcaoId
     * @param booelan $AcaoStatus
     * @return boolean
     */
    function ExeStatus($AcaoId, $AcaoStatus) {
        return $this->Read->Execute()->update("acao_id=$AcaoId&acao_status=$AcaoStatus", 'acao_id');
    }

    function getResult() {
        return $this->Result;
    }

    /**
     * Encontra ação com a descrição informada
     * 
     * @param string $acao_descricao
     * @return object
     */
    function FindName($acao_descricao) {
        $this->Read->setAcao_descricao($acao_descricao);
        return $this->Read->Execute()->Query("#acao_descricao#");
    }

    /**
     * Encontra ação com id informado
     * 
     * @param string $acao_id
     * @return object
     */
    function FindId($acao_id) {
        $this->Read->setAcao_id($acao_id);
        return $this->Read->Execute()->find();
    }

    /**
     * ****************************************
     * ************ PRIVATES ******************
     * ****************************************
     */

    /**
     * Tratamento de entrada de dados
     * 
     * Limpa campos em branco e codigos indevidos, na entrada de dados
     */
    private function setData() {
        $this->Data = array_map("trim", $this->Data);
        $this->Data = array_map("strip_tags", $this->Data);
    }

}
