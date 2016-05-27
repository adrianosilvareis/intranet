<?php

/**
 * WsAreaTrabalho.class.php [Beans]
 * 
 * Classe que representa a tabela ws_area_trabalho do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class WsAreaTrabalho extends Beans {
    
    private $area_id;
    private $area_title;
    private $area_content;
    private $area_status;
    private $area_email;
    private $area_date;
    private $category_id;

    function __construct() {
        $this->Controle = new Controle('ws_area_trabalho');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'area_title' => $this->getArea_title(),
            'area_content' => $this->getArea_content(),
            'area_status' => $this->getArea_status(),
            'area_email' => $this->getArea_email(),
            'area_date' => $this->getArea_date(),
            'category_id' => $this->getCategory_id(),
            'area_id' => $this->getArea_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setArea_id((isset($object->area_id) ? $object->area_id : null));
        $this->setArea_title((isset($object->area_title) ? $object->area_title : null));
        $this->setArea_content((isset($object->area_content) ? $object->area_content : null));
        $this->setArea_status((isset($object->area_status) ? $object->area_status : null));
        $this->setArea_email((isset($object->area_email) ? $object->area_email : null));
        $this->setArea_date((isset($object->area_date) ? $object->area_date : null));
        $this->setCategory_id((isset($object->category_id) ? $object->category_id : null));
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
    function getArea_id() {
        return $this->area_id;
    }

    function getArea_title() {
        return $this->area_title;
    }

    function getArea_content() {
        return $this->area_content;
    }

    function getArea_status() {
        return $this->area_status;
    }

    function getArea_email() {
        return $this->area_email;
    }

    function getArea_date() {
        return $this->area_date;
    }

    function getCategory_id() {
        return $this->category_id;
    }

    function setArea_id($area_id) {
        $this->area_id = $area_id;
    }

    function setArea_title($area_title) {
        $this->area_title = $area_title;
    }

    function setArea_content($area_content) {
        $this->area_content = $area_content;
    }

    function setArea_status($area_status) {
        $this->area_status = $area_status;
    }

    function setArea_email($area_email) {
        $this->area_email = $area_email;
    }

    function setArea_date($area_date) {
        $this->area_date = $area_date;
    }

    function setCategory_id($category_id) {
        $this->category_id = $category_id;
    }
}
