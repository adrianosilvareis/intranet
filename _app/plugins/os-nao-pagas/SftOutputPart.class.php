<?php

/**
 * SftOutputPart.class.php [Beans]
 * 
 * Classe que representa a tabela sft_output_part do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class SftOutputPart extends Beans {

    private $part_id_idpart;
    private $part_data_regist;
    private $part_nm_paciente;
    private $part_os_ospart;
    private $part_vl_debito;
    private $part_vl_desc;
    private $part_vl_liquido;
    private $part_vl_pago;
    private $part_vl_total;
    private $fk_aten;
    private $fk_unid;
    private $historico;

    function __construct() {
        $this->Controle = new Controle('sft_output_part');
        $this->Controle->setDBConn(['DB_HOST' => '187.115.148.178', 'DB_NAME' => 'faturamento', 'DB_USER' => DB_USER, 'DB_PASS' => DB_PASS]);
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'part_data_regist' => $this->getPart_data_regist(),
            'part_nm_paciente' => $this->getPart_nm_paciente(),
            'part_os_ospart' => $this->getPart_os_ospart(),
            'part_vl_debito' => $this->getPart_vl_debito(),
            'part_vl_desc' => $this->getPart_vl_desc(),
            'part_vl_liquido' => $this->getPart_vl_liquido(),
            'part_vl_pago' => $this->getPart_vl_pago(),
            'part_vl_total' => $this->getPart_vl_total(),
            'fk_aten' => $this->getFk_aten(),
            'fk_unid' => $this->getFk_unid(),
            'historico' => $this->getHistorico(),
            'part_id_idpart' => $this->getPart_id_idpart()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setPart_id_idpart((isset($object->part_id_idpart) ? $object->part_id_idpart : null));
        $this->setPart_data_regist((isset($object->part_data_regist) ? $object->part_data_regist : null));
        $this->setPart_nm_paciente((isset($object->part_nm_paciente) ? $object->part_nm_paciente : null));
        $this->setPart_os_ospart((isset($object->part_os_ospart) ? $object->part_os_ospart : null));
        $this->setPart_vl_debito((isset($object->part_vl_debito) ? $object->part_vl_debito : null));
        $this->setPart_vl_desc((isset($object->part_vl_desc) ? $object->part_vl_desc : null));
        $this->setPart_vl_liquido((isset($object->part_vl_liquido) ? $object->part_vl_liquido : null));
        $this->setPart_vl_pago((isset($object->part_vl_pago) ? $object->part_vl_pago : null));
        $this->setPart_vl_total((isset($object->part_vl_total) ? $object->part_vl_total : null));
        $this->setFk_aten((isset($object->fk_aten) ? $object->fk_aten : null));
        $this->setFk_unid((isset($object->fk_unid) ? $object->fk_unid : null));
        $this->setHistorico((isset($object->historico) ? $object->historico : null));
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
    function getPart_id_idpart() {
        return $this->part_id_idpart;
    }

    function getPart_data_regist() {
        return $this->part_data_regist;
    }

    function getPart_nm_paciente() {
        return $this->part_nm_paciente;
    }

    function getPart_os_ospart() {
        return $this->part_os_ospart;
    }

    function getPart_vl_debito() {
        return $this->part_vl_debito;
    }

    function getPart_vl_desc() {
        return $this->part_vl_desc;
    }

    function getPart_vl_liquido() {
        return $this->part_vl_liquido;
    }

    function getPart_vl_pago() {
        return $this->part_vl_pago;
    }

    function getPart_vl_total() {
        return $this->part_vl_total;
    }

    function getFk_aten() {
        return $this->fk_aten;
    }

    function getFk_unid() {
        return $this->fk_unid;
    }

    function getHistorico() {
        return $this->historico;
    }

    function setPart_id_idpart($part_id_idpart) {
        $this->part_id_idpart = $part_id_idpart;
    }

    function setPart_data_regist($part_data_regist) {
        $this->part_data_regist = $part_data_regist;
    }

    function setPart_nm_paciente($part_nm_paciente) {
        $this->part_nm_paciente = $part_nm_paciente;
    }

    function setPart_os_ospart($part_os_ospart) {
        $this->part_os_ospart = $part_os_ospart;
    }

    function setPart_vl_debito($part_vl_debito) {
        $this->part_vl_debito = $part_vl_debito;
    }

    function setPart_vl_desc($part_vl_desc) {
        $this->part_vl_desc = $part_vl_desc;
    }

    function setPart_vl_liquido($part_vl_liquido) {
        $this->part_vl_liquido = $part_vl_liquido;
    }

    function setPart_vl_pago($part_vl_pago) {
        $this->part_vl_pago = $part_vl_pago;
    }

    function setPart_vl_total($part_vl_total) {
        $this->part_vl_total = $part_vl_total;
    }

    function setFk_aten($fk_aten) {
        $this->fk_aten = $fk_aten;
    }

    function setFk_unid($fk_unid) {
        $this->fk_unid = $fk_unid;
    }

    function setHistorico($historico) {
        $this->historico = $historico;
    }

}
