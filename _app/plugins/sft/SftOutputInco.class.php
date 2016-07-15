<?php

/**
 * SftInputAdmin.class.php [Beans]
 * 
 * Classe que representa a tabela sft_input_aten do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class SftOutputInco extends Beans {

    private $inco_id_idinco;
    private $inco_dt_regis;
    private $inco_ob_obsinco;
    private $inco_os_numos;
    private $fk_aten;
    private $fk_conv;
    private $fk_ncon;
    private $fk_stat;
    private $fk_unid;

    function __construct() {
        $this->Controle = new Controle('sft_output_inco');
        $this->Controle->setDBConn(['DB_HOST' => '187.115.148.178', 'DB_NAME' => 'faturamento', 'DB_USER' => DB_USER, 'DB_PASS' => DB_PASS]);
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'inco_dt_regis' => $this->getInco_dt_regis(),
            'inco_ob_obsinco' => $this->getInco_ob_obsinco(),
            'inco_os_numos' => $this->getInco_os_numos(),
            'fk_aten' => $this->getFk_aten(),
            'fk_conv' => $this->getFk_conv(),
            'fk_ncon' => $this->getFk_ncon(),
            'fk_stat' => $this->getFk_stat(),
            'fk_unid' => $this->getFk_unid(),
            'inco_id_idinco' => $this->getInco_id_idinco()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setInco_id_idinco((isset($object->inco_id_idinco) ? $object->inco_id_idinco : null));
        $this->setInco_dt_regis((isset($object->inco_dt_regis) ? $object->inco_dt_regis : null));
        $this->setInco_ob_obsinco((isset($object->inco_ob_obsinco) ? $object->inco_ob_obsinco : null));
        $this->setInco_os_numos((isset($object->inco_os_numos) ? $object->inco_os_numos : null));
        $this->setFk_aten((isset($object->fk_aten) ? $object->fk_aten : null));
        $this->setFk_conv((isset($object->fk_conv) ? $object->fk_conv : null));
        $this->setFk_ncon((isset($object->fk_ncon) ? $object->fk_ncon : null));
        $this->setFk_stat((isset($object->fk_stat) ? $object->fk_stat : null));
        $this->setFk_unid((isset($object->fk_unid) ? $object->fk_unid : null));
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
    function getInco_id_idinco() {
        return $this->inco_id_idinco;
    }

    function getInco_dt_regis() {
        return $this->inco_dt_regis;
    }

    function getInco_ob_obsinco() {
        return $this->inco_ob_obsinco;
    }

    function getInco_os_numos() {
        return $this->inco_os_numos;
    }

    function getFk_aten() {
        return $this->fk_aten;
    }

    function getFk_conv() {
        return $this->fk_conv;
    }

    function getFk_ncon() {
        return $this->fk_ncon;
    }

    function getFk_stat() {
        return $this->fk_stat;
    }

    function getFk_unid() {
        return $this->fk_unid;
    }

    function setInco_id_idinco($inco_id_idinco) {
        $this->inco_id_idinco = $inco_id_idinco;
    }

    function setInco_dt_regis($inco_dt_regis) {
        $this->inco_dt_regis = $inco_dt_regis;
    }

    function setInco_ob_obsinco($inco_ob_obsinco) {
        $this->inco_ob_obsinco = $inco_ob_obsinco;
    }

    function setInco_os_numos($inco_os_numos) {
        $this->inco_os_numos = $inco_os_numos;
    }

    function setFk_aten($fk_aten) {
        $this->fk_aten = $fk_aten;
    }

    function setFk_conv($fk_conv) {
        $this->fk_conv = $fk_conv;
    }

    function setFk_ncon($fk_ncon) {
        $this->fk_ncon = $fk_ncon;
    }

    function setFk_stat($fk_stat) {
        $this->fk_stat = $fk_stat;
    }

    function setFk_unid($fk_unid) {
        $this->fk_unid = $fk_unid;
    }

}
