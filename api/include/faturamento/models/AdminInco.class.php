<?php

/**
 * AdminInco.class.php [ Models Admin ]
 * Responsavel por gerenciar as inconsistencias do sistema
 *
 * @copyright (c) 2015 AdrianoReis PROGRAMADOR
 */
class AdminInco {

    private $Data;
    private $Inco;
    private $Error;
    private $Result;
    private $Read;
    private $Unidade;
    private $Usuario;
    private $Inconsistencia;
    private $Convenio;

    public function __construct() {
        $this->Read = new SftInconsistenciaGuia();
        
        $this->Unidade = ['postos_id' => '0','postos_nome' => 'Desativado','postos_numero' => '0','postos_ativo' => '0'];
        $this->Usuario = ['user_id' => '0','user_nickname' => 'DESATIVADO','user_name' => '-','user_lastname' => '-','user_email' => '-'];        
        $this->Inconsistencia = ['ncon_id' => '1','ncon_title' => '-','ncon_content' => '-','ncon_date' => '16/08/2016','ncon_status' => '0'];
        $this->Convenio = ['conv_id' => '','conv_title' => '-','conv_name' => '-','conv_describe' => '-','conv_date' => '-','conv_code' => '-','conv_status' => '0','post_id' => '',];
    }

    public function Find($id) {
        $this->Read->setInco_id($id);
        $this->Read->Execute()->find();
        Check::JsonReturn($this->Read->Execute()->getResult(), 'Inconsistência de Guia não encontrada!', '404');
    }

    public function FindAll() {
        $this->Read->Execute()->findAll();
        Check::JsonReturn($this->Read->Execute()->getResult(), 'Nenhuma Inconsistência cadastrada!', '204');
    }

    public function ExeCreate($Data) {
        $this->Data = (array) $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um post, favor preencha todos os campos!", WS_ALERT];
            $this->Result = FALSE;
        else:
            $this->setData();
            $this->Create();
        endif;
        $this->Data = null;
    }

    public function ExeUpdate($IncoId, $Data) {
        $this->Inco = (int) $IncoId;
        $this->Data = (array) $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este post, preencha todos os campos ( Capa não precisa ser enviada! )", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->Update();
        endif;
        $this->Data = null;
    }

    public function ExeExport($request) {

        foreach ($request as $inco):

            $inco = $this->LimparAten($inco);
            $inco = $this->LimparFatur($inco);

            $aten = (isset($inco->aten) ? $inco->aten : $this->Usuario);
            $unid = (isset($inco->unid) ? $inco->unid : $this->Unidade);
            $ncon = (isset($inco->ncon) ? $inco->ncon : $this->Inconsistencia);
            $conv = (isset($inco->conv) ? $inco->conv : $this->Convenio);
            $fatur = (isset($inco->faturista) ? $inco->faturista : $this->Usuario);

            unset($inco->aten);
            unset($inco->unid);
            unset($inco->ncon);
            unset($inco->conv);
            unset($inco->fatur);
            unset($inco->faturista);

            $result[] = array_merge((array) $inco, (array) $aten, (array) $unid, (array) $ncon, (array) $conv, (array) $fatur);

        endforeach;

        Check::ToCsv("relatorio_de_inconsistencias", $result);
        http_response_code(200);
    }

    public function ExeDelete($IncoId) {
        $this->Inco = (int) $IncoId;

        $this->Read->setInco_id($this->Inco);
        echo json_encode($this->Read->Execute()->delete());
    }

    function getError() {
        return $this->Error;
    }

    function getResult() {
        return $this->Result;
    }

    /**
     * ****************************************
     * *************** PRIVATES ***************
     * ****************************************
     */
    private function setData() {

        unset($this->Data['aten']);
        unset($this->Data['unid']);
        unset($this->Data['conv']);
        $this->Data['inco_value'] = Check::toFloat($this->Data['inco_value']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
    }

    private function LimparAten($inco) {
        unset($inco->aten->user_password);
        unset($inco->aten->user_level);
        unset($inco->aten->user_registration);
        unset($inco->aten->user_lastupdate);
        unset($inco->aten->perfil_id);
        unset($inco->aten->area_id);
        unset($inco->aten->user_cover);
        unset($inco->aten->user_birthday);
        unset($inco->aten->user_status);

        return $inco;
    }

    private function LimparFatur($inco) {
        unset($inco->fatur->user_password);
        unset($inco->fatur->user_level);
        unset($inco->fatur->user_registration);
        unset($inco->fatur->user_lastupdate);
        unset($inco->fatur->perfil_id);
        unset($inco->fatur->area_id);
        unset($inco->fatur->user_cover);
        unset($inco->fatur->user_birthday);
        unset($inco->fatur->user_status);

        if (isset($inco->fatur)):
            $inco->faturista = new stdClass();
            $inco->faturista->fatur_id = $inco->fatur->user_id;
            $inco->faturista->fatur_nickname = $inco->fatur->user_nickname;
            $inco->faturista->fatur_name = $inco->fatur->user_name;
            $inco->faturista->fatur_lastname = $inco->fatur->user_lastname;
            $inco->faturista->fatur_email = $inco->fatur->user_email;
        endif;

        return $inco;
    }

    private function Create() {
        $userlogin = (Check::UserLogin() ? (object) Check::UserLogin() : null);

        $this->Data['faturista_id'] = $userlogin->user_id;
        $this->Data['inco_date'] = date('Y-m-d');

        $this->Read->setThis((object) $this->Data);

        $this->Data['inco_id'] = ($this->Read->Execute()->insert() ?
                        (int) $this->Read->Execute()->MaxFild("inco_id") : null);

        echo json_encode((object) $this->Data);
    }

    private function Update() {
        $this->Read->setThis((object) $this->Data);
        $this->Read->Execute()->update(null, 'inco_id');

        echo json_encode($this->Data);
    }

}
