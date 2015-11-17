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

    function getResult() {
        return $this->Result;
    }
    
    /**
     * ****************************************
     * ************* FOREIGN KEY **************
     * ****************************************
     */
    public function Setor($Setor){
        $FeSetor = new FeSetor();
        $FeSetor->setSet_id($Setor);
        return (!empty($FeSetor->Execute()->find()) ? $FeSetor->Execute()->find()->set_descricao : null);
    }
    
    public function Usuario($User){
        $WsUsers = new WsUsers();
        $WsUsers->setUser_id($User);
        return (!empty($WsUsers->Execute()->find()) ? $WsUsers->Execute()->find()->user_name : null);
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
