<?php

/**
 * SftNaoConformidade.class.php [Beans]
 * 
 * Classe que representa a tabela sft_nao_conformidade do banco de dados
 * 
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class SftNaoConformidade extends Beans {

    private $ncon_id;
    private $ncon_title;
    private $ncon_content;
    private $ncon_date;
    private $ncon_status;

    function __construct() {
        $this->Controle = new Controle('sft_nao_conformidade');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'ncon_title' => $this->getNcon_title(),
            'ncon_content' => $this->getNcon_content(),
            'ncon_date' => $this->getNcon_date(),
            'ncon_status' => $this->getNcon_status(),
            'ncon_id' => $this->getNcon_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setNcon_id((isset($object->ncon_id) ? $object->ncon_id : null));
        $this->setNcon_title((isset($object->ncon_title) ? $object->ncon_title : null));
        $this->setNcon_content((isset($object->ncon_content) ? $object->ncon_content : null));
        $this->setNcon_date((isset($object->ncon_date) ? $object->ncon_date : null));
        $this->setNcon_status((isset($object->ncon_status) ? $object->ncon_status : null));
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
    function getNcon_id() {
        return $this->ncon_id;
    }

    function getNcon_title() {
        return $this->ncon_title;
    }

    function getNcon_content() {
        return $this->ncon_content;
    }

    function getNcon_date() {
        return $this->ncon_date;
    }

    function getNcon_status() {
        if (isset($this->ncon_status)):
            $this->ncon_status = ($this->ncon_status ? '1' : 'false');
        endif;
        return $this->ncon_status;
    }

    function setNcon_id($ncon_id) {
        $this->ncon_id = $ncon_id;
    }

    function setNcon_title($ncon_title) {
        $this->ncon_title = $ncon_title;
    }

    function setNcon_content($ncon_content) {
        $this->ncon_content = $ncon_content;
    }

    function setNcon_date($ncon_date) {
        $this->ncon_date = $ncon_date;
    }

    function setNcon_status($ncon_status) {
        $this->ncon_status = $ncon_status;
    }

}
