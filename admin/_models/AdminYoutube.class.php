<?php

/**
 * AdminYoutube.class.php [ Models Admin ]
 * Responsavel por gerenciar os videos do youtube do sistema no Admin
 *
 * @copyright (c) 2015, Adriano Reis
 */
class AdminYoutube {

    private $Data;
    private $Tube;
    private $Error;
    private $Result;

    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um video, favor preencha todos os campos!", WS_ALERT];
            $this->Result = FALSE;
        else:
            $this->setData();
            $this->setName();
            $this->Create();
        endif;
    }

    public function ExeUpdate($TubeId, array $Data) {
        $this->Tube = (int) $TubeId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este video, preencha todos os campos.", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();
            $this->ExeStatus($TubeId, $Data['youtube_status']);
            $this->Update();
        endif;
    }

    public function ExeDelete($TubeId) {
        $this->Tube = (int) $TubeId;

        $Read = new AppYoutube();
        $Read->setYoutube_id($this->Tube);
        $Read->Execute()->find();

        if (!$Read->Execute()->getResult()):
            $this->Error = ['O video que você tentou deletar não existe no sistema!', WS_ERROR];
            $this->Result = false;
        else:
            $Deletado = $Read->Execute()->getResult();

            $Read->setYoutube_id($this->Tube);
            $Read->Execute()->delete();

            $this->Error = ["O video <b>{$Deletado->youtube_title}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
        endif;
    }

    public function ExeStatus($TubeId, $TubeStatus) {
        $this->Tube = (int) $TubeId;
        $this->Data['youtube_status'] = (string) $TubeStatus;

        $Read = new Controle('app_youtube');
        $this->Data['youtube_id'] = $this->Tube;
        $Read->update($this->Data, "youtube_id");
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
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        $this->Data['youtube_date'] = Check::Data($this->Data['youtube_date']);
    }

    private function setName() {
        $Where = (isset($this->Tube) ? "youtube_id != {$this->Tube} AND " : "");
        $Read = new AppYoutube();
        $Read->setYoutube_title($this->Data['youtube_title']);
        $Read->Execute()->Query("{$Where}#youtube_title#");

        if ($Read->Execute()->getResult()):
            $this->Data['youtube_title'] = $this->Data['youtube_title'] . '-' . $Read->Execute()->getRowCount();
        endif;
    }

    private function Create() {
        $cadastra = new AppYoutube();
        $this->Data['youtube_id'] = null;
        $cadastra->setThis((object) $this->Data);

        if ($cadastra->Execute()->insert()):
            $this->Error = ["O video <b>{$this->Data['youtube_title']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $cadastra->Execute()->MaxFild("youtube_id");
        endif;
    }

    private function Update() {
        $Update = new AppYoutube();
        $this->Data['youtube_id'] = $this->Tube;
        $this->Data['youtube_date'] = date('Y-m-d H:i:s');
        $Update->setThis((object) $this->Data);

        if ($Update->Execute()->update(null, 'youtube_id')):
            $this->Error = ["O video <b>{$this->Data['youtube_title']}</b> foi atualizado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $Update->Execute()->MaxFild("youtube_id");
        endif;
    }

}
