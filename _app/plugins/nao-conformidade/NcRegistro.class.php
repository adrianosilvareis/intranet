<?php

/**
 * NcRegistro.class.php [Beans]
 * 
 * Classe que representa a tabela nc_registro do banco de dados
 * 
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class NcRegistro {

    private $reg_id;
    private $reg_descricao;
    private $reg_impacto_paciente;
    private $reg_origem_outros;
    private $reg_correcao_imediata;
    private $reg_user_correcao;
    private $reg_aval_processo;
    private $reg_aval_materia_prima;
    private $reg_aval_mao_obra;
    private $reg_aval_equipamento;
    private $reg_aval_meio_ambiente;
    private $reg_aval_outros;
    private $reg_causa_principal;
    private $reg_date_lastupdate;
    private $reg_date_correcao;
    private $reg_date_resposta;
    private $reg_date_cadastro;
    private $reg_acao_corretiva;
    private $reg_finalizado;
    private $user_lastupdate;
    private $user_cadastro;
    private $user_recebimento;
    private $area_recebimento;

    function __construct() {
        $this->Controle = new Controle('nc_registro');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'reg_descricao' => $this->getReg_descricao(),
            'reg_impacto_paciente' => $this->getReg_impacto_paciente(),
            'reg_origem_outros' => $this->getReg_origem_outros(),
            'reg_correcao_imediata' => $this->getReg_correcao_imediata(),
            'reg_user_correcao' => $this->getReg_user_correcao(),
            'reg_aval_processo' => $this->getReg_aval_processo(),
            'reg_aval_materia_prima' => $this->getReg_aval_materia_prima(),
            'reg_aval_mao_obra' => $this->getReg_aval_mao_obra(),
            'reg_aval_equipamento' => $this->getReg_aval_equipamento(),
            'reg_aval_meio_ambiente' => $this->getReg_aval_meio_ambiente(),
            'reg_aval_outros' => $this->getReg_aval_outros(),
            'reg_causa_principal' => $this->getReg_causa_principal(),
            'reg_date_correcao' => $this->getReg_date_correcao(),
            'reg_date_resposta' => $this->getReg_date_resposta(),
            'reg_date_cadastro' => $this->getReg_date_cadastro(),
            'reg_date_lastupdate' => $this->getReg_date_lastupdate(),
            'reg_acao_corretiva' => $this->getReg_acao_corretiva(),
            'reg_finalizado' => $this->getReg_finalizado(),
            'user_lastupdate' => $this->getUser_lastupdate(),
            'user_cadastro' => $this->getUser_cadastro(),
            'user_recebimento' => $this->getUser_recebimento(),
            'area_recebimento' => $this->getArea_recebimento(),
            'reg_id' => $this->getReg_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setReg_id((isset($object->reg_id) ? $object->reg_id : null));
        $this->setReg_descricao((isset($object->reg_descricao) ? $object->reg_descricao : null));
        $this->setReg_impacto_paciente((isset($object->reg_impacto_paciente) ? $object->reg_impacto_paciente : null));
        $this->setReg_origem_outros((isset($object->reg_origem_outros) ? $object->reg_origem_outros : null));
        $this->setReg_correcao_imediata((isset($object->reg_correcao_imediata) ? $object->reg_correcao_imediata : null));
        $this->setReg_user_correcao((isset($object->reg_user_correcao) ? $object->reg_user_correcao : null));
        $this->setReg_aval_processo((isset($object->reg_aval_processo) ? $object->reg_aval_processo : null));
        $this->setReg_aval_materia_prima((isset($object->reg_aval_materia_prima) ? $object->reg_aval_materia_prima : null));
        $this->setReg_aval_mao_obra((isset($object->reg_aval_mao_obra) ? $object->reg_aval_mao_obra : null));
        $this->setReg_aval_equipamento((isset($object->reg_aval_equipamento) ? $object->reg_aval_equipamento : null));
        $this->setReg_aval_meio_ambiente((isset($object->reg_aval_meio_ambiente) ? $object->reg_aval_meio_ambiente : null));
        $this->setReg_aval_outros((isset($object->reg_aval_outros) ? $object->reg_aval_outros : null));
        $this->setReg_causa_principal((isset($object->reg_causa_principal) ? $object->reg_causa_principal : null));
        $this->setReg_date_lastupdate((isset($object->reg_date_lastupdate) ? $object->reg_date_lastupdate : null));
        $this->setReg_date_correcao((isset($object->reg_date_correcao) ? $object->reg_date_correcao : null));
        $this->setReg_date_resposta((isset($object->reg_date_resposta) ? $object->reg_date_resposta : null));
        $this->setReg_date_cadastro((isset($object->reg_date_cadastro) ? $object->reg_date_cadastro : null));
        $this->setReg_acao_corretiva((isset($object->reg_acao_corretiva) ? $object->reg_acao_corretiva : null));
        $this->setReg_finalizado((isset($object->reg_finalizado) ? $object->reg_finalizado : null));
        $this->setUser_cadastro((isset($object->user_cadastro) ? $object->user_cadastro : null));
        $this->setUser_lastupdate((isset($object->user_lastupdate) ? $object->user_lastupdate : null));
        $this->setUser_recebimento((isset($object->user_recebimento) ? $object->user_recebimento : null));
        $this->setArea_recebimento((isset($object->area_recebimento) ? $object->area_recebimento : null));
    }

    /**
     * Retorna operações de insert, update, delete, e buscas
     * 
     * @return Controle
     */
    public function Execute() {
        $this->getThis();
        return $this->Controle;
    }

    /**
     * ****************************************
     * ************** GET & SET ***************
     * ****************************************
     */
    function getReg_id() {
        return $this->reg_id;
    }

    function getReg_descricao() {
        return $this->reg_descricao;
    }

    function getReg_impacto_paciente() {
        return $this->reg_impacto_paciente;
    }

    function getReg_origem_outros() {
        return $this->reg_origem_outros;
    }

    function getReg_correcao_imediata() {
        return $this->reg_correcao_imediata;
    }

    function getReg_user_correcao() {
        return $this->reg_user_correcao;
    }

    function getReg_aval_processo() {
        return $this->reg_aval_processo;
    }

    function getReg_aval_materia_prima() {
        return $this->reg_aval_materia_prima;
    }

    function getReg_aval_mao_obra() {
        return $this->reg_aval_mao_obra;
    }

    function getReg_aval_equipamento() {
        return $this->reg_aval_equipamento;
    }

    function getReg_aval_meio_ambiente() {
        return $this->reg_aval_meio_ambiente;
    }

    function getReg_aval_outros() {
        return $this->reg_aval_outros;
    }

    function getReg_causa_principal() {
        return $this->reg_causa_principal;
    }

    function getReg_date_correcao() {
        return $this->reg_date_correcao;
    }

    function getReg_date_resposta() {
        return $this->reg_date_resposta;
    }

    function getReg_date_cadastro() {
        return $this->reg_date_cadastro;
    }

    function getReg_date_lastupdate() {
        return $this->reg_date_lastupdate;
    }

    function getReg_acao_corretiva() {
        return $this->reg_acao_corretiva;
    }

    function getReg_finalizado() {
        return $this->reg_finalizado;
    }

    function getUser_lastupdate() {
        return $this->user_lastupdate;
    }

    function getUser_cadastro() {
        return $this->user_cadastro;
    }

    function getUser_recebimento() {
        return $this->user_recebimento;
    }

    function getArea_recebimento() {
        return $this->area_recebimento;
    }

    function setReg_id($reg_id) {
        $this->reg_id = $reg_id;
    }

    function setReg_descricao($reg_descricao) {
        $this->reg_descricao = $reg_descricao;
    }

    function setReg_impacto_paciente($reg_impacto_paciente) {
        $this->reg_impacto_paciente = $reg_impacto_paciente;
    }

    function setReg_origem_outros($reg_origem_outros) {
        $this->reg_origem_outros = $reg_origem_outros;
    }

    function setReg_correcao_imediata($reg_correcao_imediata) {
        $this->reg_correcao_imediata = $reg_correcao_imediata;
    }

    function setReg_user_correcao($reg_user_correcao) {
        $this->reg_user_correcao = $reg_user_correcao;
    }

    function setReg_aval_processo($reg_aval_processo) {
        $this->reg_aval_processo = $reg_aval_processo;
    }

    function setReg_aval_materia_prima($reg_aval_materia_prima) {
        $this->reg_aval_materia_prima = $reg_aval_materia_prima;
    }

    function setReg_aval_mao_obra($reg_aval_mao_obra) {
        $this->reg_aval_mao_obra = $reg_aval_mao_obra;
    }

    function setReg_aval_equipamento($reg_aval_equipamento) {
        $this->reg_aval_equipamento = $reg_aval_equipamento;
    }

    function setReg_aval_meio_ambiente($reg_aval_meio_ambiente) {
        $this->reg_aval_meio_ambiente = $reg_aval_meio_ambiente;
    }

    function setReg_aval_outros($reg_aval_outros) {
        $this->reg_aval_outros = $reg_aval_outros;
    }

    function setReg_causa_principal($reg_causa_principal) {
        $this->reg_causa_principal = $reg_causa_principal;
    }

    function setReg_date_correcao($reg_date_correcao) {
        $this->reg_date_correcao = $reg_date_correcao;
    }

    function setReg_date_resposta($reg_date_resposta) {
        $this->reg_date_resposta = $reg_date_resposta;
    }

    function setReg_date_cadastro($reg_date_cadastro) {
        $this->reg_date_cadastro = $reg_date_cadastro;
    }

    function setReg_date_lastupdate($reg_date_lastupdate) {
        $this->reg_date_lastupdate = $reg_date_lastupdate;
    }

    function setReg_acao_corretiva($reg_acao_corretiva) {
        $this->reg_acao_corretiva = $reg_acao_corretiva;
    }

    function setReg_finalizado($reg_finalizado) {
        $this->reg_finalizado = $reg_finalizado;
    }

    function setUser_lastupdate($user_lastupdate) {
        $this->user_lastupdate = $user_lastupdate;
    }

    function setUser_cadastro($user_cadastro) {
        $this->user_cadastro = $user_cadastro;
    }

    function setUser_recebimento($user_recebimento) {
        $this->user_recebimento = $user_recebimento;
    }

    function setArea_recebimento($area_recebimento) {
        $this->area_recebimento = $area_recebimento;
    }

}
