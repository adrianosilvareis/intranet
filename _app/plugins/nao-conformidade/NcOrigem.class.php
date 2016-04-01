<?php

/**
 * NcOrigem.class.php [Beans]
 * 
 * Classe que representa a tabela nc_origem do banco de dados
 * 
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class NcOrigem {

    private $origem_id;
    private $origem_title;
    private $origem_status;

    function __construct() {
        $this->Controle = new Controle('nc_origem');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'origem_title' => $this->getOrigem_title(),
            'origem_status' => $this->getOrigem_status(),
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
        $this->setOrigem_id((isset($object->origem_id) ? $object->origem_id : null));
        $this->setOrigem_status((isset($object->origem_status) ? $object->origem_status : null));
        $this->setOrigem_title((isset($object->origem_title) ? $object->origem_title : null));
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
    function getOrigem_id() {
        return $this->origem_id;
    }

    function getOrigem_title() {
        return $this->origem_title;
    }

    function getOrigem_status() {
        return $this->origem_status;
    }

    function setOrigem_id($origem_id) {
        $this->origem_id = $origem_id;
    }

    function setOrigem_title($origem_title) {
        $this->origem_title = $origem_title;
    }

    function setOrigem_status($origem_status) {
        $this->origem_status = $origem_status;
    }

}
