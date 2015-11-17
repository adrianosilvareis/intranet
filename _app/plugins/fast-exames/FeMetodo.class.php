<?php

/**
 * FeMetodo.class.php [Beans]
 * 
 * Classe que representa a tabela fe_metodo do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class FeMetodo extends Beans {

    private $met_id;
    private $met_descricao;
    private $met_status;

    function __construct() {
        $this->Controle = new Controle('fe_metodo');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'met_descricao' => $this->getMet_descricao(),
            'met_status' => $this->getMet_status(),
            'met_id' => $this->getMet_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setMet_id((isset($object->met_id) ? $object->met_id : null));
        $this->setMet_status((isset($object->met_status) ? $object->met_status : null));
        $this->setMet_descricao((isset($object->met_descricao) ? $object->met_descricao : null));
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
    function getMet_id() {
        return $this->met_id;
    }

    function getMet_descricao() {
        return $this->met_descricao;
    }

    function getMet_status() {
        return $this->met_status;
    }

    function setMet_id($met_id) {
        $this->met_id = $met_id;
    }

    function setMet_descricao($met_descricao) {
        $this->met_descricao = $met_descricao;
    }

    function setMet_status($met_status) {
        $this->met_status = $met_status;
    }

}
