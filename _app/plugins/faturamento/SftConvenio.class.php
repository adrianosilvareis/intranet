<?php

/**
 * SftConvenio.class.php [Beans]
 * 
 * Classe que representa a tabela sft_convenio do banco de dados
 * 
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class SftConvenio extends Beans {

    private $conv_id;
    private $conv_title;
    private $conv_name;
    private $conv_describe;
    private $conv_date;
    private $conv_code;
    private $conv_status;
    private $post_id;

    function __construct() {
        $this->Controle = new Controle('sft_convenio');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'conv_title' => $this->getConv_title(),
            'conv_name' => $this->getConv_name(),
            'conv_describe' => $this->getConv_describe(),
            'conv_date' => $this->getConv_date(),
            'conv_code' => $this->getConv_code(),
            'conv_status' => $this->getConv_status(),
            'post_id' => $this->getPost_id(),
            'conv_id' => $this->getConv_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setConv_id((isset($object->conv_id) ? $object->conv_id : null));
        $this->setConv_title((isset($object->conv_title) ? $object->conv_title : null));
        $this->setConv_name((isset($object->conv_name) ? $object->conv_name : null));
        $this->setConv_describe((isset($object->conv_describe) ? $object->conv_describe : null));
        $this->setConv_date((isset($object->conv_date) ? $object->conv_date : null));
        $this->setConv_code((isset($object->conv_code) ? $object->conv_code : null));
        $this->setConv_status((isset($object->conv_status) ? $object->conv_status : null));
        $this->setPost_id((isset($object->post_id) ? $object->post_id : null));
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
    function getConv_id() {
        return $this->conv_id;
    }

    function getConv_title() {
        return $this->conv_title;
    }

    function getConv_name() {
        return $this->conv_name;
    }

    function getConv_describe() {
        return $this->conv_describe;
    }

    function getConv_date() {
        return $this->conv_date;
    }

    function getConv_code() {
        return $this->conv_code;
    }

    function getConv_status() {
        if (isset($this->conv_status)):
            $this->conv_status = ($this->conv_status ? '1' : 'false');
        endif;
        return $this->conv_status;
    }

    function getPost_id() {
        return $this->post_id;
    }

    function setConv_id($conv_id) {
        $this->conv_id = $conv_id;
    }

    function setConv_title($conv_title) {
        $this->conv_title = $conv_title;
    }

    function setConv_name($conv_name) {
        $this->conv_name = $conv_name;
    }

    function setConv_describe($conv_describe) {
        $this->conv_describe = $conv_describe;
    }

    function setConv_date($conv_date) {
        $this->conv_date = $conv_date;
    }

    function setConv_code($conv_code) {
        $this->conv_code = $conv_code;
    }

    function setConv_status($conv_status) {
        $this->conv_status = $conv_status;
    }

    function setPost_id($post_id) {
        $this->post_id = $post_id;
    }

}
