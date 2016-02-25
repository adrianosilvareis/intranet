<?php

/**
 * WsSetorType.class.php [Beans]
 * 
 * Classe que representa a tabela ws_setor_type do banco de dados
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class WsSetorType extends Beans {

    private $type_id;
    private $type_content;
    private $type_status;

    function __construct() {
        $this->Controle = new Controle('ws_setor_type');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'type_content' => $this->getType_content(),
            'type_status' => $this->getType_status(),
            'type_id' => $this->getType_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setType_id((isset($object->type_id) ? $object->type_id : null));
        $this->setType_content((isset($object->type_content) ? $object->type_content : null));
        $this->setType_status((isset($object->type_status) ? $object->type_status : null));
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
    function getType_id() {
        return $this->type_id;
    }

    function getType_content() {
        return $this->type_content;
    }

    function getType_status() {
        return $this->type_status;
    }

    function setType_id($type_id) {
        $this->type_id = $type_id;
    }

    function setType_content($type_content) {
        $this->type_content = $type_content;
    }

    function setType_status($type_status) {
        $this->type_status = $type_status;
    }

}
