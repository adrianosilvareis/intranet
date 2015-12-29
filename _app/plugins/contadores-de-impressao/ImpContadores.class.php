<?php

/**
 * ImpContadores.class.php [Beans]
 * 
 * Classe que representa a tabela imp_contadores do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class ImpContadores extends Beans {

    private $contadores_id;
    private $contadores_contador;
    private $contadores_data;
    private $fk_impressora;

    function __construct() {
        $this->Controle = new Controle('imp_contadores');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'contadores_contador' => $this->getContadores_contador(),
            'contadores_data' => $this->getContadores_data(),
            'fk_impressora' => $this->getFk_impressora(),
            'contadores_id' => $this->getContadores_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setContadores_id((isset($object->contadores_id) ? $object->contadores_id : null));
        $this->setContadores_contador((isset($object->contadores_contador) ? $object->contadores_contador : null));
        $this->setContadores_data((isset($object->contadores_data) ? $object->contadores_data : null));
        $this->setFk_impressora((isset($object->fk_impressora) ? $object->fk_impressora : null));
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
    function getContadores_id() {
        return $this->contadores_id;
    }

    function getContadores_contador() {
        return $this->contadores_contador;
    }

    function getContadores_data() {
        return $this->contadores_data;
    }

    function getFk_impressora() {
        return $this->fk_impressora;
    }

    function setContadores_id($contadores_id) {
        $this->contadores_id = $contadores_id;
    }

    function setContadores_contador($contadores_contador) {
        $this->contadores_contador = $contadores_contador;
    }

    function setContadores_data($contadores_data) {
        $this->contadores_data = $contadores_data;
    }

    function setFk_impressora($fk_impressora) {
        $this->fk_impressora = $fk_impressora;
    }

}
