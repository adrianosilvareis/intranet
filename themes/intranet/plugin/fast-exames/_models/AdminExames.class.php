<?php

/**
 * AdminExames.class.php [ Models Admin ]
 * Responsavel por gerenciar os pedidos de alteração ou criação de exames
 *
 * @copyright (c) 2015, Adriano Reis
 */
class AdminExames {

    private $Read;
    private $Data;
    private $Result;

    function __construct() {
        $this->Read = new FeExames();
    }

    /**
     * Cadastra o Exame no sistema
     * 
     * @param array $Data
     * @return boolean
     */
    public function ExeCreate($Data) {
        $this->Data = $Data;
        $this->setData();
        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        $this->Result = $this->Read->Execute()->MaxFild("ex_id");
        return $insert;
    }

    /**
     * Atualiza as solicitações de exames
     * 
     * @param array $Data
     * @return boolean
     */
    public function ExeUpdate($Data) {
        $this->Data = $Data;
        $this->setData();

        $this->Read->setThis((object) $this->Data);
        return $this->update();
    }

    /**
     * Atualiza o status do exame no sistema
     * 
     * @param int $ExameId
     * @param boolean $Exame_status
     * @return boolean
     */
    public function ExeStatus($ExameId, $Exame_status) {
        return $this->Read->Execute()->update("ex_id=$ExameId&ex_status=$Exame_status", "ex_id");
    }

    /**
     * Cancela ou ativa uma solicitação
     * 
     * @param int $ExameId
     * @param boolean $ExameCancelado
     * @return boolean
     */
    public function ExeCancelar($ExameId, $ExameCancelado) {
        return $this->Read->Execute()->update("ex_id=$ExameId&ex_cancelado=$ExameCancelado", "ex_id");
    }

    /**
     * retorna o resultado das operações realizadas na class
     * 
     * @return type
     */
    function getResult() {
        return $this->Result;
    }

    /**
     * Retorna um objeto Exame com Id informado
     * 
     * @param int $exameId
     * @return object
     */
    public function FindId($exameId) {
        $this->Read->Execute()->find("ex_id=$exameId");
        return $this->Read->Execute()->getResult();
    }

    /**
     * ****************************************
     * ************* FOREIGN KEY **************
     * ****************************************
     */

    /**
     * Retorna descrição do setor com Id informado
     * 
     * @param int $Setor
     * @return string
     */
    public function Setor($Setor) {
        $FeSetor = new FeSetor();
        $FeSetor->setSet_id($Setor);
        return (!empty($FeSetor->Execute()->find()) ? $FeSetor->Execute()->find()->set_descricao : null);
    }

    /**
     * Retorna descrição do usuario com Id informado
     * 
     * @param int $User
     * @return string
     */
    public function Usuario($User) {
        $WsUsers = new WsUsers();
        $WsUsers->setUser_id($User);
        return (!empty($WsUsers->Execute()->find()) ? $WsUsers->Execute()->find()->user_name : null);
    }

    /**
     * Retorna descrição do metodo com Id informado
     * 
     * @param int $Metodo
     * @return string
     */
    public function Metodo($Metodo) {
        $FeMetodo = new FeMetodo();
        $FeMetodo->setMet_id($Metodo);
        return (!empty($FeMetodo->Execute()->find()) ? $FeMetodo->Execute()->find()->met_descricao : null);
    }

    /**
     * Retorna descrição do material com Id informado
     * 
     * @param int $Material
     * @return string
     */
    public function Material($Material) {
        $FeMaterial = new FeMaterial();
        $FeMaterial->setMat_id($Material);
        return (!empty($FeMaterial->Execute()->find()) ? $FeMaterial->Execute()->find()->mat_descricao : null);
    }

    /**
     * Retorna descrição do ação com Id informado
     * 
     * @param int $Acao
     * @return string
     */
    public function Acao($Acao) {
        $FeAcoes = new FeAcoes();
        $FeAcoes->setAcao_id($Acao);
        return (!empty($FeAcoes->Execute()->find()) ? $FeAcoes->Execute()->find()->acao_descricao : null);
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
        $this->Data['ex_status'] = (!empty($this->Data['ex_status']) ? $this->Data['ex_status'] : "0");
        $this->Data['ex_cancelado'] = (!empty($this->Data['ex_cancelado']) ? $this->Data['ex_cancelado'] : "0");
    }

    private function update() {

        $update = $this->Read->Execute()->update(null, 'ex_id');
        $cancelar = $this->ExeCancelar($this->Data['ex_id'], $this->Data['ex_cancelado']);
        $status = $this->ExeStatus($this->Data['ex_id'], $this->Data['ex_status']);

        if ($update || $cancelar || $status):
            return true;
        endif;
    }

}
