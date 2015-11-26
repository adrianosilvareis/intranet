<?php

class AdminExames {

    private $Read;
    private $Data;
    private $Result;

    function __construct() {
        $this->Read = new FeExames();
    }

    public function ExeCreate($Data) {
        $this->Data = $Data;
        $this->setData();
        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        $this->Result = $this->Read->Execute()->MaxFild("ex_id");
        return $insert;
    }

    public function ExeStatus($ExameId, $Exame_status) {
        return $this->Read->Execute()->update("ex_id=$ExameId&ex_status=$Exame_status", "ex_id");
    }

    function getResult() {
        return $this->Result;
    }

    public function FindId($exameId) {
        $this->Read->Execute()->find("ex_id=$exameId");
        return $this->Read->Execute()->getResult();
    }

    /**
     * ****************************************
     * ************* FOREIGN KEY **************
     * ****************************************
     */
    public function Setor($Setor) {
        $FeSetor = new FeSetor();
        $FeSetor->setSet_id($Setor);
        return (!empty($FeSetor->Execute()->find()) ? $FeSetor->Execute()->find()->set_descricao : null);
    }

    public function Usuario($User) {
        $WsUsers = new WsUsers();
        $WsUsers->setUser_id($User);
        return (!empty($WsUsers->Execute()->find()) ? $WsUsers->Execute()->find()->user_name : null);
    }

    public function Metodo($Metodo) {
        $FeMetodo = new FeMetodo();
        $FeMetodo->setMet_id($Metodo);
        return (!empty($FeMetodo->Execute()->find()) ? $FeMetodo->Execute()->find()->met_descricao : null);
    }

    public function Material($Material) {
        $FeMaterial = new FeMaterial();
        $FeMaterial->setMat_id($Material);
        return (!empty($FeMaterial->Execute()->find()) ? $FeMaterial->Execute()->find()->mat_descricao : null);
    }
    
    public function Acao($Acao){
        $FeAcoes = new FeAcoes();
        $FeAcoes->setAcaoId($Acao);
        return (!empty($FeAcoes->Execute()->find()) ? $FeAcoes->Execute()->find()->acao_descricao : null);
    }

    /**
     * ****************************************
     * ************** PRIVATES ****************
     * ****************************************
     */

    /**
     * Limpa campos em branco e codigos indevidos, na entrada de dados
     */
    private function setData() {
        $this->Data = array_map("strip_tags", $this->Data);
        $this->Data = array_map("trim", $this->Data);
    }

}
