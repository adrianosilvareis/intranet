<?php

/**
 * UserHasNcSetor.class.php [BEANS]
 * 
 * Representa a tabela user_has_nc_setor do banco de dados
 * tabela responsavel por criar uma ligação many-to-many entre as tabelas nc_registro e nc_origem
 * 
 * @copyright (c) 2016,  S. Reis, Adriano
 */
class RegistroHasOrigem extends Beans {

    private $user_id;
    private $setor_id;

    function __construct() {
        $this->Controle = new Controle('user_has_nc_setor');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'user_id' => $this->getUser_id(),
            'setor_id' => $this->getSetor_id(),
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setUser_id((isset($object->user_id) ? $object->user_id : null));
        $this->setSetor_id((isset($object->setor_id) ? $object->setor_id : null));
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
    function getUser_id() {
        return $this->user_id;
    }

    function getSetor_id() {
        return $this->setor_id;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setSetor_id($setor_id) {
        $this->setor_id = $setor_id;
    }

}
