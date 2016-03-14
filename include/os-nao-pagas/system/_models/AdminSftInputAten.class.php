<?php

class AdminSftInputAten {

    private $Read;
    private $Result;
    private $Erro;

    function __construct() {
        $this->Read = new SftInputAten();
    }

    public function FindUser($User) {
        $this->Read->setAten_us_usaten($User);
        $this->Result = $this->Read->Execute()->Query("#aten_us_usaten#");
        if (!empty($this->Result)):
            return $this->Result[0]->aten_id_idaten;
        else:
            $this->Erro = "Atendente <b>$User</b> não cadastrado no sistema SFT.";
        endif;
    }

    public function getResult() {
        return $this->Result;
    }

    public function getErro() {
        return $this->Erro;
    }

}
