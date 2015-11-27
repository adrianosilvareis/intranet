<?php

/**
 * FeMetodo.class.php [Beans]
 * 
 * Classe que representa a tabela fe_metodo do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class FeSetor {

    private $set_id;
    private $set_descricao;
    private $set_execucao;
    private $set_solicita;
    private $set_status;

    function __construct() {
        $this->Controle = new Controle('fe_setor');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'set_descricao' => $this->getSet_descricao(),
            'set_execucao' => $this->getSet_execucao(),
            'set_solicita' => $this->getSet_solicita(),
            'set_status' => $this->getSet_status(),
            'set_id' => $this->getSet_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setSet_id((isset($object->set_id) ? $object->set_id : null));
        $this->setSet_status((isset($object->set_status) ? $object->set_status : null));
        $this->setSet_execucao((isset($object->set_execucao) ? $object->set_execucao : null));
        $this->setSet_solicita((isset($object->set_solicita) ? $object->set_solicita : null));
        $this->setSet_descricao((isset($object->set_descricao) ? $object->set_descricao : null));
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
    function getSet_id() {
        return $this->set_id;
    }

    function getSet_descricao() {
        return $this->set_descricao;
    }

    function getSet_execucao() {
        return $this->set_execucao;
    }

    function getSet_solicita() {
        return $this->set_solicita;
    }

    function getSet_status() {
        return $this->set_status;
    }

    function setSet_id($set_id) {
        $this->set_id = $set_id;
    }

    function setSet_descricao($set_descricao) {
        $this->set_descricao = $set_descricao;
    }

    function setSet_execucao($set_execucao) {
        $this->set_execucao = $set_execucao;
    }

    function setSet_solicita($set_solicita) {
        $this->set_solicita = $set_solicita;
    }

    function setSet_status($set_status) {
        $this->set_status = $set_status;
    }

}
