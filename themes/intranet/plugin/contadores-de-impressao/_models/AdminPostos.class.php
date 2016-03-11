<?php

/**
 * AdminPostos.class.php [ Models Admin ]
 * Responsavel por gerenciar os postos do sistema no Admin
 *
 * @copyright (c) 2015, Adriano Reis
 */
class AdminPostos {

    private $Result;
    private $Read;
    private $Data;

    function __construct() {
        $this->Read = new ImpPostos();
    }

    /**
     * Executa a criacao dos postos no sistema
     * 
     * @param array $Data
     * @return boolean
     */
    public function ExeCreate($Data) {
        $this->Data = $Data;
        $this->setData();
        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        $this->Result = $this->Read->Execute()->MaxFild("postos_id");
        return $insert;
    }

    /**
     * Executa a atualização dos postos no sistema
     * 
     * @param array $Data
     * @return boolean
     */
    public function ExeUpdate($Data) {
        $this->Data = $Data;
        $this->setData();
        $this->Read->setThis((object) $this->Data);
        $status = $this->ExeStatus($this->Read->getPostos_id(), $this->Read->getPostos_ativo());
        $update = $this->Read->Execute()->update(null, "postos_id");
        if ($status || $update):
            return true;
        endif;
    }

    /**
     * Atualiza o status do posto no sistema
     * 
     * @param int $postoId
     * @param booelan $postoStatus
     * @return boolean
     */
    public function ExeStatus($postoId, $postoStatus) {
        $update = $this->Read->Execute()->update("postos_id={$postoId}&postos_ativo=$postoStatus", "postos_id");
        return $update;
    }

    /**
     * Deleta o posto e trasfere as impressoras para um posto desativado.
     * 
     * @param int $fk_postos
     * @return boolean
     */
    public function ExeDelete($fk_postos) {
        $AppImpressora = new ImpImpressora();
        $AppImpressora->setFk_postos($fk_postos);
        $AppImpressora->Execute()->Query("#fk_postos#");

        $posto = $this->Read->Execute()->getResult();

        $this->Read->setPostos_nome("DESATIVADO");
        $this->Read->Execute()->Query("#postos_nome#");
        $undeleteId = $this->Read->Execute()->getResult()[0]->postos_id;

        if ($fk_postos != $undeleteId):
            foreach ($AppImpressora->Execute()->getResult() as $imp):
                $AppImpressora->Execute()->update("fk_postos=$undeleteId&impressora_id=$imp->impressora_id", "impressora_id");
            endforeach;

            $this->Read->setThis($posto);
            return $this->Read->Execute()->delete();
        else:
            WSErro("O posto <b>DESATIVADO</b> não pode ser deletado!", WS_ERROR);
        endif;
    }

    /**
     * Lista todos os postos no sistema, quando não é admin.
     */
    public function Lista() {
        $Termos = "SELECT p.*, COUNT(i.impressora_id) as 'cont' "
                . "FROM imp_impressora i JOIN imp_postos p ON(p.postos_id = i.fk_postos) "
                . "WHERE i.impressora_status=0 AND p.postos_ativo=1 GROUP BY i.fk_postos";
        $this->Read->Execute()->FullRead($Termos);
        $this->Result = $this->Read->Execute()->getResult();
    }

    /**
     * Lista todos os postos do sistema quando é admin.
     */
    public function ListAdmin() {
        $Termos = "SELECT "
                . "p.*, "
                . "COUNT(i.impressora_id) as 'cont', "
                . "(SELECT COUNT(e.impressora_id) FROM imp_impressora e WHERE e.impressora_status=0 AND e.fk_postos = i.fk_postos) as 'restantes' "
                . "FROM imp_postos p JOIN imp_impressora i ON(p.postos_id = i.fk_postos) "
                . "GROUP BY i.fk_postos "
                . "ORDER BY (SELECT COUNT(e.impressora_id) FROM imp_impressora e WHERE e.impressora_status=0 AND e.fk_postos = i.fk_postos) DESC";
        $this->Read->Execute()->FullRead($Termos);
        $this->Result = $this->Read->Execute()->getResult();
    }

    /**
     * Retorna o posto com base no id
     * 
     * @param int $postoId
     * @return object:posto
     */
    public function getPostoId($postoId) {
        $this->Read->Execute()->find("postos_id={$postoId}");
        return $this->Read->Execute()->getResult();
    }

    /**
     * Retorna o posto com base no numero informado
     * 
     * @param int $postoNumero
     * @return object:posto
     */
    public function getPostoNumero($postoNumero) {
        $this->Read->Execute()->find("postos_numero={$postoNumero}");
        return $this->Read->Execute()->getResult();
    }

    /**
     * Lista em array de todas as impressoras do sistema
     * 
     * @return List:impressoras
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * ****************************************
     * ************* PRIVATES *****************
     * ****************************************
     */
    private function setData() {
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
    }
}
