<?php

/**
 * AppImpressora.class.php [Beans]
 * 
 * Classe que representa a tabela app_impressora do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class AppImpressora extends Beans{

    private $impressora_id;
    private $impressora_serial;
    private $impressora_status;
    private $impressora_descricao;
    private $fk_modelo;
    private $fk_postos;
    private $fk_taxa;

    function __construct() {
        $this->Controle = new Controle('app_impressora');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'impressora_serial' => $this->getImpressora_serial(),
            'impressora_status' => $this->getImpressora_status(),
            'impressora_descricao' => $this->getImpressora_descricao(),
            'fk_modelo' => $this->getFk_modelo(),
            'fk_postos' => $this->getFk_postos(),
            'fk_taxa' => $this->getFk_taxa(),
            'impressora_id' => $this->getImpressora_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setImpressora_id((isset($object->impressora_id) ? $object->impressora_id : null));
        $this->setImpressora_serial((isset($object->impressora_serial) ? $object->impressora_serial : null));
        $this->setImpressora_status((isset($object->impressora_status) ? $object->impressora_status : null));
        $this->setImpressora_descricao((isset($object->impressora_descricao) ? $object->impressora_descricao : null));
        $this->setFk_modelo((isset($object->fk_modelo) ? $object->fk_modelo : null));
        $this->setFk_postos((isset($object->fk_postos) ? $object->fk_postos : null));
        $this->setFk_taxa((isset($object->fk_taxa) ? $object->fk_taxa : null));
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
    function getImpressora_id() {
        return $this->impressora_id;
    }

    function getImpressora_serial() {
        return $this->impressora_serial;
    }

    function getImpressora_status() {
        return $this->impressora_status;
    }

    function getImpressora_descricao() {
        return $this->impressora_descricao;
    }

    function getFk_modelo() {
        return $this->fk_modelo;
    }

    function getFk_postos() {
        return $this->fk_postos;
    }

    function getFk_taxa() {
        return $this->fk_taxa;
    }

    function setImpressora_id($impressora_id) {
        $this->impressora_id = $impressora_id;
    }

    function setImpressora_serial($impressora_serial) {
        $this->impressora_serial = $impressora_serial;
    }

    function setImpressora_status($impressora_status) {
        $this->impressora_status = $impressora_status;
    }

    function setImpressora_descricao($impressora_descricao) {
        $this->impressora_descricao = $impressora_descricao;
    }

    function setFk_modelo($fk_modelo) {
        $this->fk_modelo = $fk_modelo;
    }

    function setFk_postos($fk_postos) {
        $this->fk_postos = $fk_postos;
    }

    function setFk_taxa($fk_taxa) {
        $this->fk_taxa = $fk_taxa;
    }

}
