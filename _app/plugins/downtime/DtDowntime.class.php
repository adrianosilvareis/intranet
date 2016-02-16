<?php

/**
 * DtDowntime.class.php [Beans]
 * 
 * Classe que representa a tabela dt_downtime do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class DtDowntime extends Beans {

    private $equip_id;
    private $time_id;
    private $time_stop;
    private $time_start;
    private $time_lastupdate;
    private $equip_author;

    function __construct() {
        $this->Controle = new Controle('dt_downtime');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'equip_id' => $this->getEquip_id(),
            'time_stop' => $this->getTime_stop(),
            'time_start' => $this->getTime_start(),
            'time_lastupdate' => $this->getTime_lastupdate(),
            'equip_author' => $this->getEquip_author(),
            'time_id' => $this->getTime_id()
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
        $this->setTime_id((isset($object->time_id) ? $object->time_id : null));
        $this->setTime_stop((isset($object->time_stop) ? $object->time_stop : null));
        $this->setTime_start((isset($object->time_start) ? $object->time_start : null));
        $this->setTime_lastupdate((isset($object->time_lastupdate) ? $object->time_lastupdate : null));
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

    function getTime_id() {
        return $this->time_id;
    }

    function getTime_stop() {
        return $this->time_stop;
    }

    function getTime_start() {
        return $this->time_start;
    }

    function getTime_lastupdate() {
        return $this->time_lastupdate;
    }

    function getEquip_author() {
        return $this->equip_author;
    }

    function setEquip_id($equip_id) {
        $this->equip_id = $equip_id;
    }

    function setTime_id($time_id) {
        $this->time_id = $time_id;
    }

    function setTime_stop($time_stop) {
        $this->time_stop = $time_stop;
    }

    function setTime_start($time_start) {
        $this->time_start = $time_start;
    }

    function setTime_lastupdate($time_lastupdate) {
        $this->time_lastupdate = $time_lastupdate;
    }

    function setEquip_author($equip_author) {
        $this->equip_author = $equip_author;
    }


}
