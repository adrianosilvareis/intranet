<?php

/**
 * AppYoutube.class.php [Beans]
 * 
 * Classe que representa a tabela app_youtube do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class AppYoutube extends Beans {

    private $youtube_id;
    private $youtube_title;
    private $youtube_url;
    private $youtube_author;
    private $youtube_date;
    private $youtube_status;

    function __construct() {
        $this->Controle = new Controle('app_youtube');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'youtube_title' => $this->getYoutube_title(),
            'youtube_url' => $this->getYoutube_url(),
            'youtube_author' => $this->getYoutube_author(),
            'youtube_date' => $this->getYoutube_date(),
            'youtube_status' => $this->getYoutube_status(),
            'youtube_id' => $this->getYoutube_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setYoutube_id((isset($object->youtube_id) ? $object->youtube_id : null));
        $this->setYoutube_title((isset($object->youtube_title) ? $object->youtube_title : null));
        $this->setYoutube_url(($object->youtube_url ? $object->youtube_url : null));
        $this->setYoutube_author((isset($object->youtube_author) ? $object->youtube_author : null));
        $this->setYoutube_date((isset($object->youtube_date) ? $object->youtube_date : null));
        $this->setYoutube_status((isset($object->youtube_status) ? $object->youtube_status : null));
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
    function getYoutube_id() {
        return $this->youtube_id;
    }

    function getYoutube_title() {
        return $this->youtube_title;
    }

    function getYoutube_url() {
        return $this->youtube_url;
    }

    function getYoutube_author() {
        return $this->youtube_author;
    }

    function getYoutube_date() {
        return $this->youtube_date;
    }

    function getYoutube_status() {
        return $this->youtube_status;
    }

    function setYoutube_id($youtube_id) {
        $this->youtube_id = $youtube_id;
    }

    function setYoutube_title($youtube_title) {
        $this->youtube_title = $youtube_title;
    }

    function setYoutube_url($youtube_url) {
        $this->youtube_url = $youtube_url;
    }

    function setYoutube_author($youtube_author) {
        $this->youtube_author = $youtube_author;
    }

    function setYoutube_date($youtube_date) {
        $this->youtube_date = $youtube_date;
    }

    function setYoutube_status($youtube_status) {
        $this->youtube_status = $youtube_status;
    }

}
