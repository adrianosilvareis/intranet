<?php

/**
 * FeExames.class.php [Beans]
 * 
 * Classe que representa a tabela fe_exames do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class FeExames extends Beans {

    private $ex_id;
    private $ex_descricao;
    private $ex_sinonimia;
    private $ex_unidade;
    private $ex_valor_referencia;
    private $ex_prazo;
    private $ex_info_coleta;
    private $ex_info_interferentes;
    private $ex_info_encaminhamento;
    private $ex_valor;
    private $ex_status;
    private $ex_data_abertura;
    private $ex_data_fechamento;
    private $ex_paciente_os;
    private $ws_users;
    private $fe_setor_soli;
    private $fe_setor_exec;
    private $fe_metodo;
    private $fe_material;

    function __construct() {
        $this->Controle = new Controle('fe_exames');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'ex_descricao' => $this->getEx_descricao(),
            'ex_sinonimia' => $this->getEx_sinonimia(),
            'ex_unidade' => $this->getEx_unidade(),
            'ex_valor_referencia' => $this->getEx_valor_referencia(),
            'ex_prazo' => $this->getEx_prazo(),
            'ex_info_coleta' => $this->getEx_info_coleta(),
            'ex_info_interferentes' => $this->getEx_info_interferentes(),
            'ex_info_encaminhamento' => $this->getEx_info_encaminhamento(),
            'ex_valor' => $this->getEx_valor(),
            'ex_status' => $this->getEx_status(),
            'ex_data_abertura' => $this->getEx_data_abertura(),
            'ex_data_fechamento' => $this->getEx_data_fechamento(),
            'ex_paciente_os' => $this->getEx_paciente_os(),
            'ws_users' => $this->getWs_users(),
            'fe_setor_soli' => $this->getFe_setor_soli(),
            'fe_setor_exec' => $this->getFe_setor_exec(),
            'fe_metodo' => $this->getFe_metodo(),
            'fe_material' => $this->getFe_material(),
            'ex_id' => $this->getEx_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setEx_id((isset($object->ex_id) ? $object->ex_id : null));
        $this->setEx_material((isset($object->ex_material) ? $object->ex_material : null));
        $this->setEx_descricao((isset($object->ex_descricao) ? $object->ex_descricao : null));
        $this->setEx_sinonimia((isset($object->ex_sinonimia) ? $object->ex_sinonimia : null));
        $this->setEx_unidade((isset($object->ex_unidade) ? $object->ex_unidade : null));
        $this->setEx_valor_referencia((isset($object->ex_valor_referencia) ? $object->ex_valor_referencia : null));
        $this->setEx_metodo((isset($object->ex_metodo) ? $object->ex_metodo : null));
        $this->setEx_prazo((isset($object->ex_prazo) ? $object->ex_prazo : null));
        $this->setEx_info_coleta((isset($object->ex_info_coleta) ? $object->ex_info_coleta : null));
        $this->setEx_info_interferentes((isset($object->ex_info_interferentes) ? $object->ex_info_interferentes : null));
        $this->setEx_info_encaminhamento((isset($object->ex_info_encaminhamento) ? $object->ex_info_encaminhamento : null));
        $this->setEx_valor((isset($object->ex_valor) ? $object->ex_valor : null));
        $this->setEx_status((isset($object->ex_status) ? $object->ex_status : null));
        $this->setEx_data_abertura((isset($object->ex_data_abertura) ? $object->ex_data_abertura : null));
        $this->setEx_data_fechamento((isset($object->ex_data_fechamento) ? $object->ex_data_fechamento : null));
        $this->setEx_paciente_os((isset($object->ex_paciente_os) ? $object->ex_paciente_os : null));
        $this->setEx_assinatura((isset($object->ex_assinatura) ? $object->ex_assinatura : null));
        $this->setEx_solicitante((isset($object->ex_solicitante) ? $object->ex_solicitante : null));
        $this->setEx_setor_execucao((isset($object->ex_setor_execucao) ? $object->ex_setor_execucao : null));
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
    
    function getEx_id() {
        return $this->ex_id;
    }

    function getEx_descricao() {
        return $this->ex_descricao;
    }

    function getEx_sinonimia() {
        return $this->ex_sinonimia;
    }

    function getEx_unidade() {
        return $this->ex_unidade;
    }

    function getEx_valor_referencia() {
        return $this->ex_valor_referencia;
    }

    function getEx_prazo() {
        return $this->ex_prazo;
    }

    function getEx_info_coleta() {
        return $this->ex_info_coleta;
    }

    function getEx_info_interferentes() {
        return $this->ex_info_interferentes;
    }

    function getEx_info_encaminhamento() {
        return $this->ex_info_encaminhamento;
    }

    function getEx_valor() {
        return $this->ex_valor;
    }

    function getEx_status() {
        return $this->ex_status;
    }

    function getEx_data_abertura() {
        return $this->ex_data_abertura;
    }

    function getEx_data_fechamento() {
        return $this->ex_data_fechamento;
    }

    function getEx_paciente_os() {
        return $this->ex_paciente_os;
    }

    function getWs_users() {
        return $this->ws_users;
    }

    function getFe_setor_soli() {
        return $this->fe_setor_soli;
    }

    function getFe_setor_exec() {
        return $this->fe_setor_exec;
    }

    function getFe_metodo() {
        return $this->fe_metodo;
    }

    function getFe_material() {
        return $this->fe_material;
    }

    function setEx_id($ex_id) {
        $this->ex_id = $ex_id;
    }

    function setEx_descricao($ex_descricao) {
        $this->ex_descricao = $ex_descricao;
    }

    function setEx_sinonimia($ex_sinonimia) {
        $this->ex_sinonimia = $ex_sinonimia;
    }

    function setEx_unidade($ex_unidade) {
        $this->ex_unidade = $ex_unidade;
    }

    function setEx_valor_referencia($ex_valor_referencia) {
        $this->ex_valor_referencia = $ex_valor_referencia;
    }

    function setEx_prazo($ex_prazo) {
        $this->ex_prazo = $ex_prazo;
    }

    function setEx_info_coleta($ex_info_coleta) {
        $this->ex_info_coleta = $ex_info_coleta;
    }

    function setEx_info_interferentes($ex_info_interferentes) {
        $this->ex_info_interferentes = $ex_info_interferentes;
    }

    function setEx_info_encaminhamento($ex_info_encaminhamento) {
        $this->ex_info_encaminhamento = $ex_info_encaminhamento;
    }

    function setEx_valor($ex_valor) {
        $this->ex_valor = $ex_valor;
    }

    function setEx_status($ex_status) {
        $this->ex_status = $ex_status;
    }

    function setEx_data_abertura($ex_data_abertura) {
        $this->ex_data_abertura = $ex_data_abertura;
    }

    function setEx_data_fechamento($ex_data_fechamento) {
        $this->ex_data_fechamento = $ex_data_fechamento;
    }

    function setEx_paciente_os($ex_paciente_os) {
        $this->ex_paciente_os = $ex_paciente_os;
    }

    function setWs_users($ws_users) {
        $this->ws_users = $ws_users;
    }

    function setFe_setor_soli($fe_setor_soli) {
        $this->fe_setor_soli = $fe_setor_soli;
    }

    function setFe_setor_exec($fe_setor_exec) {
        $this->fe_setor_exec = $fe_setor_exec;
    }

    function setFe_metodo($fe_metodo) {
        $this->fe_metodo = $fe_metodo;
    }

    function setFe_material($fe_material) {
        $this->fe_material = $fe_material;
    }



}
