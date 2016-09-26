<?php

/**
 * PeMetas.class.php [Beans]
 * 
 * Classe que representa a tabela pe_metas do banco de dados
 * 
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class PeMetas {

    private $meta_id;
    private $meta_title;
    private $meta_content;
    private $meta_prazo_max;
    private $meta_date;
    private $meta_validade;
    private $meta_status;
    private $autor_id;

    function __construct() {
        $this->Controle = new Controle('pe_metas');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'meta_title' => $this->getMeta_title(),
            'meta_content' => $this->getMeta_content(),
            'meta_prazo_max' => $this->getMeta_prazo_max(),
            'meta_date' => $this->getMeta_date(),
            'meta_validade' => $this->getMeta_validade(),
            'meta_status' => $this->getMeta_status(),
            'autor_id' => $this->getAutor_id(),
            'meta_id' => $this->getMeta_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setMeta_id((isset($object->meta_id) ? $object->meta_id : null));
        $this->setMeta_title((isset($object->meta_title) ? $object->meta_title : null));
        $this->setMeta_content((isset($object->meta_content) ? $object->meta_content : null));
        $this->setMeta_prazo_max((isset($object->meta_prazo_max) ? $object->meta_prazo_max : null));
        $this->setMeta_date((isset($object->meta_date) ? $object->meta_date : null));
        $this->setMeta_validade((isset($object->meta_validade) ? $object->meta_validade : null));
        $this->setMeta_status((isset($object->meta_status) ? $object->meta_status : null));
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
    function getMeta_id() {
        return $this->meta_id;
    }

    function getMeta_title() {
        return $this->meta_title;
    }

    function getMeta_content() {
        return $this->meta_content;
    }

    function getMeta_prazo_max() {
        return $this->meta_prazo_max;
    }

    function getMeta_date() {
        return $this->meta_date;
    }

    function getMeta_validade() {
        return $this->meta_validade;
    }

    function getMeta_status() {
        if (isset($this->meta_status)):
            $this->meta_status = ($this->meta_status ? '1' : 'false');
        endif;
        return $this->meta_status;
    }

    function getAutor_id() {
        return $this->autor_id;
    }

    function setMeta_id($meta_id) {
        $this->meta_id = $meta_id;
    }

    function setMeta_title($meta_title) {
        $this->meta_title = $meta_title;
    }

    function setMeta_content($meta_content) {
        $this->meta_content = $meta_content;
    }

    function setMeta_prazo_max($meta_prazo_max) {
        $this->meta_prazo_max = $meta_prazo_max;
    }

    function setMeta_date($meta_date) {
        $this->meta_date = $meta_date;
    }

    function setMeta_validade($meta_validade) {
        $this->meta_validade = $meta_validade;
    }

    function setMeta_status($meta_status) {
        $this->meta_status = $meta_status;
    }

    function setAutor_id($autor_id) {
        $this->autor_id = $autor_id;
    }

}
