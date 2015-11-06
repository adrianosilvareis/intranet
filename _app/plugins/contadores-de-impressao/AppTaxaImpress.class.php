<?php

/**
 * AppTaxaImpress.class.php [Beans]
 * 
 * Classe que representa a tabela app_taxa_impress do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class AppTaxaImpress extends Beans {

    private $taxa_id;
    private $taxa_descricao;
    private $taxa_valor;

    function __construct() {
        $this->Controle = new Controle('app_taxa_impress');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'taxa_descricao' => $this->getTaxa_descricao(),
            'taxa_valor' => $this->getTaxa_valor(),
            'taxa_id' => $this->getTaxa_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setTaxa_id((isset($object->taxa_id) ? $object->taxa_id : null));
        $this->setTaxa_descricao((isset($object->taxa_descricao) ? $object->taxa_descricao : null));
        $this->setTaxa_valor((isset($object->taxa_valor) ? $object->taxa_valor : null));
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
    function getTaxa_id() {
        return $this->taxa_id;
    }

    function getTaxa_descricao() {
        return $this->taxa_descricao;
    }

    function getTaxa_valor() {
        return $this->taxa_valor;
    }

    function setTaxa_id($taxa_id) {
        $this->taxa_id = $taxa_id;
    }

    function setTaxa_descricao($taxa_descricao) {
        $this->taxa_descricao = $taxa_descricao;
    }

    function setTaxa_valor($taxa_valor) {
        $this->taxa_valor = $taxa_valor;
    }

}
