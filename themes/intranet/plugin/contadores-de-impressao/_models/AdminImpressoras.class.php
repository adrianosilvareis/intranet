<?php

/**
 * AdminImpressoras.class.php [ Models Admin ]
 * Responsavel por gerenciar as impressoras do posto no Admin
 *
 * @copyright (c) 2015, Adriano Reis
 */
class AdminImpressoras {

    private $Result;
    private $Read;
    private $Data;
    private $Error;
    private $Registro;
    private $Imp;

    function __construct($postos = null) {
        $this->Read = new AppImpressora();
        $this->Registro = new AppContadores();

        if (!empty($postos)):
            $this->Result = $this->Read->Execute()->Query("impressora_status = 0 AND fk_postos = $postos");
            $this->Imp = $this->Result[0]->impressora_id;

            if (!empty($this->Result)):
                $this->Result = $this->Read->Execute()->Query("fk_postos = $postos");
            elseif ($this->Read->Execute()->Query("fk_postos = $postos")):
                $this->Result = "ok";
                header("Location: " . HOME . "/plugin/contadores-de-impressao/ok");
            else:
                $this->Result = "erro";
                header("Location: " . HOME . "/plugin/contadores-de-impressao/erro");
            endif;
        endif;
    }

    /**
     * Libera todas as impressoras para um novo lote de registros.
     */
    public function ExeUnlock() {
        $this->Read->Execute()->findAll();

        foreach ($this->Read->Execute()->getResult() as $imp):
            $this->Read->setThis($imp);
            $this->Read->Execute()->update("impressora_id={$imp->impressora_id}&impressora_status=0", "impressora_id");
        endforeach;
    }

    /**
     * Cria o registro de contadores.
     * 
     * @param AppImpressora $Data
     */
    public function ExeRegister($Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ["<b>Erro ao Cadastrar:</b> Para registrar o contador, preencha todos os campos!", WS_ALERT];
        else:
            $this->setData();
            $this->Registra();
        endif;
    }

    /**
     * Cria impressora no sistema.
     * 
     * @param array $Data
     * @return boolean
     */
    public function ExeCreate($Data) {
        $this->Data = $Data;
        $this->setData();
        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        $this->Result = $this->Read->Execute()->MaxFild("impressora_id");
        return $insert;
    }
    
    /**
     * Atualiza impressora no sistema;
     * 
     * @param array $Data
     * @return boolean
     */
    public function ExeUpdate($Data) {
        $this->Data = $Data;
        $this->setData();
        $this->Read->setThis((object) $this->Data);
        return $this->Read->Execute()->update(null, "impressora_id");
    }
    
    /**
     * Atualiza o status da impressora no sistema;
     * 
     * @param int $impressora_id
     * @param boolean $impressora_status
     */
    public function ExeStatus($impressora_id, $impressora_status) {
        $this->Read->Execute()->update("impressora_id=$impressora_id&impressora_status=$impressora_status", "impressora_id");
    }

    /**
     * Deleta impressora se não existir contadores
     * 
     * @param int $fk_impressora
     * @return boolean
     */
    public function ExeDelete($fk_impressora) {
        $AppContadores = new AppContadores();
        $AppContadores->setFk_impressora($fk_impressora);
        $AppContadores->Execute()->Query("#fk_impressora#");
        if ($AppContadores->Execute()->getResult()):
            WSErro("Impossivel excluir impressora, já existem contadores registrados!", WS_ERROR);
        else:
            $this->Read->Execute()->find("impressora_id");
            return $this->Read->Execute()->delete();
        endif;
    }
    
    /**
     * Retorna impressora com serial informado
     * 
     * @param String $impressora_serial
     * @return object:impressora
     */
    public function FindSerial($impressora_serial) {
        $this->Read->setImpressora_serial($impressora_serial);
        $this->Read->Execute()->Query("#impressora_serial#");
        return (!empty($this->Read->Execute()->getResult()[0]) ? $this->Read->Execute()->getResult()[0] : null);
    }
    
    /**
     * Retorna impressora com id informado
     * 
     * @param int $impressora_id
     * @return object:impressora
     */
    public function FindId($impressora_id) {
        $this->Read->setImpressora_id($impressora_id);
        $this->Read->Execute()->Query("#impressora_id#");
        return (!empty($this->Read->Execute()->getResult()[0]) ? $this->Read->Execute()->getResult()[0] : null);
    }

    /**
     * Encontra a descricao do modelo da impressora, com base no chave estrangeira.
     * 
     * @param int $modelo_id
     * @return String
     */
    public function Modelo($modelo_id) {
        $AppModelo = new AppModelo();
        $AppModelo->Execute()->find("modelo_id=$modelo_id");
        return $AppModelo->Execute()->getResult()->modelo_descricao;
    }

    /**
     * Encontra descricao do posto com base na chave estrangeira
     * 
     * @param int $postos_id
     * @return String
     */
    public function Posto($postos_id) {
        $AppPostos = new AppPostos();
        $AppPostos->Execute()->find("postos_id=$postos_id");
        return $AppPostos->Execute()->getResult()->postos_nome;
    }

    /**
     * Encontra descricao da taxa com base na chave estrangeira
     * 
     * @param int $taxa_id
     * @return String
     */
    public function Taxa($taxa_id) {
        $AppTaxaImpress = new AppTaxaImpress();
        $AppTaxaImpress->Execute()->find("taxa_id=$taxa_id");
        return $AppTaxaImpress->Execute()->getResult()->taxa_descricao;
    }

    /**
     * Retorna o maior contador, caso o informado sejá menor ou igual ao maior já registrado no banco.
     * 
     * @param int $Cont
     * @param int $imp
     * @return boolean
     */
    public function MinContador($Cont, $imp) {
        $this->Imp = $imp;
        $query = $this->Registro->Execute()->Query("fk_impressora = {$this->Imp} ORDER BY contadores_contador DESC LIMIT 1");

        if (!empty($query[0]) && $query[0]->contadores_contador < $Cont):
            return false;
        else:
            return $query;
        endif;
    }

    /**
     * Retorna o status da impressora, 
     * false = impressora já registrada.
     * true = impressora pendente.
     * nulo = impressora não existe.
     * 
     * @param int $fk_postos
     * @param int $impressora_id
     * @return boolean|string
     */
    public function CheckStatus($fk_postos, $impressora_id) {
        $this->Read->Execute()->Query("fk_postos = {$fk_postos} AND impressora_id = {$impressora_id}");

        if (!empty($this->Read->Execute()->getResult())):
            if (!$this->Read->Execute()->getResult()[0]->impressora_status):
                return $this->Read->Execute()->getResult()[0];
            else:
                return false;
            endif;
        else:
            return "nulo";
        endif;
    }

    public function getResult() {
        return $this->Result;
    }

    /**
     * ****************************************
     * ************* PRIVATES *****************
     * ****************************************
     */

    /**
     * trata entrada de dados
     */
    private function setData() {
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        $this->Data['contadores_data'] = date("Y-m-d H:i:s");
        unset($this->Data['serial']);
    }

    /**
     * Registra os contadores
     */
    private function Registra() {
        $this->Data['contadores_id'] = null;
        $this->Registro->setThis((object) $this->Data);
        $insert = $this->Registro->Execute()->insert();

        if ($insert):
            //WSErro("O Contador: {$this->Contador->Execute()->MaxFild('contadores_id')} foi registrado com sucesso! ", WS_ACCEPT);
            $update = $this->Read->Execute()->update("impressora_id={$this->Data['fk_impressora']}&impressora_status=1", "impressora_id");
            if (!$update):
                WSErro("Oppss! Erro ao atualizar a impressora! contacte o CPD", WS_ERROR);
            endif;
        endif;
    }

}
