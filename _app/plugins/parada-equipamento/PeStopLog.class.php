<?php

/**
 * PeStopLog.class.php [Beans]
 * 
 * Classe que representa a tabela pe_stop_log do banco de dados
 * 
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class PeStopLog {

    private $log_id;
    private $log_date;
    private $log_content;
    private $equip_id;
    private $tipo_id;
    private $autor_id;

    function __construct() {
        $this->Controle = new Controle('pe_stop_log');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'log_date' => $this->getLog_date(),
            'log_content' => $this->getLog_content(),
            'tipo_id' => $this->getTipo_id(),
            'autor_id' => $this->getAutor_id(),
            'log_id' => $this->getLog_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setLog_date((isset($object->log_date) ? $object->log_date : null));
        $this->setLog_content((isset($object->log_content) ? $object->log_content : null));
        $this->setEquip_id((isset($object->equip_id) ? $object->equip_id : null));
        $this->setTipo_id((isset($object->tipo_id) ? $object->tipo_id : null));
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
    function getLog_id() {
        return $this->log_id;
    }

    function getLog_date() {
        return $this->log_date;
    }

    function getLog_content() {
        return $this->log_content;
    }

    function getEquip_id() {
        return $this->equip_id;
    }

    function getTipo_id() {
        return $this->tipo_id;
    }

    function getAutor_id() {
        return $this->autor_id;
    }

    function setLog_id($log_id) {
        $this->log_id = $log_id;
    }

    function setLog_date($log_date) {
        $this->log_date = $log_date;
    }

    function setLog_content($log_content) {
        $this->log_content = $log_content;
    }

    function setEquip_id($equip_id) {
        $this->equip_id = $equip_id;
    }

    function setTipo_id($tipo_id) {
        $this->tipo_id = $tipo_id;
    }

    function setAutor_id($autor_id) {
        $this->autor_id = $autor_id;
    }

}
