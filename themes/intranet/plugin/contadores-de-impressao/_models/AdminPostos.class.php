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

    function __construct() {
        $this->Read = new AppPostos();
        $this->Read->Execute()->Query("postos_ativo = 1");
        $this->Result = $this->Read->Execute()->getResult();

        $this->Executar();
    }

    public function getConcluidos() {
        return $this->Conc;
    }

    public function getRestantes() {
        return $this->Rest;
    }

    /**
     * ****************************************
     * ************* PRIVATES *****************
     * ****************************************
     */
    private function Executar() {
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
