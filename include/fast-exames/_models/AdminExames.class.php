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
        $this->MensagemCadastra($insert);
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
        $update = $this->update();

        if ($update && $this->Data['ex_status']):
            $WsSetor = new WsSetor();
            $WsSetor->setSetor_id($Data['ws_setor_soli']);
            $setor = $WsSetor->Execute()->find();

            if (!empty($setor->set_email)):
                $this->MensagemConcluido($setor->set_email);
            endif;
        endif;

        return $update;
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
        $WsSetor = new WsSetor();
        $WsSetor->setSetor_id($Setor);
        return (!empty($WsSetor->Execute()->find()) ? $WsSetor->Execute()->find()->setor_content : null);
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

    public function TempoMedio($ListaTempoMedio) {
        $dif = [];
        foreach ($ListaTempoMedio as $value) {
            $aberto = strtotime($value->data_inicio);
            $fechado = strtotime($value->data_fim);
            $dif[] = $fechado - $aberto;
        }

        $result['count'] = count($dif);
        $result['soma'] = array_sum($dif);
        $result['media'] = (count($dif) == 0 || array_sum($dif) == 0 ? 0 : round(array_sum($dif) / count($dif)));
        $result['max'] = (!empty($dif) ? max($dif) : 0);
        $result['min'] = (!empty($dif) ? min($dif) : 0);

        return $result;
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

        //retira excesso de espaços destes campos
        $this->Data['ex_observacao'] = str_replace('-', ' ', Check::Name($this->Data['ex_observacao']));
        $this->Data['ex_descricao'] = str_replace('-', ' ', Check::Name($this->Data['ex_descricao']));
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

    private function MensagemConcluido($email) {
        $Contato['Assunto'] = "Resposta automatica [FAST-EXAMES - {$this->Data['ex_descricao']}]";
        $Contato['DestinoNome'] = MAILNAME;
        $Contato['DestinoEmail'] = $email;
        $Contato['RemetenteEmail'] = "cpd@tommasi.com.br";
        $Contato['RemetenteNome'] = Check::UserLogin()['user_name'] . " " . Check::UserLogin()['user_lastname'];
        $Contato['Mensagem'] = "Olá<br>"
                . "<br>"
                . "O exame <b>{$this->Data['ex_descricao']}</b> <br>"
                . "recebeu a ação de <b>{$this->Acao($this->Data['fe_acoes'])}</b> com sucesso!<br>"
                . "Responsável por executar a ação: <b>" . Check::UserLogin()['user_name'] . " " . Check::UserLogin()['user_lastname'] . "</b>."
                . "<br>"
                . "Att, Equipe de Ti<br>"
                . "Qualquer dúvida, entre em contato com o CPD<br>"
                . "Favor verificar o FAST-EXAMES<br>";

        $this->enviarMensagem($Contato);
    }

    private function MensagemCadastra($insert) {
        $Contato['Assunto'] = "Mensagem automatica FAST_EXAMES";
        $Contato['DestinoNome'] = MAILNAME;
        $Contato['DestinoEmail'] = "cpd@tommasi.com.br";
        $Contato['RemetenteEmail'] = Check::UserLogin()['user_email'];
        $Contato['RemetenteNome'] = Check::UserLogin()['user_name'] . " " . Check::UserLogin()['user_lastname'];
        $Contato['Mensagem'] = "Olá<br>"
                . "Temos um exame que precisa de atenção <b>{$this->Data['ex_descricao']}</b><br>"
                . "<b>{$this->Acao($this->Data['fe_acoes'])}</b><br>"
                . "Solicitado por: <b>" . Check::UserLogin()['user_name'] . " " . Check::UserLogin()['user_lastname'] . "</b>"
                . "<hr>"
                . ($insert ? "Exame gravado com sucesso!" : "Tentativa falha de registrar esta alteração!")
                . "Favor verificar o FAST-EXAMES<br>";

        $this->enviarMensagem($Contato);
    }

    private function enviarMensagem($Contato) {
        $SendMail = new Email;
        $SendMail->Enviar($Contato);
        if ($SendMail->getError()):
            WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
        endif;
    }

}
