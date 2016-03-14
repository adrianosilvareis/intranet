<?php

class AdminSftInputUnid {

    private $Read;
    private $Result;
    private $Erro;

    function __construct() {
        $this->Read = new SftInputUnid();
    }

    public function FindCod($Cod) {
        $this->Read->setUnid_cod_codigo($Cod);
        $this->Result = $this->Read->Execute()->Query("#unid_cod_codigo#");
        if (!empty($this->Result)):
            return $this->Result[0]->unid_id_idunid;
        else:
            $this->Erro = "Unidade <b>$Cod</b> não cadastrada no sistema SFT.";
        endif;
    }

    public function getResult() {
        return $this->Result;
    }

    public function getErro() {
        return $this->Erro;
    }

}
