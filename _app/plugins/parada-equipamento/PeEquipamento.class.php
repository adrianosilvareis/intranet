<?php

/**
 * PeEquipamento.class.php [Beans]
 * 
 * Classe que representa a tabela pe_equipamento do banco de dados
 * 
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class PeEquipamento {

    private $equip_id;
    private $equip_title;
    private $equip_date;
    private $equip_lastupdate;
    private $equip_sector;
    private $equip_status;
    private $equip_operation;
    private $autor_id;

    function __construct() {
        $this->Controle = new Controle('pe_equipamento');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'equip_title' => $this->getEquip_title(),
            'equip_date' => $this->getEquip_date(),
            'equip_lastupdate' => $this->getEquip_lastupdate(),
            'equip_sector' => $this->getEquip_sector(),
            'equip_status' => $this->getEquip_status(),
            'equip_operation' => $this->getEquip_operation(),
            'autor_id' => $this->getAutor_id(),
            'equip_id' => $this->getEquip_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setEquip_id((isset($object->equip_id) ? $object->equip_id : null));
        $this->setEquip_title((isset($object->equip_title) ? $object->equip_title : null));
        $this->setEquip_date((isset($object->equip_date) ? $object->equip_date : null));
        $this->setEquip_lastupdate((isset($object->equip_lastupdate) ? $object->equip_lastupdate : null));
        $this->setEquip_sector((isset($object->equip_sector) ? $object->equip_sector : null));
        $this->setEquip_operation((isset($object->equip_operation) ? $object->equip_operation : null));
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
    function getEquip_id() {
        return $this->equip_id;
    }

    function getEquip_title() {
        return $this->equip_title;
    }

    function getEquip_date() {
        return $this->equip_date;
    }

    function getEquip_lastupdate() {
        return $this->equip_lastupdate;
    }

    function getEquip_sector() {
        return $this->equip_sector;
    }

    function getEquip_status() {
        return $this->equip_status;
    }

    function getEquip_operation() {
        return $this->equip_operation;
    }

    function getAutor_id() {
        return $this->autor_id;
    }

    function setEquip_id($equip_id) {
        $this->equip_id = $equip_id;
    }

    function setEquip_title($equip_title) {
        $this->equip_title = $equip_title;
    }

    function setEquip_date($equip_date) {
        $this->equip_date = $equip_date;
    }

    function setEquip_lastupdate($equip_lastupdate) {
        $this->equip_lastupdate = $equip_lastupdate;
    }

    function setEquip_sector($equip_sector) {
        $this->equip_sector = $equip_sector;
    }

    function setEquip_status($equip_status) {
        $this->equip_status = $equip_status;
    }

    function setEquip_operation($equip_operation) {
        $this->equip_operation = $equip_operation;
    }

    function setAutor_id($autor_id) {
        $this->autor_id = $autor_id;
    }

}
