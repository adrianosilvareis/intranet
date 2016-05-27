<?php

/**
 * WsPerfil.class.php [Beans]
 * 
 * Classe que representa a tabela ws_perfil do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class WsPerfil extends Beans {

    private $perfil_id;
    private $perfil_name;
    private $perfil_title;
    private $perfil_content;
    private $perfil_status;
    private $perfil_date;

    function __construct() {
        $this->Controle = new Controle('ws_perfil');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'perfil_name' => $this->getPerfil_name(),
            'perfil_title' => $this->getPerfil_title(),
            'perfil_content' => $this->getPerfil_content(),
            'perfil_status' => $this->getPerfil_status(),
            'perfil_date' => $this->getPerfil_date(),
            'perfil_id' => $this->getPerfil_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setPerfil_id((isset($object->perfil_id) ? $object->perfil_id : null));
        $this->setPerfil_name((isset($object->perfil_name) ? $object->perfil_name : null));
        $this->setPerfil_title((isset($object->perfil_title) ? $object->perfil_title : null));
        $this->setPerfil_content((isset($object->perfil_content) ? $object->perfil_content : null));
        $this->setPerfil_status((isset($object->perfil_status) ? $object->perfil_status : null));
        $this->setPerfil_date((isset($object->perfil_date) ? $object->perfil_date : null));
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
    function getPerfil_id() {
        return $this->perfil_id;
    }

    function getPerfil_name() {
        return $this->perfil_name;
    }

    function getPerfil_title() {
        return $this->perfil_title;
    }

    function getPerfil_content() {
        return $this->perfil_content;
    }

    function getPerfil_status() {
        return $this->perfil_status;
    }

    function getPerfil_date() {
        return $this->perfil_date;
    }

    function setPerfil_id($perfil_id) {
        $this->perfil_id = $perfil_id;
    }

    function setPerfil_name($perfil_name) {
        $this->perfil_name = $perfil_name;
    }

    function setPerfil_title($perfil_title) {
        $this->perfil_title = $perfil_title;
    }

    function setPerfil_content($perfil_content) {
        $this->perfil_content = $perfil_content;
    }

    function setPerfil_status($perfil_status) {
        $this->perfil_status = $perfil_status;
    }

    function setPerfil_date($perfil_date) {
        $this->perfil_date = $perfil_date;
    }


}
