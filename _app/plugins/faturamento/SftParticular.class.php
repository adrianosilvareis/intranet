<?php

/**
 * SftParticular.class.php [Beans]
 * 
 * Classe que representa a tabela sft_particular do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class SftParticular extends Beans {

    private $part_id;
    private $part_date;
    private $part_nm_paciente;
    private $part_os;
    private $part_vl_liquido;
    private $part_vl_pago;
    private $part_vl_debito;
    private $aten_id;
    private $unid_id;

    function __construct() {
        $this->Controle = new Controle('sft_particular');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'part_date' => $this->getPart_date(),
            'part_nm_paciente' => $this->getPart_nm_paciente(),
            'part_os' => $this->getPart_os(),
            'part_vl_liquido' => $this->getPart_vl_liquido(),            
            'part_vl_pago' => $this->getPart_vl_pago(),
            'part_vl_debito' => $this->getPart_vl_debito(),
            'aten_id' => $this->getAten_id(),
            'unid_id' => $this->getUnid_id(),
            'part_id_idpart' => $this->getPart_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setPart_id((isset($object->part_id) ? $object->part_id : null));
        $this->setPart_date((isset($object->part_date) ? $object->part_date : null));
        $this->setPart_nm_paciente((isset($object->part_nm_paciente) ? $object->part_nm_paciente : null));
        $this->setPart_os((isset($object->part_os) ? $object->part_os : null));
        $this->setPart_vl_liquido((isset($object->part_vl_liquido) ? $object->part_vl_liquido : null));
        $this->setPart_vl_pago((isset($object->part_vl_pago) ? $object->part_vl_pago : null));
        $this->setPart_vl_debito((isset($object->part_vl_debito) ? $object->part_vl_debito : null));
        $this->setAten_id((isset($object->aten_id) ? $object->aten_id : null));
        $this->setUnid_id((isset($object->unid_id) ? $object->unid_id : null));
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
    function getPart_id() {
        return $this->part_id;
    }

    function getPart_date() {
        return $this->part_date;
    }

    function getPart_nm_paciente() {
        return $this->part_nm_paciente;
    }

    function getPart_os() {
        return $this->part_os;
    }

    function getPart_vl_liquido() {
        return $this->part_vl_liquido;
    }

    function getPart_vl_pago() {
        return $this->part_vl_pago;
    }

    function getPart_vl_debito() {
        return $this->part_vl_debito;
    }

    function getAten_id() {
        return $this->aten_id;
    }

    function getUnid_id() {
        return $this->unid_id;
    }

    function setPart_id($part_id) {
        $this->part_id = $part_id;
    }

    function setPart_date($part_date) {
        $this->part_date = $part_date;
    }

    function setPart_nm_paciente($part_nm_paciente) {
        $this->part_nm_paciente = $part_nm_paciente;
    }

    function setPart_os($part_os) {
        $this->part_os = $part_os;
    }

    function setPart_vl_liquido($part_vl_liquido) {
        $this->part_vl_liquido = $part_vl_liquido;
    }

    function setPart_vl_pago($part_vl_pago) {
        $this->part_vl_pago = $part_vl_pago;
    }

    function setPart_vl_debito($part_vl_debito) {
        $this->part_vl_debito = $part_vl_debito;
    }

    function setAten_id($aten_id) {
        $this->aten_id = $aten_id;
    }

    function setUnid_id($unid_id) {
        $this->unid_id = $unid_id;
    }
    
}
