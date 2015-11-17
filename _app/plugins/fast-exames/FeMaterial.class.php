<?php

/**
 * FeMaterial.class.php [Beans]
 * 
 * Classe que representa a tabela fe_material do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class FeMaterial extends Beans{

    private $mat_id;
    private $mat_descricao;
    private $mat_status;
    
    function __construct() {
        $this->Controle = new Controle('fe_material');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'mat_descricao' => $this->getMat_descricao(),
            'mat_status' => $this->getMat_status(),
            'mat_id' => $this->getMat_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setMat_id((isset($object->mat_id) ? $object->mat_id : null));
        $this->setMat_status((isset($object->mat_status) ? $object->mat_status : null));
        $this->setMat_descricao((isset($object->mat_descricao) ? $object->mat_descricao : null));
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
    
    function getMat_id() {
        return $this->mat_id;
    }

    function getMat_descricao() {
        return $this->mat_descricao;
    }

    function getMat_status() {
        return $this->mat_status;
    }

    function setMat_id($mat_id) {
        $this->mat_id = $mat_id;
    }

    function setMat_descricao($mat_descricao) {
        $this->mat_descricao = $mat_descricao;
    }

    function setMat_status($mat_status) {
        $this->mat_status = $mat_status;
    }


}
