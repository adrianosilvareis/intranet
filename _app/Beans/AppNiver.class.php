<?php

/**
 * AppNiver.class.php [Beans]
 * 
 * Classe que representa a tabela app_niver do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class AppNiver extends Beans {

    private $niver_id;
    private $niver_nome;
    private $niver_setor;
    private $niver_data;

    function __construct() {
        $this->Controle = new Controle('app_niver');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'niver_nome' => $this->getNiver_nome(),
            'niver_setor' => $this->getNiver_setor(),
            'niver_date' => $this->getNiver_data(),
            'niver_id' => $this->getNiver_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setNiver_id((isset($object->niver_id) ? $object->niver_id : null));
        $this->setNiver_nome((isset($object->niver_nome) ? $object->niver_nome : null));
        $this->setNiver_setor((isset($object->niver_setor) ? $object->niver_setor : null));
        $this->setNiver_data((isset($object->niver_data) ? $object->niver_data : null));
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
    function getNiver_id() {
        return $this->niver_id;
    }

    function getNiver_nome() {
        return $this->niver_nome;
    }

    function getNiver_setor() {
        return $this->niver_setor;
    }

    function getNiver_data() {
        return $this->niver_data;
    }

    function setNiver_id($niver_id) {
        $this->niver_id = $niver_id;
    }

    function setNiver_nome($niver_nome) {
        $this->niver_nome = $niver_nome;
    }

    function setNiver_setor($niver_setor) {
        $this->niver_setor = $niver_setor;
    }

    function setNiver_data($niver_data) {
        $this->niver_data = $niver_data;
    }

}
