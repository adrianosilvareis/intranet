<?php

/**
 * RegistroHasOrigem.class.php [BEANS]
 * 
 * Representa a tabela registro_has_origem do banco de dados
 * tabela responsavel por criar uma ligação many-to-many entre as tabelas nc_registro e nc_origem
 * 
 * @copyright (c) 2016,  S. Reis, Adriano
 */
class RegistroHasOrigem extends Beans {

    private $reg_id;
    private $origem_id;

    function __construct() {
        $this->Controle = new Controle('nc_registro_has_nc_origem');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'reg_id' => $this->getReg_id(),
            'origem_id' => $this->getOrigem_id(),
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setReg_id((isset($object->reg_id) ? $object->reg_id : null));
        $this->setOrigem_id((isset($object->origem_id) ? $object->origem_id : null));
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
    function getReg_id() {
        return $this->reg_id;
    }

    function getOrigem_id() {
        return $this->origem_id;
    }

    function setReg_id($reg_id) {
        $this->reg_id = $reg_id;
    }

    function setOrigem_id($origem_id) {
        $this->origem_id = $origem_id;
    }

}
