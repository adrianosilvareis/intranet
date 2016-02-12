<?php

/**
 * NcOrigem.class.php [Beans]
 * 
 * Classe que representa a tabela nc_origem do banco de dados
 * 
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class NcOrigem {

    private $origem_id;
    private $origem_descricao;
    private $origem_ativo;

    function __construct() {
        $this->Controle = new Controle('nc_origem');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'origem_descricao' => $this->getOrigem_descricao(),
            'origem_ativo' => $this->getOrigem_ativo(),
            'origem_id' => $this->getOrigem_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setOrigem_id((isset($object->origem_id) ? $object->origem_id : null));
        $this->setOrigem_ativo((isset($object->origem_ativo) ? $object->origem_ativo : null));
        $this->setOrigem_descricao((isset($object->origem_descricao) ? $object->origem_descricao : null));
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
    function getOrigem_id() {
        return $this->origem_id;
    }

    function getOrigem_descricao() {
        return $this->origem_descricao;
    }

    function getOrigem_ativo() {
        return $this->origem_ativo;
    }

    function setOrigem_id($origem_id) {
        $this->origem_id = $origem_id;
    }

    function setOrigem_descricao($origem_descricao) {
        $this->origem_descricao = $origem_descricao;
    }

    function setOrigem_ativo($origem_ativo) {
        $this->origem_ativo = $origem_ativo;
    }

}
