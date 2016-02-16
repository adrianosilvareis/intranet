<?php

/**
 * DtEquipamentos.class.php [Beans]
 * 
 * Classe que representa a tabela dt_equipamentos do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class DtEquipamentos extends Beans {

    private $equip_id;
    private $equip_title;
    private $equip_content;
    private $equip_date;
    private $equip_status;
    private $equip_lastupdate;
    private $equip_author;

    function __construct() {
        $this->Controle = new Controle('dt_equipamentos');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'equip_title' => $this->getEquip_title(),
            'equip_content' => $this->getEquip_content(),
            'equip_date' => $this->getEquip_date(),
            'equip_status' => $this->getEquip_status(),
            'equip_lastupdate' => $this->getEquip_lastupdate(),
            'equip_author' => $this->getEquip_author(),
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
        $this->setEquip_content((isset($object->equip_content) ? $object->equip_content : null));
        $this->setEquip_date((isset($object->equip_date) ? $object->equip_date : null));
        $this->setEquip_status((isset($object->equip_status) ? $object->equip_status : null));
        $this->setEquip_lastupdate((isset($object->equip_lastupdate) ? $object->equip_lastupdate : null));
        $this->setEquip_author((isset($object->equip_author) ? $object->equip_author : null));
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

    function getEquip_content() {
        return $this->equip_content;
    }

    function getEquip_date() {
        return $this->equip_date;
    }

    function getEquip_status() {
        return $this->equip_status;
    }

    function getEquip_lastupdate() {
        return $this->equip_lastupdate;
    }

    function getEquip_author() {
        return $this->equip_author;
    }

    function setEquip_id($equip_id) {
        $this->equip_id = $equip_id;
    }

    function setEquip_title($equip_title) {
        $this->equip_title = $equip_title;
    }

    function setEquip_content($equip_content) {
        $this->equip_content = $equip_content;
    }

    function setEquip_date($equip_date) {
        $this->equip_date = $equip_date;
    }

    function setEquip_status($equip_status) {
        $this->equip_status = $equip_status;
    }

    function setEquip_lastupdate($equip_lastupdate) {
        $this->equip_lastupdate = $equip_lastupdate;
    }

    function setEquip_author($equip_author) {
        $this->equip_author = $equip_author;
    }

}
