<?php

/**
 * SftInconsistenciaGuia.class.php [Beans]
 * 
 * Classe que representa a tabela sft_inconsistencia_guia do banco de dados
 * 
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class SftInconsistenciaGuia extends Beans {

    private $inco_id;
    private $inco_date;
    private $inco_status;
    private $inco_os;
    private $inco_obs;
    private $inco_value;
    private $conv_id;
    private $ncon_id;
    private $aten_id;
    private $postos_id;
    private $faturista_id;

    function __construct() {
        $this->Controle = new Controle('sft_inconsistencia_guia');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'inco_date' => $this->getInco_date(),
            'inco_status' => $this->getInco_status(),
            'inco_os' => $this->getInco_os(),
            'inco_obs' => $this->getInco_obs(),
            'inco_value' => $this->getInco_value(),
            'conv_id' => $this->getConv_id(),
            'ncon_id' => $this->getNcon_id(),
            'aten_id' => $this->getAten_id(),
            'postos_id' => $this->getPostos_id(),
            'faturista_id' => $this->getFaturista_id(),
            'inco_id' => $this->getInco_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setInco_id((isset($object->inco_id) ? $object->inco_id : null));
        $this->setInco_date((isset($object->inco_date) ? $object->inco_date : null));
        $this->setInco_status((isset($object->inco_status) ? $object->inco_status : null));
        $this->setInco_os((isset($object->inco_os) ? $object->inco_os : null));
        $this->setInco_obs((isset($object->inco_obs) ? $object->inco_obs : null));
        $this->setInco_value((isset($object->inco_value) ? $object->inco_value : null));
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
    function getInco_id() {
        return $this->inco_id;
    }

    function getInco_date() {
        return $this->inco_date;
    }

    function getInco_status() {
        return $this->inco_status;
    }

    function getInco_os() {
        return $this->inco_os;
    }

    function getInco_obs() {
        return $this->inco_obs;
    }

    function getInco_value() {
        return $this->inco_value;
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

    function setInco_id($inco_id) {
        $this->inco_id = $inco_id;
    }

    function setInco_date($inco_date) {
        $this->inco_date = $inco_date;
    }

    function setInco_status($inco_status) {
        $this->inco_status = $inco_status;
    }

    function setInco_os($inco_os) {
        $this->inco_os = $inco_os;
    }

    function setInco_obs($inco_obs) {
        $this->inco_obs = $inco_obs;
    }

    function setInco_value($inco_value) {
        $this->inco_value = $inco_value;
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
