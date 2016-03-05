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
    private $ex_minemonico;
    private $ex_unidade;
    private $ex_prazo;
    private $ex_valor;
    private $ex_status;
    private $ex_cancelado;
    private $ex_data_abertura;
    private $ex_data_fechamento;
    private $ex_paciente_os;
    private $ex_observacao;
    private $fe_material;
    private $fe_acoes;
    private $ws_users;
    private $ws_users_soli;
    private $ws_setor_soli;
    private $ws_setor_exec;

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
            'ex_minemonico' => $this->getEx_minemonico(),
            'ex_unidade' => $this->getEx_unidade(),
            'ex_prazo' => $this->getEx_prazo(),
            'ex_valor' => $this->getEx_valor(),
            'ex_status' => $this->getEx_status(),
            'ex_cancelado' => $this->getEx_cancelado(),
            'ex_data_abertura' => $this->getEx_data_abertura(),
            'ex_data_fechamento' => $this->getEx_data_fechamento(),
            'ex_paciente_os' => $this->getEx_paciente_os(),
            'ex_observacao' => $this->getEx_observacao(),
            'fe_material' => $this->getFe_material(),
            'fe_acoes' => $this->getFe_acoes(),
            'ws_users' => $this->getWs_users(),
            'ws_users_soli' => $this->getWs_users_soli(),
            'ws_setor_soli' => $this->getWs_setor_soli(),
            'ws_setor_exec' => $this->getWs_setor_exec(),
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
        $this->setEx_descricao((isset($object->ex_descricao) ? $object->ex_descricao : null));
        $this->setEx_minemonico((isset($object->ex_minemonico) ? $object->ex_minemonico : null));
        $this->setEx_unidade((isset($object->ex_unidade) ? $object->ex_unidade : null));
        $this->setEx_prazo((isset($object->ex_prazo) ? $object->ex_prazo : null));
        $this->setEx_valor((isset($object->ex_valor) ? $object->ex_valor : null));
        $this->setEx_status((isset($object->ex_status) ? $object->ex_status : null));
        $this->setEx_cancelado((isset($object->ex_cancelado) ? $object->ex_cancelado : null));
        $this->setEx_data_abertura((isset($object->ex_data_abertura) ? $object->ex_data_abertura : null));
        $this->setEx_data_fechamento((isset($object->ex_data_fechamento) ? $object->ex_data_fechamento : null));
        $this->setEx_paciente_os((isset($object->ex_paciente_os) ? $object->ex_paciente_os : null));
        $this->setEx_observacao((isset($object->ex_observacao) ? $object->ex_observacao : null));
        $this->setFe_material((isset($object->fe_material) ? $object->fe_material : null));
        $this->setFe_acoes((isset($object->fe_acoes) ? $object->fe_acoes : null));
        $this->setWs_users((isset($object->ws_users) ? $object->ws_users : null));
        $this->setWs_users_soli((isset($object->ws_users_soli) ? $object->ws_users_soli : null));
        $this->setWs_setor_soli((isset($object->ws_setor_soli) ? $object->ws_setor_soli : null));
        $this->setWs_setor_exec((isset($object->ws_setor_exec) ? $object->ws_setor_exec : null));
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

    function getEx_minemonico() {
        return $this->ex_minemonico;
    }

    function getEx_unidade() {
        return $this->ex_unidade;
    }

    function getEx_prazo() {
        return $this->ex_prazo;
    }

    function getEx_valor() {
        return $this->ex_valor;
    }

    function getEx_status() {
        return $this->ex_status;
    }

    function getEx_cancelado() {
        return $this->ex_cancelado;
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

    function getEx_observacao() {
        return $this->ex_observacao;
    }

    function getFe_material() {
        return $this->fe_material;
    }

    function getFe_acoes() {
        return $this->fe_acoes;
    }

    function getWs_users() {
        return $this->ws_users;
    }

    function getWs_users_soli() {
        return $this->ws_users_soli;
    }

    function getWs_setor_soli() {
        return $this->ws_setor_soli;
    }

    function getWs_setor_exec() {
        return $this->ws_setor_exec;
    }

    function setEx_id($ex_id) {
        $this->ex_id = $ex_id;
    }

    function setEx_descricao($ex_descricao) {
        $this->ex_descricao = $ex_descricao;
    }

    function setEx_minemonico($ex_minemonico) {
        $this->ex_minemonico = $ex_minemonico;
    }

    function setEx_unidade($ex_unidade) {
        $this->ex_unidade = $ex_unidade;
    }

    function setEx_prazo($ex_prazo) {
        $this->ex_prazo = $ex_prazo;
    }

    function setEx_valor($ex_valor) {
        $this->ex_valor = $ex_valor;
    }

    function setEx_status($ex_status) {
        $this->ex_status = $ex_status;
    }

    function setEx_cancelado($ex_cancelado) {
        $this->ex_cancelado = $ex_cancelado;
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

    function setEx_observacao($ex_observacao) {
        $this->ex_observacao = $ex_observacao;
    }

    function setFe_material($fe_material) {
        $this->fe_material = $fe_material;
    }

    function setFe_acoes($fe_acoes) {
        $this->fe_acoes = $fe_acoes;
    }

    function setWs_users($ws_users) {
        $this->ws_users = $ws_users;
    }

    function setWs_users_soli($ws_users_soli) {
        $this->ws_users_soli = $ws_users_soli;
    }

    function setWs_setor_soli($ws_setor_soli) {
        $this->ws_setor_soli = $ws_setor_soli;
    }

    function setWs_setor_exec($ws_setor_exec) {
        $this->ws_setor_exec = $ws_setor_exec;
    }


}
