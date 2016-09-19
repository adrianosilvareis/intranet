<?php

/**
 * PeTipo.class.php [Beans]
 * 
 * Classe que representa a tabela pe_tipo do banco de dados
 * 
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class PeTipo {

    private $tipo_id;
    private $tipo_title;
    private $tipo_content;
    private $tipo_status;
    private $tipo_date;
    private $meta_id;
    private $autor_id;

    function __construct() {
        $this->Controle = new Controle('pe_tipo');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'tipo_title' => $this->getTipo_title(),
            'tipo_content' => $this->getTipo_content(),
            'tipo_status' => $this->getTipo_status(),
            'tipo_date' => $this->getTipo_date(),
            'autor_id' => $this->getAutor_id(),
            'meta_id' => $this->getMeta_id(),
            'tipo_id' => $this->getTipo_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setTipo_id((isset($object->tipo_id) ? $object->tipo_id : null));
        $this->setTipo_title((isset($object->tipo_title) ? $object->tipo_title : null));
        $this->setTipo_content((isset($object->tipo_content) ? $object->tipo_content : null));
        $this->setTipo_status((isset($object->tipo_status) ? $object->tipo_status : null));
        $this->setTipo_date((isset($object->tipo_date) ? $object->tipo_date : null));
        $this->setMeta_id((isset($object->meta_id) ? $object->meta_id : null));
        $this->setAutor_id((isset($object->autor_id) ? $object->autor_id : null));
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
    function getTipo_id() {
        return $this->tipo_id;
    }

    function getTipo_title() {
        return $this->tipo_title;
    }

    function getTipo_content() {
        return $this->tipo_content;
    }

    function getTipo_status() {
        return $this->tipo_status;
    }

    function getTipo_date() {
        return $this->tipo_date;
    }

    function getMeta_id() {
        return $this->meta_id;
    }

    function getAutor_id() {
        return $this->autor_id;
    }

    function setTipo_id($tipo_id) {
        $this->tipo_id = $tipo_id;
    }

    function setTipo_title($tipo_title) {
        $this->tipo_title = $tipo_title;
    }

    function setTipo_content($tipo_content) {
        $this->tipo_content = $tipo_content;
    }

    function setTipo_status($tipo_status) {
        $this->tipo_status = $tipo_status;
    }

    function setTipo_date($tipo_date) {
        $this->tipo_date = $tipo_date;
    }

    function setMeta_id($meta_id) {
        $this->meta_id = $meta_id;
    }

    function setAutor_id($autor_id) {
        $this->autor_id = $autor_id;
    }


}
