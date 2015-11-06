<?php

/**
 * AppPostos.class.php [Beans]
 * 
 * Classe que representa a tabela app_postos do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class AppPostos extends Beans {

    private $postos_id;
    private $postos_nome;
    private $postos_numero;
    private $postos_ativo;

    function __construct() {
        $this->Controle = new Controle('app_postos');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'postos_nome' => $this->getPostos_nome(),
            'postos_numero' => $this->getPostos_numero(),
            'postos_ativo' => $this->getPostos_ativo(),
            'postos_id' => $this->getPostos_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setPostos_id((isset($object->postos_id) ? $object->postos_id : null));
        $this->setPostos_nome((isset($object->postos_nome) ? $object->postos_nome : null));
        $this->setPostos_numero((isset($object->postos_numero) ? $object->postos_numero : null));
        $this->setPostos_ativo((isset($object->postos_ativo) ? $object->postos_ativo : null));
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
    function getPostos_id() {
        return $this->postos_id;
    }

    function getPostos_nome() {
        return $this->postos_nome;
    }

    function getPostos_numero() {
        return $this->postos_numero;
    }

    function getPostos_ativo() {
        return $this->postos_ativo;
    }

    function setPostos_id($postos_id) {
        $this->postos_id = $postos_id;
    }

    function setPostos_nome($postos_nome) {
        $this->postos_nome = $postos_nome;
    }

    function setPostos_numero($postos_numero) {
        $this->postos_numero = $postos_numero;
    }

    function setPostos_ativo($postos_ativo) {
        $this->postos_ativo = $postos_ativo;
    }

}
