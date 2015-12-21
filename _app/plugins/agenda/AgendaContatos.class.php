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
    private $contato_endereco;
    private $contato_cidade;
    private $contato_estados;
    private $contato_setor;

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
            'contato_endereco' => $this->getContato_endereco(),
            'contato_cidade' => $this->getContato_cidade(),
            'contato_estados' => $this->getContato_estados(),
            'contato_setor' => $this->getContato_setor(),
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
        $this->setContato_endereco((isset($object->contato_endereco) ? $object->contato_endereco : null));
        $this->setContato_cidade((isset($object->contato_cidade) ? $object->contato_cidade : null));
        $this->setContato_estados((isset($object->contato_estados) ? $object->contato_estados : null));
        $this->setContato_setor((isset($object->contato_setor) ? $object->contato_setor : null));
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

    function getContato_endereco() {
        return $this->contato_endereco;
    }

    function getContato_cidade() {
        return $this->contato_cidade;
    }

    function getContato_estados() {
        return $this->contato_estados;
    }

    function getContato_setor() {
        return $this->contato_setor;
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

    function setContato_endereco($contato_endereco) {
        $this->contato_endereco = $contato_endereco;
    }

    function setContato_cidade($contato_cidade) {
        $this->contato_cidade = $contato_cidade;
    }

    function setContato_estados($contato_estados) {
        $this->contato_estados = $contato_estados;
    }

    function setContato_setor($contato_setor) {
        $this->contato_setor = $contato_setor;
    }

}
