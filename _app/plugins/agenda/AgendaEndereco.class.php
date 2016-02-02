<?php


/**
 * AgendaEndereco.class.php [Beans]
 * 
 * Endereços dos contatos
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class AgendaEndereco{
    
    private $endereco_id;
    private $endereco_lagradouro;
    private $endereco_bairro;
    private $endereco_numero;
    private $endereco_cep;
    private $app_cidade;
    
    function __construct() {
        $this->Controle = new Controle('agenda_endereco');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'endereco_lagradouro' => $this->getEndereco_lagradouro(),
            'endereco_bairro' => $this->getEndereco_bairro(),
            'endereco_numero' => $this->getEndereco_numero(),
            'endereco_cep' => $this->getEndereco_cep(),
            'app_cidade' => $this->getApp_cidade(),
            'endereco_id' => $this->getEndereco_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setEndereco_id((isset($object->endereco_id) ? $object->endereco_id : null));
        $this->setEndereco_lagradouro((isset($object->endereco_lagradouro) ? $object->endereco_lagradouro : null));
        $this->setEndereco_bairro((isset($object->endereco_bairro) ? $object->endereco_bairro : null));
        $this->setEndereco_numero((isset($object->endereco_numero) ? $object->endereco_numero : null));
        $this->setEndereco_cep((isset($object->endereco_cep) ? $object->endereco_cep : null));
        $this->setApp_cidade((isset($object->app_cidade) ? $object->app_cidade : null));
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
    function getEndereco_id() {
        return $this->endereco_id;
    }

    function getEndereco_lagradouro() {
        return $this->endereco_lagradouro;
    }

    function getEndereco_bairro() {
        return $this->endereco_bairro;
    }

    function getEndereco_numero() {
        return $this->endereco_numero;
    }

    function getEndereco_cep() {
        return $this->endereco_cep;
    }

    function getApp_cidade() {
        return $this->app_cidade;
    }

    function setEndereco_id($endereco_id) {
        $this->endereco_id = $endereco_id;
    }

    function setEndereco_lagradouro($endereco_lagradouro) {
        $this->endereco_lagradouro = $endereco_lagradouro;
    }

    function setEndereco_bairro($endereco_bairro) {
        $this->endereco_bairro = $endereco_bairro;
    }

    function setEndereco_numero($endereco_numero) {
        $this->endereco_numero = $endereco_numero;
    }

    function setEndereco_cep($endereco_cep) {
        $this->endereco_cep = $endereco_cep;
    }

    function setApp_cidade($app_cidade) {
        $this->app_cidade = $app_cidade;
    }

}
