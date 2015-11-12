<?php

/**
 * AdminPostos.class.php [ Models Admin ]
 * Responsavel por gerenciar os postos do sistema no Admin
 *
 * @copyright (c) 2015, Adriano Reis
 */
class AdminPostos {

    private $Conc;
    private $Rest;
    private $Result;
    private $Read;
    private $Data;

    function __construct() {
        $this->Read = new AppPostos();
    }

    public function ExeCreate($Data) {
        $this->Data = $Data;
        $this->setData();
        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        $this->Result = $this->Read->Execute()->MaxFild("postos_id");
        return $insert;
    }

    public function ExeUpdate($Data) {
        $this->Data = $Data;
        $this->setData();
        $this->Read->setThis((object) $this->Data);
        $status = $this->ExeStatus($this->Read->getPostos_id(), $this->Read->getPostos_ativo());
        $update = $this->Read->Execute()->update(null, "postos_id");
        if($status || $update):
            return true;
        endif;
    }

    public function ExeStatus($postoId, $postoStatus) {
        $update = $this->Read->Execute()->update("postos_id={$postoId}&postos_ativo=$postoStatus", "postos_id");
        return $update;
    }
    
    public function ExeDelete($fk_postos){
        $AppImpressora = new AppImpressora();
        $AppImpressora->setFk_postos($fk_postos);
        $AppImpressora->Execute()->Query("#fk_postos#");
        
        foreach ($AppImpressora->Execute()->getResult() as $imp):
            $update = new $AppImpressora();
            $update->setThis((object) $imp);
            $update->setFk_postos(666);
            var_dump($update);
            $update->Execute()->update(null, "impressora_id");
        endforeach;
    }
    
    public function Lista() {
        $this->Read->Execute()->Query("postos_ativo = 1");
        $this->Result = $this->Read->Execute()->getResult();
        $this->Executar();
    }

    public function ListAdmin() {
        $this->Read->Execute()->FullRead("SELECT * FROM app_postos ORDER BY postos_ativo");
        $this->Result = $this->Read->Execute()->getResult();
        $this->Executar();
    }

    public function getPostoId($postoId) {
        $this->Read->Execute()->find("postos_id={$postoId}");
        return $this->Read->Execute()->getResult();
    }

    public function getPostoNumero($postoNumero) {
        $this->Read->Execute()->find("postos_numero={$postoNumero}");
        return $this->Read->Execute()->getResult();
    }

    public function getConcluidos() {
        return $this->Conc;
    }

    public function getRestantes() {
        return $this->Rest;
    }

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

    public function Executar() {

        $AppImpressora = new AppImpressora();
        foreach ($this->Result as $posto) {
            //encontra todas as impressoras deste posto
            $impressoras = $AppImpressora->Execute()->Query("fk_postos = :posto", "posto=$posto->postos_id");

            //inicia os objetos concluidos e restantes
            $posto->cont = 0;
            $con = clone($posto);
            $res = clone($posto);

            //separa os objetos de acordo com seu status
            foreach ($impressoras as $imp):
                if ($imp->impressora_status):
                    $con->cont++;
                else:
                    $res->cont++;
                endif;
            endforeach;

            //seta os vetores caso sejam encontrados
            if ($con->cont):
                $this->Conc[] = $con;
            endif;
            if ($res->cont):
                $this->Rest[] = $res;
            endif;

            //seta a contagem de impressoras do resultado total
            $posto->cont = $AppImpressora->Execute()->getRowCount();
        }
    }

}
