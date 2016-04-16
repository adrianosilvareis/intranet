<?php

/**
 * WsPostsFile.class.php [Beans]
 * 
 * Classe que representa a tabela ws_posts_file do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class NcRegFile extends Beans {

    private $reg_id;
    private $file_id;
    private $file_url;
    private $file_date;
    private $file_name;

    function __construct() {
        $this->Controle = new Controle('nc_registro_file');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'reg_id' => $this->getReg_id(),
            'file_url' => $this->getFile_url(),
            'file_date' => $this->getFile_date(),
            'file_name' => $this->getFile_name(),
            'file_id' => $this->getFile_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setFile_id((isset($object->file_id) ? $object->file_id : null));
        $this->setFile_url((isset($object->file_url) ? $object->file_url : null));
        $this->setFile_date((isset($object->file_date) ? $object->file_date : null));
        $this->setFile_name((isset($object->file_name) ? $object->file_name : null));
        $this->setReg_id((isset($object->reg_id) ? $object->reg_id : null));
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
    function getReg_id() {
        return $this->reg_id;
    }

    function getFile_id() {
        return $this->file_id;
    }

    function getFile_url() {
        return $this->file_url;
    }

    function getFile_date() {
        return $this->file_date;
    }

    function setReg_id($reg_id) {
        $this->reg_id = $reg_id;
    }

    function setFile_id($file_id) {
        $this->file_id = $file_id;
    }

    function setFile_url($file_url) {
        $this->file_url = $file_url;
    }

    function setFile_date($file_date) {
        $this->file_date = $file_date;
    }

    function getFile_name() {
        return $this->file_name;
    }

    function setFile_name($file_name) {
        $this->file_name = $file_name;
    }

}
