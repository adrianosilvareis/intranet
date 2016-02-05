<?php

/**
 * SftInputAdmin.class.php [Beans]
 * 
 * Classe que representa a tabela sft_input_aten do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class SftInputAten extends Beans {

    private $aten_id_idaten;
    private $aten_nm_nmaten;
    private $aten_us_usaten;

    function __construct() {
        $this->Controle = new Controle('sft_input_aten');
        $this->Controle->setDBConn(['DB_HOST' => '187.115.148.178', 'DB_NAME' => 'faturamento', 'DB_USER' => DB_USER, 'DB_PASS' => DB_PASS]);
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'aten_nm_nmaten' => $this->getAten_nm_nmaten(),
            'aten_us_usaten' => $this->getAten_us_usaten(),
            'aten_id_idaten' => $this->getAten_id_idaten()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setAten_id_idaten((isset($object->aten_id_idaten) ? $object->aten_id_idaten : null));
        $this->setAten_nm_nmaten((isset($object->aten_nm_nmaten) ? $object->aten_nm_nmaten : null));
        $this->setAten_us_usaten((isset($object->aten_us_usaten) ? $object->aten_us_usaten : null));
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
    function getAten_id_idaten() {
        return $this->aten_id_idaten;
    }

    function getAten_nm_nmaten() {
        return $this->aten_nm_nmaten;
    }

    function getAten_us_usaten() {
        return $this->aten_us_usaten;
    }

    function setAten_id_idaten($aten_id_idaten) {
        $this->aten_id_idaten = $aten_id_idaten;
    }

    function setAten_nm_nmaten($aten_nm_nmaten) {
        $this->aten_nm_nmaten = $aten_nm_nmaten;
    }

    function setAten_us_usaten($aten_us_usaten) {
        $this->aten_us_usaten = $aten_us_usaten;
    }

}
