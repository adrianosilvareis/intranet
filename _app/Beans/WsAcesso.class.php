<?php

/**
 * WsAcesso.class.php [Beans]
 * 
 * Classe que representa a tabela ws_acesso do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class WsAcesso extends Beans {

    private $acesso_id;
    private $acesso_parent;
    private $acesso_title;
    private $acesso_content;
    private $acesso_name;
    private $acesso_status;
    private $acesso_date;
    private $acesso_tag;

    function __construct() {
        $this->Controle = new Controle('ws_acesso');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'acesso_parent' => $this->getAcesso_parent(),
            'acesso_title' => $this->getAcesso_title(),
            'acesso_content' => $this->getAcesso_content(),
            'acesso_name' => $this->getAcesso_name(),
            'acesso_status' => $this->getAcesso_status(),
            'acesso_date' => $this->getAcesso_date(),
            'acesso_tag' => $this->getAcesso_tag(),
            'acesso_id' => $this->getAcesso_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setAcesso_id((isset($object->acesso_id) ? $object->acesso_id : null));
        $this->setAcesso_parent((isset($object->acesso_parent) ? $object->acesso_parent : null));
        $this->setAcesso_title((isset($object->acesso_title) ? $object->acesso_title : null));
        $this->setAcesso_content((isset($object->acesso_content) ? $object->acesso_content : null));
        $this->setAcesso_name((isset($object->acesso_name) ? $object->acesso_name : null));
        $this->setAcesso_status((isset($object->acesso_status) ? $this->acesso_status : null));
        $this->setAcesso_date((isset($object->acesso_date) ? $object->acesso_date : null));
        $this->setAcesso_tag((isset($object->acesso_tag) ? $object->acesso_tag : null));
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
    function getAcesso_id() {
        return $this->acesso_id;
    }

    function getAcesso_parent() {
        return $this->acesso_parent;
    }

    function getAcesso_title() {
        return $this->acesso_title;
    }

    function getAcesso_content() {
        return $this->acesso_content;
    }

    function getAcesso_name() {
        return $this->acesso_name;
    }

    function getAcesso_status() {
        if (isset($this->acesso_status)):
            $this->acesso_status = ($this->acesso_status ? '1' : 'false');
        endif;
        return $this->acesso_status;
    }

    function getAcesso_date() {
        return $this->acesso_date;
    }

    function getAcesso_tag() {
        return $this->acesso_tag;
    }

    function setAcesso_id($acesso_id) {
        $this->acesso_id = $acesso_id;
    }

    function setAcesso_parent($acesso_parent) {
        $this->acesso_parent = $acesso_parent;
    }

    function setAcesso_title($acesso_title) {
        $this->acesso_title = $acesso_title;
    }

    function setAcesso_content($acesso_content) {
        $this->acesso_content = $acesso_content;
    }

    function setAcesso_name($acesso_name) {
        $this->acesso_name = $acesso_name;
    }

    function setAcesso_status($acesso_status) {
        $this->acesso_status = $acesso_status;
    }

    function setAcesso_date($acesso_date) {
        $this->acesso_date = $acesso_date;
    }

    function setAcesso_tag($acesso_tag) {
        $this->acesso_tag = $acesso_tag;
    }

}
