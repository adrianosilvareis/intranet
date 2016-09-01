<?php

/**
 * AdminGlosa.class.php [ Models Admin ]
 * Responsavel por gerenciar as glosas do sistema
 *
 * @copyright (c) 2015 AdrianoReis PROGRAMADOR
 */
class AdminGlosa {

    private $Data;
    private $Glosa;
    private $Error;
    private $Result;
    private $Read;
    private $Unidade;
    private $Usuario;
    private $Glosas;
    private $Convenio;

    public function __construct() {
        $this->Read = new SftGlosaGuia();
        
        $this->Unidade = ['postos_id' => '0','postos_nome' => 'Desativado','postos_numero' => '0','postos_ativo' => '0'];
        $this->Usuario = ['user_id' => '0','user_nickname' => 'DESATIVADO','user_name' => '-','user_lastname' => '-','user_email' => '-'];
        $this->Glosas = ['ncon_id' => '1','ncon_title' => '-','ncon_content' => '-','ncon_date' => '16/08/2016','ncon_status' => '0'];
        $this->Convenio = ['conv_id' => '','conv_title' => '-','conv_name' => '-','conv_describe' => '-','conv_date' => '-','conv_code' => '-','conv_status' => '0','post_id' => '',];
    }

    public function Find($id) {
        $this->Read->setGlosa_id($id);
        $this->Read->Execute()->find();
        Check::JsonReturn($this->Read->Execute()->getResult(), 'Glosa de Guia não encontrada!', '404');
    }
            
    public function FindAll() {
        $this->Read->Execute()->findAll();
        Check::JsonReturn($this->Read->Execute()->getResult(), 'Nenhuma Glosa cadastrada!', '204');
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

    public function ExeUpdate($GlosId, $Data) {
        $this->Glosa = (int) $GlosId;
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

        foreach ($request as $glos):

            $glos = $this->LimparAten($glos);
            $glos = $this->LimparFatur($glos);

            $aten = (isset($glos->aten) ? $glos->aten : $this->Usuario);
            $unid = (isset($glos->unid) ? $glos->unid : $this->Unidade);
            $ncon = (isset($glos->ncon) ? $glos->ncon : $this->Glosas);
            $conv = (isset($glos->conv) ? $glos->conv : $this->Convenio);
            $fatur = (isset($glos->faturista) ? $glos->faturista : $this->Usuario);

            unset($glos->aten);
            unset($glos->unid);
            unset($glos->ncon);
            unset($glos->conv);
            unset($glos->fatur);
            unset($glos->faturista);

            $result[] = array_merge((array) $glos, (array) $aten, (array) $unid, (array) $ncon, (array) $conv, (array) $fatur);

        endforeach;

        Check::ToCsv("relatorio_de_glosa", $result);
        http_response_code(200);
    }

    public function ExeDelete($GlosId) {
        $this->Glosa = (int) $GlosId;

        $this->Read->setGlosa_id($this->Glosa);
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
        $this->Data['glosa_value'] = Check::toFloat($this->Data['glosa_value']);
        
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
    }

    private function LimparAten($glos) {
        unset($glos->aten->user_password);
        unset($glos->aten->user_level);
        unset($glos->aten->user_registration);
        unset($glos->aten->user_lastupdate);
        unset($glos->aten->perfil_id);
        unset($glos->aten->area_id);
        unset($glos->aten->user_cover);
        unset($glos->aten->user_birthday);
        unset($glos->aten->user_status);

        return $glos;
    }

    private function LimparFatur($glos) {
        unset($glos->fatur->user_password);
        unset($glos->fatur->user_level);
        unset($glos->fatur->user_registration);
        unset($glos->fatur->user_lastupdate);
        unset($glos->fatur->perfil_id);
        unset($glos->fatur->area_id);
        unset($glos->fatur->user_cover);
        unset($glos->fatur->user_birthday);
        unset($glos->fatur->user_status);

        if (isset($glos->fatur)):
            $glos->faturista = new stdClass();
            $glos->faturista->fatur_id = $glos->fatur->user_id;
            $glos->faturista->fatur_nickname = $glos->fatur->user_nickname;
            $glos->faturista->fatur_name = $glos->fatur->user_name;
            $glos->faturista->fatur_lastname = $glos->fatur->user_lastname;
            $glos->faturista->fatur_email = $glos->fatur->user_email;
        endif;

        return $glos;
    }

    private function Create() {
        $userlogin = (Check::UserLogin() ? (object) Check::UserLogin() : null);

        $this->Data['faturista_id'] = $userlogin->user_id;
        $this->Data['glosa_date'] = date('Y-m-d');

        $this->Read->setThis((object) $this->Data);

        $this->Data['glosa_id'] = ($this->Read->Execute()->insert() ?
                        (int) $this->Read->Execute()->MaxFild("glosa_id") : null);

        echo json_encode((object) $this->Data);
    }

    private function Update() {
        $this->Read->setThis((object) $this->Data);
        $this->Read->Execute()->update(null, 'glosa_id');

        echo json_encode($this->Data);
    }

}
