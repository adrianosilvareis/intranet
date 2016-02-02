<?php

/**
 * AgendaContatos.class.php [Beans]
 * 
 * Classe que representa a tabela agenda_contatos do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class AgendaContatos extends Beans {

    private $contato_id;
    private $contato_descricao;
    private $contato_telefone;
    private $contato_email;
    private $contato_site;
    private $contato_obs;
    private $endereco_id;
    private $setor_id;

    function __construct() {
        $this->Controle = new Controle('agenda_contatos');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'contato_descricao' => $this->getContato_descricao(),
            'contato_telefone' => $this->getContato_telefone(),
            'contato_email' => $this->getContato_email(),
            'contato_site' => $this->getContato_site(),
            'contato_obs' => $this->getContato_obs(),
            'endereco_id' => $this->getEndereco_id(),
            'setor_id' => $this->getSetor_id(),
            'contato_id' => $this->getContato_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setContato_id((isset($object->contato_id) ? $object->contato_id : null));
        $this->setContato_descricao((isset($object->contato_descricao) ? $object->contato_descricao : null));
        $this->setContato_telefone((isset($object->contato_telefone) ? $object->contato_telefone : null));
        $this->setContato_email((isset($object->contato_email) ? $object->contato_email : null));
        $this->setContato_site((isset($object->contato_site) ? $object->contato_site : null));
        $this->setContato_obs((isset($object->contato_obs) ? $object->contato_obs : null));
        $this->setEndereco_id((isset($object->endereco_id) ? $object->endereco_id : null));
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
    function getContato_id() {
        return $this->contato_id;
    }

    function getContato_descricao() {
        return $this->contato_descricao;
    }

    function getContato_telefone() {
        return $this->contato_telefone;
    }

    function getContato_email() {
        return $this->contato_email;
    }

    function getContato_site() {
        return $this->contato_site;
    }

    function getContato_obs() {
        return $this->contato_obs;
    }

    function getEndereco_id() {
        return $this->endereco_id;
    }

    function getSetor_id() {
        return $this->setor_id;
    }

    function setContato_id($contato_id) {
        $this->contato_id = $contato_id;
    }

    function setContato_descricao($contato_descricao) {
        $this->contato_descricao = $contato_descricao;
    }

    function setContato_telefone($contato_telefone) {
        $this->contato_telefone = $contato_telefone;
    }

    function setContato_email($contato_email) {
        $this->contato_email = $contato_email;
    }

    function setContato_site($contato_site) {
        $this->contato_site = $contato_site;
    }

    function setContato_obs($contato_obs) {
        $this->contato_obs = $contato_obs;
    }

    function setEndereco_id($endereco_id) {
        $this->endereco_id = $endereco_id;
    }

    function setSetor_id($setor_id) {
        $this->setor_id = $setor_id;
    }

}
