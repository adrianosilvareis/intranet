<?php

/**
 * SftInputAdmin.class.php [Beans]
 * 
 * Classe que representa a tabela sft_input_aten do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class SftOutputGlos extends Beans {

    private $glos_id_idglos;
    private $glos_dt_regis;
    private $glos_ob_obsglos;
    private $glos_os_numos;
    private $glos_vl_vlos;
    private $fk_aten;
    private $fk_conv;
    private $fk_ncon;
    private $fk_stat;
    private $fk_unid;

    function __construct() {
        $this->Controle = new Controle('sft_output_glos');
        $this->Controle->setDBConn(['DB_HOST' => '187.115.148.178', 'DB_NAME' => 'faturamento', 'DB_USER' => DB_USER, 'DB_PASS' => DB_PASS]);
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'glos_dt_regis' => $this->getGlos_dt_regis(),
            'glos_ob_obsglos' => $this->getGlos_ob_obsglos(),
            'glos_os_numos' => $this->getGlos_os_numos(),
            'glos_vl_vlos' => $this->getGlos_vl_vlos(),
            'fk_aten' => $this->getFk_aten(),
            'fk_conv' => $this->getFk_conv(),
            'fk_ncon' => $this->getFk_ncon(),
            'fk_stat' => $this->getFk_stat(),
            'fk_unid' => $this->getFk_unid(),
            'glos_id_idglos' => $this->getGlos_id_idglos()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setGlos_id_idglos((isset($object->glos_id_idglos) ? $object->glos_id_idglos : null));
        $this->setGlos_dt_regis((isset($object->glos_dt_regis) ? $object->glos_dt_regis : null));
        $this->setGlos_ob_obsglos((isset($object->glos_ob_obsglos) ? $object->glos_ob_obsglos : null));
        $this->setGlos_os_numos((isset($object->glos_os_numos) ? $object->glos_os_numos : null));
        $this->setGlos_vl_vlos((isset($object->glos_vl_vlos) ? $object->glos_vl_vlos : null));
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
    function getGlos_id_idglos() {
        return $this->glos_id_idglos;
    }

    function getGlos_dt_regis() {
        return $this->glos_dt_regis;
    }

    function getGlos_ob_obsglos() {
        return $this->glos_ob_obsglos;
    }

    function getGlos_os_numos() {
        return $this->glos_os_numos;
    }

    function getGlos_vl_vlos() {
        return $this->glos_vl_vlos;
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

    function setGlos_id_idglos($glos_id_idglos) {
        $this->glos_id_idglos = $glos_id_idglos;
    }

    function setGlos_dt_regis($glos_dt_regis) {
        $this->glos_dt_regis = $glos_dt_regis;
    }

    function setGlos_ob_obsglos($glos_ob_obsglos) {
        $this->glos_ob_obsglos = $glos_ob_obsglos;
    }

    function setGlos_os_numos($glos_os_numos) {
        $this->glos_os_numos = $glos_os_numos;
    }

    function setGlos_vl_vlos($glos_vl_vlos) {
        $this->glos_vl_vlos = $glos_vl_vlos;
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
