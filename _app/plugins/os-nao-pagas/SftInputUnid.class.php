<?php

/**
 * SftInputUnid.class.php [Beans]
 * 
 * Classe que representa a tabela sft_input_unid do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class SftInputUnid extends Beans {

    private $unid_id_idunid;
    private $unid_cod_codigo;
    private $unid_nm_nmunid;
    private $unid_mt_multiplo;

    function __construct() {
        $this->Controle = new Controle('sft_input_unid');
        $this->Controle->setDBConn(['DB_HOST' => '187.115.148.178', 'DB_NAME' => 'faturamento', 'DB_USER' => DB_USER, 'DB_PASS' => DB_PASS]);
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'unid_cod_codigo' => $this->getUnid_cod_codigo(),
            'unid_nm_nmunid' => $this->getUnid_nm_nmunid(),
            'unid_mt_multiplo' => $this->getUnid_mt_multiplo(),
            'unid_id_idunid' => $this->getUnid_id_idunid()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setUnid_id_idunid((isset($object->unid_id_idunid) ? $object->unid_id_idunid : null));
        $this->setUnid_cod_codigo((isset($object->unid_cod_codigo) ? $object->unid_cod_codigo : null));
        $this->setUnid_nm_nmunid((isset($object->unid_nm_nmunid) ? $object->unid_nm_nmunid : null));
        $this->setUnid_mt_multiplo((isset($object->unid_mt_multiplo) ? $object->unid_mt_multiplo : null));
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
    function getUnid_id_idunid() {
        return $this->unid_id_idunid;
    }

    function getUnid_cod_codigo() {
        return $this->unid_cod_codigo;
    }

    function getUnid_nm_nmunid() {
        return $this->unid_nm_nmunid;
    }

    function getUnid_mt_multiplo() {
        return $this->unid_mt_multiplo;
    }

    function setUnid_id_idunid($unid_id_idunid) {
        $this->unid_id_idunid = $unid_id_idunid;
    }

    function setUnid_cod_codigo($unid_cod_codigo) {
        $this->unid_cod_codigo = $unid_cod_codigo;
    }

    function setUnid_nm_nmunid($unid_nm_nmunid) {
        $this->unid_nm_nmunid = $unid_nm_nmunid;
    }

    function setUnid_mt_multiplo($unid_mt_multiplo) {
        $this->unid_mt_multiplo = $unid_mt_multiplo;
    }



}
