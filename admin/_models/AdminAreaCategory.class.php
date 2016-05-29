<?php

/**
 * AdminAreaCategory.class.php [ Models Admin ]
 * Responsavel por gerenciar as categorias do sistema no Admin
 *
 * @copyright (c) 2015, Adriano Reis
 */
class AdminAreaCategory {

    private $Data;
    private $CatId;
    private $Error;
    private $Result;
    private $Read;

    /**
     * Executa a criação de novas categorias
     * 
     * @param array $Data
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ["<b>Erro ao Cadastrar:</b> Para Cadastrar uma categoria, preencha todos os campos!", WS_ALERT];
        else:
            $this->setData();
            $this->setNome();
            $this->Create();
        endif;
    }
    
    /**
     * Atualiza as categorias
     * 
     * @param int $CategoryId
     * @param array $Data
     */
    public function ExeUpdate($CategoryId, array $Data) {
        $this->CatId = (int) $CategoryId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ["<b>Erro ao atualizar:</b> Para atualizar a categoria {$this->Data['category_title']}, preencha todos os campos!", WS_ALERT];
        else:
            $this->setData();
            $this->setNome();
            $this->Update();
        endif;
    }

    /**
     * Deleta as categorias
     * 
     * @param int $CategoryId
     */
    public function ExeDelete($CategoryId) {
        $this->CatId = (int) $CategoryId;

        $WsAreaCategories = new WsAreaCategory;
        $WsAreaCategories->setCategory_id($this->CatId);
        $WsAreaCategories->Execute()->Query("#category_id#");
        if (!$WsAreaCategories->Execute()->getResult()):
            $this->Result = false;
            $this->Error = ['Oppsss, você tentou remover uma categoria que não existe no sistema!', WS_INFOR];
        else:
            extract((array) $WsAreaCategories->Execute()->getResult()[0]);
            
            if (!$category_parent && !$this->checkCats()):
                $this->Result = false;
                $this->Error = ["A <b>seção {$category_title}</b> possui categorias cadastradas. Para deletar, antes altere ou remova todas as categorias filhas!", WS_ALERT];
            elseif ($category_parent && !$this->checkArea()):
                $this->Result = false;
                $this->Error = ["A <b>categoria {$category_title}</b> possui artigos cadastradas. Para deletar, antes altere ou remova todos os users desta categoria!", WS_ALERT];
            else:
                $this->Result = true;
                $tipo = ( empty($category_parent) ? 'seção' : 'categoria' );
                $WsAreaCategories->setCategory_id($this->CatId);
                $WsAreaCategories->Execute()->delete();
                $this->Error = ["A <b>{$tipo} {$category_title}</b> foi removida com sucesso do sistema!", WS_ACCEPT];
            endif;
        endif;
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
        $this->Data['category_name'] = Check::Name($this->Data['category_title']);
        $this->Data['category_date'] = Check::Data($this->Data['category_date']);
        $this->Data['category_parent'] = ($this->Data['category_parent'] == 'null' ? null : $this->Data['category_parent']);
    }

    private function setNome() {
        $Where = (!empty($this->CatId) ? "category_id != {$this->CatId} AND " : '');
        $this->Read = new WsAreaCategory();
        $this->Read->setCategory_title($this->Data['category_title']);
        $this->Read->Execute()->Query("{$Where}#category_title#");
        if ($this->Read->Execute()->getResult()):
            $this->Data['category_name'] = $this->Data['category_name'] . '-' . $this->Read->Execute()->getRowCount();
        endif;
    }

    //verifica categorias da seção
    private function checkCats() {
        $Read = new WsAreaCategory;
        $Read->setCategory_parent($this->CatId);
        $Read->Execute()->Query("#category_parent#");
        if (!empty($Read->Execute()->getResult()[0])):
            return false;
        else:
            return true;
        endif;
    }

    //verifica artigos da categoria
    private function checkArea() {
        $readArea = new WsAreaTrabalho();
        $readArea->setCategory_id($this->CatId);
        $readArea->Execute()->find();
        if (!empty($readArea->Execute()->getResult())):
            return false;
        else:
            return true;
        endif;
    }
    
    //Cadastra a categoria no banco!
    private function Create() {
        $this->Data['category_id'] = null;
        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        $this->Messagem("cadastrada", $this->Read->Execute()->MaxFild('category_id'), $insert);
    }
    
    //Atualiza Categoria
    private function Update() {
        $this->Data['category_id'] = $this->CatId;
        $this->Read = new Controle('ws_area_category');
        $update = $this->Read->update($this->Data, 'category_id');
        $this->Messagem("atualizada", $this->Read->MaxFild('category_id'), $update);
    }

    private function Messagem($Action, $Return, $Criterio) {
        if ($Criterio):
            $tipo = ( empty($this->Data['category_parent']) ? 'seção' : 'categoria' );
            $this->Result = $Return;
            $this->Error = ["<b>Sucesso:</b> A {$tipo} <b>{$this->Data['category_title']}</b> foi {$Action} no sistema!", WS_ACCEPT];
        endif;
    }

}
