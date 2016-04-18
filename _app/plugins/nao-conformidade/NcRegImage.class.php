<?php

/**
 * WsPostsImage.class.php [Beans]
 * 
 * Classe que representa a tabela ws_posts_file do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class NcRegImage extends Beans {

    private $reg_id;
    private $image_id;
    private $image_url;
    private $image_date;
    private $image_name;

    function __construct() {
        $this->Controle = new Controle('nc_registro_image');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'reg_id' => $this->getReg_id(),
            'image_url' => $this->getImage_url(),
            'image_date' => $this->getImage_date(),
            'image_name' => $this->getImage_name(),
            'image_id' => $this->getImage_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setImage_id((isset($object->image_id) ? $object->image_id : null));
        $this->setImage_url((isset($object->image_url) ? $object->image_url : null));
        $this->setImage_date((isset($object->image_date) ? $object->image_date : null));
        $this->setImage_name((isset($object->image_name) ? $object->image_name : null));
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

    function getImage_id() {
        return $this->image_id;
    }

    function getImage_url() {
        return $this->image_url;
    }

    function getImage_date() {
        return $this->image_date;
    }

    function setReg_id($reg_id) {
        $this->reg_id = $reg_id;
    }

    function setImage_id($image_id) {
        $this->image_id = $image_id;
    }

    function setImage_url($image_url) {
        $this->image_url = $image_url;
    }

    function setImage_date($image_date) {
        $this->image_date = $image_date;
    }

    function getImage_name() {
        return $this->image_name;
    }

    function setImage_name($image_name) {
        $this->image_name = $image_name;
    }

}
