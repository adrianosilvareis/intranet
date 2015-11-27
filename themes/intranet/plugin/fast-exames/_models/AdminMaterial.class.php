<?php

/**
 * AdminMaterial.class [TIPO]
 * Descricao
 * @copyright (c) year, Adriano S. Reis Programador
 */
class AdminMaterial {

    private $Read;
    private $Result;
    private $Data;

    function __construct() {
        $this->Read = new FeMaterial();
    }

    /**
     * Cadastra Materiais no sistema
     * 
     * @param array $Data
     * @return boolean
     */
    public function ExeCreate($Data) {
        $this->Data = $Data;
        $this->setData();

        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        $this->Result = $this->Result = $this->Read->Execute()->MaxFild("mat_id");
        return $insert;
    }

    /**
     * Atualiza materiais do sistema
     * 
     * @param array $Data
     * @return booelan
     */
    function ExeUpdate($Data) {
        $this->Data = $Data;
        $this->setData();

        $this->Read->setThis((object) $this->Data);
        if ($this->Read->Execute()->update(null, 'mat_id') || $this->ExeStatus($this->Data['mat_id'], $this->Data['mat_status'])):
            return true;
        else:
            return false;
        endif;
    }

    public function ExeDelete($mat_id) {
        $FeExames = new FeExames();
        $FeExames->setFe_material($mat_id);
        $FeExames->Execute()->Query("#fe_material#");

        if (!$FeExames->Execute()->getResult()):
            $this->Read->setMat_id($mat_id);
            return $this->Read->Execute()->delete();
        endif;
    }

    /**
     * altera o status do material com Id informado
     * 
     * @param int $MaterialId
     * @param booelan $MaterialStatus
     * @return booelan
     */
    public function ExeStatus($MaterialId, $MaterialStatus) {
        return $this->Read->Execute()->update("mat_id=$MaterialId&mat_status=$MaterialStatus", "mat_id");
    }

    /**
     * retorna o resultado das operações realizadas na class
     * 
     * @return type
     */
    function getResult() {
        return $this->Result;
    }

    /**
     * Encontra material com a descrição informada
     * 
     * @param string $mat_descricao
     * @return object
     */
    function FindName($mat_descricao) {
        $this->Read->setMat_descricao($mat_descricao);
        return $this->Read->Execute()->Query("#mat_descricao#");
    }

    function FindId($mat_id) {
        $this->Read->setMat_id($mat_id);
        return $this->Read->Execute()->find();
    }

    /**
     * ****************************************
     * ************* PRIVATES *****************
     * ****************************************
     */

    /**
     * Tratamento de entrada de dados
     * 
     * Limpa campos em branco e codigos indevidos, na entrada de dados
     */
    private function setData() {
        $this->Data = array_map("strip_tags", $this->Data);
        $this->Data = array_map("trim", $this->Data);
    }

}
