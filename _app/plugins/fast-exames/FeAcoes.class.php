<?php

/**
 * FeAcoes.class.php [Beans]
 * 
 * Classe que representa a tabela fe_acoes do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class FeAcoes extends Beans {

    private $acao_id;
    private $acao_descricao;
    private $acao_status;

    function __construct() {
        $this->Controle = new Controle('fe_acoes');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'acao_descricao' => $this->getAcao_descricao(),
            'acao_status' => $this->getAcao_status(),
            'acao_id' => $this->getAcao_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setAcao_id((isset($object->acao_id) ? $object->acao_id : null));
        $this->setAcao_descricao((isset($object->acao_descricao) ? $object->acao_descricao : null));
        $this->setAcao_status((isset($object->acao_status) ? $object->acao_status : null));
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
    function getAcao_id() {
        return $this->acao_id;
    }

    function getAcao_descricao() {
        return $this->acao_descricao;
    }

    function getAcao_status() {
        return $this->acao_status;
    }

    function setAcao_id($acao_id) {
        $this->acao_id = $acao_id;
    }

    function setAcao_descricao($acao_descricao) {
        $this->acao_descricao = $acao_descricao;
    }

    function setAcao_status($acao_status) {
        $this->acao_status = $acao_status;
    }

}
