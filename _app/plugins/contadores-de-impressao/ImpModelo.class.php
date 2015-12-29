<?php

/**
 * ImpModelo.class.php [Beans]
 * 
 * Classe que representa a tabela imp_modelo do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class ImpModelo extends Beans {

    private $modelo_id;
    private $modelo_descricao;
    private $modelo_status;

    function __construct() {
        $this->Controle = new Controle('imp_modelo');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'modelo_descricao' => $this->getModelo_descricao(),
            'modelo_status' => $this->getModelo_status(),
            'modelo_id' => $this->getModelo_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setModelo_id((isset($object->modelo_id) ? $object->modelo_id : null));
        $this->setModelo_descricao((isset($object->modelo_descricao) ? $object->modelo_descricao : null));
        $this->setModelo_status((isset($object->modelo_status) ? $object->modelo_status : null));
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
    function getModelo_id() {
        return $this->modelo_id;
    }

    function getModelo_descricao() {
        return $this->modelo_descricao;
    }

    function setModelo_id($modelo_id) {
        $this->modelo_id = $modelo_id;
    }

    function setModelo_descricao($modelo_descricao) {
        $this->modelo_descricao = $modelo_descricao;
    }
    
    function getModelo_status() {
        return $this->modelo_status;
    }

    function setModelo_status($modelo_status) {
        $this->modelo_status = $modelo_status;
    }

}
