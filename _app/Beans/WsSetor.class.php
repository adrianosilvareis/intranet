<?php

/**
 * WsSetor.class.php [Beans]
 * 
 * Classe que representa a tabela ws_setor do banco de dados
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class WsSetor extends Beans {

    private $setor_id;
    private $setor_content;
    private $setor_status;
    private $setor_email;
    private $setor_type;
    private $setor_category;
    private $setor_date;

    function __construct() {
        $this->Controle = new Controle('ws_setor');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'setor_content' => $this->getSetor_content(),
            'setor_status' => $this->getSetor_status(),
            'setor_email' => $this->getSetor_email(),
            'setor_type' => $this->getSetor_type(),
            'setor_category' => $this->getSetor_category(),
            'setor_date' => $this->getSetor_date(),
            'setor_id' => $this->getSetor_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setSetor_id((isset($object->setor_id) ? $object->setor_id : null));
        $this->setSetor_content((isset($object->setor_content) ? $object->setor_content : null));
        $this->setSetor_status((isset($object->setor_status) ? $object->setor_status : null));
        $this->setSetor_email((isset($object->setor_email) ? $object->setor_email : null));
        $this->setSetor_type((isset($object->setor_type) ? $object->setor_type : null));
        $this->setSetor_category((isset($object->setor_category) ? $object->setor_category : null));
        $this->setSetor_date((isset($object->setor_date) ? $object->setor_date : null));
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
    function getSetor_id() {
        return $this->setor_id;
    }

    function getSetor_content() {
        return $this->setor_content;
    }

    function getSetor_status() {
        return $this->setor_status;
    }

    function getSetor_email() {
        return $this->setor_email;
    }

    function getSetor_type() {
        return $this->setor_type;
    }

    function getSetor_category() {
        return $this->setor_category;
    }

    function getSetor_date() {
        return $this->setor_date;
    }

    function setSetor_id($setor_id) {
        $this->setor_id = $setor_id;
    }

    function setSetor_content($setor_content) {
        $this->setor_content = $setor_content;
    }

    function setSetor_status($setor_status) {
        $this->setor_status = $setor_status;
    }

    function setSetor_email($setor_email) {
        $this->setor_email = $setor_email;
    }

    function setSetor_type($setor_type) {
        $this->setor_type = $setor_type;
    }

    function setSetor_category($setor_category) {
        $this->setor_category = $setor_category;
    }

    function setSetor_date($setor_date) {
        $this->setor_date = $setor_date;
    }

}
