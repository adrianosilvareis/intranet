<?php

/**
 * AdminPart.class.php [ Models Admin ]
 * Responsavel por gerenciar as particulares do sistema
 *
 * @copyright (c) 2015 AdrianoReis PROGRAMADOR
 */
class AdminPart {

    private $Data;
    private $Part;
    private $Error;
    private $Result;
    private $Read;
    private $Unidade;
    private $Usuario;
    private $Particulares;

    public function __construct() {
        $this->Read = new SftParticular();

        $this->Unidade = ['postos_id' => '0', 'postos_nome' => 'Desativado', 'postos_numero' => '0', 'postos_ativo' => '0'];
        $this->Usuario = ['user_id' => '0', 'user_nickname' => 'DESATIVADO', 'user_name' => '-', 'user_lastname' => '-', 'user_email' => '-'];
    }

    public function Find($id) {
        $this->Read->setPart_id($id);
        $this->Read->Execute()->find();
        Check::JsonReturn($this->Read->Execute()->getResult(), 'Os não encontrada!', '404');
    }

    public function FindAll() {
        $this->Read->Execute()->findAll();
        Check::JsonReturn($this->Read->Execute()->getResult(), 'Nenhuma OS cadastrada!', '204');
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

    public function ExeUpdate($PartId, $Data) {
        $this->Part = (int) $PartId;
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

        foreach ($request as $part):

            $part = $this->LimparAten($part);
            $part = $this->LimparFatur($part);

            $aten = (isset($part->aten) ? $part->aten : $this->Usuario);
            $unid = (isset($part->unid) ? $part->unid : $this->Unidade);
            $fatur = (isset($part->faturista) ? $part->faturista : $this->Usuario);

            unset($part->aten);
            unset($part->unid);
            unset($part->fatur);
            unset($part->faturista);

            $result[] = array_merge((array) $part, (array) $aten, (array) $unid, (array) $fatur);

        endforeach;

        Check::ToCsv("relatorio_de_inconsistencias", $result);
        http_response_code(200);
    }

    public function ExeDelete($PartId) {
        $this->Part = (int) $PartId;

        $this->Read->setInco_id($this->Part);
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

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
    }

    private function LimparAten($part) {
        unset($part->aten->user_password);
        unset($part->aten->user_level);
        unset($part->aten->user_registration);
        unset($part->aten->user_lastupdate);
        unset($part->aten->perfil_id);
        unset($part->aten->area_id);
        unset($part->aten->user_cover);
        unset($part->aten->user_birthday);
        unset($part->aten->user_status);

        return $part;
    }

    private function LimparFatur($part) {
        unset($part->fatur->user_password);
        unset($part->fatur->user_level);
        unset($part->fatur->user_registration);
        unset($part->fatur->user_lastupdate);
        unset($part->fatur->perfil_id);
        unset($part->fatur->area_id);
        unset($part->fatur->user_cover);
        unset($part->fatur->user_birthday);
        unset($part->fatur->user_status);

        if (isset($part->fatur)):
            $part->faturista = new stdClass();
            $part->faturista->fatur_id = $part->fatur->user_id;
            $part->faturista->fatur_nickname = $part->fatur->user_nickname;
            $part->faturista->fatur_name = $part->fatur->user_name;
            $part->faturista->fatur_lastname = $part->fatur->user_lastname;
            $part->faturista->fatur_email = $part->fatur->user_email;
        endif;

        return $part;
    }

    private function Create() {
        $userlogin = (Check::UserLogin() ? (object) Check::UserLogin() : null);

        $this->Data['faturista_id'] = $userlogin->user_id;
        $this->Data['part_date'] = date('Y-m-d');

        $this->Read->setThis((object) $this->Data);

        $this->Data['part_id'] = ($this->Read->Execute()->insert() ?
                        (int) $this->Read->Execute()->MaxFild("part_id") : null);

        echo json_encode((object) $this->Data);
    }

    private function Update() {
        $this->Read->setThis((object) $this->Data);
        $this->Read->Execute()->update(null, 'part_id');

        echo json_encode($this->Data);
    }

}
