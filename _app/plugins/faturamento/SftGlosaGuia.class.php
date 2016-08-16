<?php

/**
 * SftGlosaGuia.class.php [Beans]
 * 
 * Classe que representa a tabela sft_glosa_guia do banco de dados
 * 
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class SftGlosaGuia extends Beans {

    private $glosa_id;
    private $glosa_date;
    private $glosa_status;
    private $glosa_os;
    private $glosa_obs;
    private $glosa_value;
    private $conv_id;
    private $ncon_id;
    private $aten_id;
    private $postos_id;
    private $faturista_id;

    function __construct() {
        $this->Controle = new Controle('sft_glosa_guia');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'glosa_date' => $this->getGlosa_date(),
            'glosa_status' => $this->getGlosa_status(),
            'glosa_os' => $this->getGlosa_os(),
            'glosa_obs' => $this->getGlosa_obs(),
            'glosa_value' => $this->getGlosa_value(),
            'conv_id' => $this->getConv_id(),
            'ncon_id' => $this->getNcon_id(),
            'aten_id' => $this->getAten_id(),
            'postos_id' => $this->getPostos_id(),
            'faturista_id' => $this->getFaturista_id(),
            'glosa_id' => $this->getGlosa_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setGlosa_id((isset($object->glosa_id) ? $object->glosa_id : null));
        $this->setGlosa_date((isset($object->glosa_date) ? $object->glosa_date : null));
        $this->setGlosa_status((isset($object->glosa_status) ? $object->glosa_status : null));
        $this->setGlosa_os((isset($object->glosa_os) ? $object->glosa_os : null));
        $this->setGlosa_obs((isset($object->glosa_obs) ? $object->glosa_obs : null));
        $this->setGlosa_value((isset($object->glosa_value) ? $object->glosa_value : null));
        $this->setConv_id((isset($object->conv_id) ? $object->conv_id : null));
        $this->setNcon_id((isset($object->ncon_id) ? $object->ncon_id : null));
        $this->setAten_id((isset($object->aten_id) ? $object->aten_id : null));
        $this->setPostos_id((isset($object->postos_id) ? $object->postos_id : null));
        $this->setFaturista_id((isset($object->faturista_id) ? $object->faturista_id : null));
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
    function getGlosa_id() {
        return $this->glosa_id;
    }

    function getGlosa_date() {
        return $this->glosa_date;
    }

    function getGlosa_status() {
        if (isset($this->glosa_status)) {
            $this->glosa_status = ($this->glosa_status ? '1' : 'false');
        }
        return $this->glosa_status;
    }

    function getGlosa_os() {
        return $this->glosa_os;
    }

    function getGlosa_obs() {
        return $this->glosa_obs;
    }

    function getGlosa_value() {
        return $this->glosa_value;
    }

    function getConv_id() {
        return $this->conv_id;
    }

    function getNcon_id() {
        return $this->ncon_id;
    }

    function getAten_id() {
        return $this->aten_id;
    }

    function getPostos_id() {
        return $this->postos_id;
    }

    function getFaturista_id() {
        return $this->faturista_id;
    }

    function setGlosa_id($glosa_id) {
        $this->glosa_id = $glosa_id;
    }

    function setGlosa_date($glosa_date) {
        $this->glosa_date = $glosa_date;
    }

    function setGlosa_status($glosa_status) {
        $this->glosa_status = $glosa_status;
    }

    function setGlosa_os($glosa_os) {
        $this->glosa_os = $glosa_os;
    }

    function setGlosa_obs($glosa_obs) {
        $this->glosa_obs = $glosa_obs;
    }

    function setGlosa_value($glosa_value) {
        $this->glosa_value = $glosa_value;
    }

    function setConv_id($conv_id) {
        $this->conv_id = $conv_id;
    }

    function setNcon_id($ncon_id) {
        $this->ncon_id = $ncon_id;
    }

    function setAten_id($aten_id) {
        $this->aten_id = $aten_id;
    }

    function setPostos_id($postos_id) {
        $this->postos_id = $postos_id;
    }

    function setFaturista_id($faturista_id) {
        $this->faturista_id = $faturista_id;
    }

}
