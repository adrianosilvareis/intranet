<?php

/**
 * AgendaSetor.class.php [Beans]
 * 
 * Classe que representa a tabela agenda_setor do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class AgendaSetor extends Beans {

    private $setor_id;
    private $setor_descricao;

    function __construct() {
        $this->Controle = new Controle('agenda_setor');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'setor_descricao' => $this->getSetor_descricao(),
            'setor_id' => $this->getSetor_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setSetor_id((isset($object->setor_id) ? $object->setor_id : null));
        $this->setSetor_descricao((isset($object->setor_descricao) ? $object->setor_descricao : null));
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
    function getSetor_id() {
        return $this->setor_id;
    }

    function getSetor_descricao() {
        return $this->setor_descricao;
    }

    function setSetor_id($setor_id) {
        $this->setor_id = $setor_id;
    }

    function setSetor_descricao($setor_descricao) {
        $this->setor_descricao = $setor_descricao;
    }

}
