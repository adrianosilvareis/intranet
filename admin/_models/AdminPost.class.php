<?php

/**
 * AdminPost.class.php [ Models Admin ]
 * Responsavel por gerenciar os Posts do sistema no Admin
 *
 * @copyright (c) 2015 AdrianoReis PROGRAMADOR
 */
class AdminPost {

    private $Data;
    private $Post;
    private $Error;
    private $Result;

    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um post, favor preencha todos os campos!", WS_ALERT];
            $this->Result = FALSE;
        else:
            $this->setData();
            $this->setName();
            $this->CreateImage();
        endif;
        $this->Data = null;
    }

    public function ExeUpdate($PostId, array $Data) {
        $this->Post = (int) $PostId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este post, preencha todos os campos ( Capa não precisa ser enviada! )", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();
            $this->UpdateImage();
            $this->ExeStatus($PostId, $Data['post_status']);
            $this->Data = null;
        endif;
    }

    public function ExeDelete($PostId) {
        $this->Post = (int) $PostId;

        $ReadPost = new WsPosts();
        $ReadPost->setPost_id($this->Post);
        $ReadPost->Execute()->find();

        if (!$ReadPost->Execute()->getResult()):
            $this->Error = ['O post que você tentou deletar não existe no sistema!', WS_ERROR];
            $this->Result = false;
        else:
            $PostDelete = $ReadPost->Execute()->getResult();

            $this->deletaArquivo('../uploads/' . $PostDelete->post_cover);

            $this->deletaGallery();
            $this->deletaFiles();

            $ReadPost->setPost_id($this->Post);
            $ReadPost->Execute()->delete();

            $this->Error = ["<b>{$PostDelete->post_title}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
        endif;
    }

    public function ExeStatus($PostId, $PostStatus) {
        $this->Data = null;
        $this->Post = (int) $PostId;
        $this->Data['post_status'] = (string) $PostStatus;
        $this->Data['post_id'] = $this->Post;

        $Read = new Controle('ws_posts');
        $Read->update($this->Data, "post_id");
    }

    public function gbSend(array $Imagens, $PostId) {
        $this->Post = $PostId;
        $this->Data = $Imagens;

        $ImageName = new WsPosts;
        $ImageName->setPost_id($this->Post);
        $ImageName->Execute()->find();
        if (!$ImageName->Execute()->getResult()):
            $this->Error = ["Erro ao enviar galeria. O índice {$this->Post} não foi encontrado no banco!", WS_ERROR];
            $this->Result = false;
        else:
            $gbCount = count($this->Data['tmp_name']);
            $gbKeys = array_keys($this->Data);
            $gbFiles = $this->setFiles($gbCount, $gbKeys);
            $this->setGallery($ImageName->Execute()->getResult(), $gbFiles);
        endif;
    }

    public function flSend(array $File, $PostId) {
        $this->Post = $PostId;
        $this->Data = $File;

        $FileName = new WsPosts;
        $FileName->setPost_id($this->Post);
        $FileName->Execute()->find();
        if (!$FileName->Execute()->getResult()):
            $this->Error = ["Erro ao enviar arquivo. O índice {$this->Post} não foi encontrado no banco!", WS_ERROR];
            $this->Result = false;
        else:
            $gbCount = count($this->Data['tmp_name']);
            $gbKeys = array_keys($this->Data);
            $gbFiles = $this->setFiles($gbCount, $gbKeys);
            $this->setArquivos($FileName->Execute()->getResult(), $gbFiles);
        endif;
    }

    public function flRemove($fileId) {
        $this->Post = (int) $fileId;
        $ReadGb = new WsPostsFile();
        $ReadGb->setFile_id($this->Post);
        $result = $ReadGb->Execute()->find();
        if ($result):
            $File = '../uploads/' . $result->file_url;
            $this->deletaArquivo($File);
            $deleta = $ReadGb->Execute()->delete();
            if ($deleta):
                $this->Error = ["O arquivo foi removido com sucesso da galeria!", WS_ACCEPT];
                $this->Result = true;
            endif;
        endif;
    }

    public function gbRemove($GbImageId) {
        $this->Post = (int) $GbImageId;
        $ReadGb = new WsPostsGallery();
        $ReadGb->setGallery_id($this->Post);
        $result = $ReadGb->Execute()->find();
        if ($result):
            $Imagem = '../uploads/' . $result->gallery_image;
            $this->deletaArquivo($Imagem);
            $deleta = $ReadGb->Execute()->delete();
            if ($deleta):
                $this->Error = ["A Imagem foi removida com sucesso da galeria!", WS_ACCEPT];
                $this->Result = true;
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
    private function deletaArquivo($Url) {
        if (file_exists($Url) && !is_dir($Url)):
            unlink($Url);
        endif;
    }

    private function deletaGallery() {
        $ReadGallery = new WsPostsGallery();
        $ReadGallery->setPost_id($this->Post);
        $ReadGallery->Execute()->Query("#post_id#");
        if ($ReadGallery->Execute()->getResult()):
            foreach ($ReadGallery->Execute()->getResult() as $gbdel):
                $this->deletaArquivo('../uploads/' . $gbdel->gallery_image);
            endforeach;
        endif;

        $ReadGallery->setPost_id($this->Post);
        $ReadGallery->Execute()->delete(null, "post_id = :post_id");
    }

    private function deletaFiles() {
        $Read = new WsPostsFile();
        $Read->setPost_id($this->Post);
        $Read->Execute()->Query("#post_id#");
        if ($Read->Execute()->getResult()):
            foreach ($Read->Execute()->getResult() as $gbdel):
                $this->deletaArquivo('../uploads/' . $gbdel->file_url);
            endforeach;
        endif;

        $Read->setPost_id($this->Post);
        $Read->Execute()->delete(null, "post_id = :post_id");
    }

    private function setGallery($result, $gbFiles) {
        $ImageName = $result->post_name;
        $gbSend = new Upload();

        $i = 0;
        $u = 0;
        foreach ($gbFiles as $gbUploads):
            $ImgName = "{$ImageName}-gb-{$this->Post}-" . (substr(md5(time() + $i), 0, 5));
            $gbSend->Image($gbUploads, $ImgName);

            if ($gbSend->getResult()):
                $gbImage = $gbSend->getResult();
                $gbCreate = new WsPostsGallery();
                $gbCreate->setPost_id($this->Post);
                $gbCreate->setGallery_image($gbImage);
                $gbCreate->setGallery_date(date("Y/m/d H:i:s"));
                $gbCreate->Execute()->insert();
                $u++;
            endif;
            $i++;
        endforeach;
        $this->GalleryMessage($u);
    }

    private function setArquivos($result, $gbFiles) {
        $ImageName = $result->post_name;
        $flSend = new Upload();

        $i = 0;
        $u = 0;
        foreach ($gbFiles as $gbUploads):
            $FileName = "{$ImageName}-fl-{$this->Post}-" . (substr(md5(time() + $i), 0, 5));
            $flSend->File($gbUploads, $FileName);

            if ($flSend->getResult()):
                $File = $flSend->getResult();
                $gbCreate = new WsPostsFile();
                $gbCreate->setPost_id($this->Post);
                $gbCreate->setFile_url($File);
                $gbCreate->setFile_date(date("Y/m/d H:i:s"));
                $gbCreate->setFile_name($gbUploads['name']);
                $gbCreate->Execute()->insert();
                $u++;
            endif;
            $i++;
        endforeach;
        $this->GalleryMessage($u);
    }

    private function GalleryMessage($uploadNumber) {
        if ($uploadNumber > 1):
            $this->Result = true;
            $this->Error = ["Galeria Atualizada: Foi enviado <b>{$uploadNumber}</b> arquivos para galeria deste post!", WS_ACCEPT];
        endif;
    }

    private function setFiles($gbCount, $gbKeys) {
        $gbFiles = array();

        for ($gb = 0; $gb < $gbCount; $gb++):
            foreach ($gbKeys as $keys):
                $gbFiles[$gb][$keys] = $this->Data[$keys][$gb];
            endforeach;
        endfor;

        return $gbFiles;
    }

    private function CreateImage() {
        if ($this->Data['post_cover']):
            $upload = new upload();
            $upload->Image($this->Data['post_cover'], $this->Data['post_name']);
        endif;

        if (isset($upload) && $upload->getResult()):
            $this->Data['post_cover'] = $upload->getResult();
            $this->Create();
        else:
            $this->Data['post_cover'] = null;
            $_SESSION['errCapa'] = "<b>ERRO AO ENVIAR CAPA: </b>Tipo de arquivo inválido, envie imagens JPG e PNG!";
            $this->Create();
        endif;
    }

    private function UpdateImage() {

        if (is_array($this->Data['post_cover'])):
            $WsPosts = new WsPosts;
            $WsPosts->setPost_id($this->Post);
            $WsPosts->Execute()->find();

            $this->deletaArquivo('../uploads/' . $WsPosts->Execute()->getResult()->post_cover);

            $upload = new Upload;
            $upload->Image($this->Data['post_cover'], $this->Data['post_name']);
        endif;

        if (isset($upload) && $upload->getResult()):
            $this->Data['post_cover'] = $upload->getResult();
            $this->Update();
        else:
            unset($this->Data['post_cover']);
            if (!empty($upload) && $upload->getError()):
                WSErro("<b>ERRO AO ENVIAR CAPA: </b>" . $upload->getError(), E_USER_WARNING);
            endif;
            $this->Update();
        endif;
    }

    private function setData() {
        $Cover = $this->Data['post_cover'];
        $Content = $this->Data['post_content'];
        unset($this->Data['post_cover'], $this->Data['post_content']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['post_name'] = Check::Name($this->Data['post_title']);
        $this->Data['post_date'] = Check::Data($this->Data['post_date']);

        $this->Data['post_cover'] = ($Cover != 'null' ? $Cover : null);
        $this->Data['post_content'] = $Content;

        $this->Data['post_cat_parent'] = $this->getCatParent();
    }

    private function getCatParent() {
        $rCat = new WsCategories();
        $rCat->setCategory_id($this->Data['post_category']);
        $rCat->Execute()->find();

        if ($rCat->Execute()->getResult()):
            return $rCat->Execute()->getResult()->category_parent;
        else:
            return null;
        endif;
    }

    private function setName() {
        $Where = (isset($this->Post) ? "post_id != {$this->Post} AND " : "");
        $WsPosts = new WsPosts();
        $WsPosts->setPost_title($this->Data['post_title']);
        $WsPosts->Execute()->Query("{$Where}#post_title#");

        if ($WsPosts->Execute()->getResult()):
            $this->Data['post_name'] = $this->Data['post_name'] . '-' . $WsPosts->Execute()->getRowCount();
        endif;
    }

    private function Create() {
        $cadastra = new WsPosts;
        $this->Data['post_views'] = null;
        $this->Data['post_last_views'] = null;
        $this->Data['post_id'] = null;
        $cadastra->setThis((object) $this->Data);
        $result = $cadastra->Execute()->insert();

        $this->Message($this->Data['post_title'], "cadastrado", $cadastra->Execute()->MaxFild("post_id"), $result);
    }

    private function Update() {
        $WsPosts = new WsPosts;
        $this->Data['post_views'] = null;
        $this->Data['post_last_views'] = null;
        $this->Data['post_id'] = $this->Post;
        $this->Data['post_date'] = date('Y-m-d H:i:s');
        $this->Data['post_cover'] = (!empty($this->Data['post_cover']) ? $this->Data['post_cover'] : null);

        $WsPosts->setThis((object) $this->Data);
        $result = $WsPosts->Execute()->update(null, 'post_id');

        $this->Message($this->Data['post_title'], "atualizado", true, $result);
    }

    private function Message($PostTitle, $PostAction, $Return, $Condicao) {
        if ($Condicao):
            $this->Error = ["O post <b>{$PostTitle}</b> foi {$PostAction} com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $Return;
        endif;
    }

}
