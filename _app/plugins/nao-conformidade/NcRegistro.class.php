<?php

/**
 * NcRegistro.class.php [Beans]
 * 
 * Classe que representa a tabela nc_registro do banco de dados
 * 
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class NcRegistro {

    private $reg_id; //INT AUTO_INCREMENT
    private $reg_descricao; //VARCHAR(255)
    private $reg_impacto_paciente; //BOOLEAN
    private $reg_origem_outros; //VARCHAR(255),
    private $reg_correcao_imediata; //VARCHAR(500),
    private $reg_user_correcao; // VARCHAR(255),
    private $reg_aval_processo; // VARCHAR(500),
    private $reg_aval_material; // VARCHAR(500),
    private $reg_aval_pessoas; // VARCHAR(500),
    private $reg_aval_equipamento; // VARCHAR(500),
    private $reg_aval_ambiente; // VARCHAR(500),
    private $reg_aval_outros; // VARCHAR(500),
    private $reg_causa; // VARCHAR(500),
    private $reg_date_ocorrencia; // TIMESTAMP DEFAULT 0 NOT NULL,
    private $reg_date_correcao; // TIMESTAMP DEFAULT 0 NOT NULL,
    private $reg_date_resposta; // TIMESTAMP DEFAULT 0 NOT NULL,
    private $reg_date_cadastro; // TIMESTAMP DEFAULT 0 NOT NULL,
    private $reg_date_lastupdate; // TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    private $user_cadastro; // INT,
    private $user_recebimento; // INT,
    private $user_avaliacao; // INT,

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
            'origem_descricao' => $this->getOrigem_descricao(),
            'origem_ativo' => $this->getOrigem_ativo(),
            'origem_id' => $this->getOrigem_id()
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
        $this->setReg_aval_material((isset($object->reg_aval_material) ? $object->reg_aval_material : null));
        $this->setReg_aval_pessoas((isset($object->reg_aval_pessoas) ? $object->reg_aval_pessoas : null));
        $this->setReg_aval_equipamento((isset($object->reg_aval_equipamento) ? $object->reg_aval_equipamento : null));
        $this->setReg_aval_ambiente((isset($object->reg_aval_ambiente) ? $object->reg_aval_ambiente : null));
        $this->setReg_aval_outros((isset($object->reg_aval_outros) ? $object->reg_aval_outros : null));
        $this->setReg_causa((isset($object->reg_causa) ? $object->reg_causa : null));
        $this->setReg_date_lastupdate((isset($object->reg_date_lastupdate) ? $object->reg_date_lastupdate : null));
        $this->setReg_date_ocorrencia((isset($object->reg_date_ocorrencia) ? $object->reg_date_ocorrencia : null));
        $this->setReg_date_correcao((isset($object->reg_date_correcao) ? $object->reg_date_correcao : null));
        $this->setReg_date_resposta((isset($object->reg_date_resposta) ? $object->reg_date_resposta : null));
        $this->setReg_date_cadastro((isset($object->reg_date_cadastro) ? $object->reg_date_cadastro : null));
        $this->setUser_cadastro((isset($object->user_cadastro) ? $object->user_cadastro : null));
        $this->setUser_recebimento((isset($object->user_recebimento) ? $object->user_recebimento : null));
        $this->setUser_avaliacao((isset($object->user_avaliacao) ? $object->user_avaliacao : null));
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

    function getReg_aval_material() {
        return $this->reg_aval_material;
    }

    function getReg_aval_pessoas() {
        return $this->reg_aval_pessoas;
    }

    function getReg_aval_equipamento() {
        return $this->reg_aval_equipamento;
    }

    function getReg_aval_ambiente() {
        return $this->reg_aval_ambiente;
    }

    function getReg_aval_outros() {
        return $this->reg_aval_outros;
    }

    function getReg_causa() {
        return $this->reg_causa;
    }

    function getReg_date_ocorrencia() {
        return $this->reg_date_ocorrencia;
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

    function getUser_cadastro() {
        return $this->user_cadastro;
    }

    function getUser_recebimento() {
        return $this->user_recebimento;
    }

    function getUser_avaliacao() {
        return $this->user_avaliacao;
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

    function setReg_aval_material($reg_aval_material) {
        $this->reg_aval_material = $reg_aval_material;
    }

    function setReg_aval_pessoas($reg_aval_pessoas) {
        $this->reg_aval_pessoas = $reg_aval_pessoas;
    }

    function setReg_aval_equipamento($reg_aval_equipamento) {
        $this->reg_aval_equipamento = $reg_aval_equipamento;
    }

    function setReg_aval_ambiente($reg_aval_ambiente) {
        $this->reg_aval_ambiente = $reg_aval_ambiente;
    }

    function setReg_aval_outros($reg_aval_outros) {
        $this->reg_aval_outros = $reg_aval_outros;
    }

    function setReg_causa($reg_causa) {
        $this->reg_causa = $reg_causa;
    }

    function setReg_date_ocorrencia($reg_date_ocorrencia) {
        $this->reg_date_ocorrencia = $reg_date_ocorrencia;
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

    function setUser_cadastro($user_cadastro) {
        $this->user_cadastro = $user_cadastro;
    }

    function setUser_recebimento($user_recebimento) {
        $this->user_recebimento = $user_recebimento;
    }

    function setUser_avaliacao($user_avaliacao) {
        $this->user_avaliacao = $user_avaliacao;
    }

}
