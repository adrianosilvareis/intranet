<?php

/**
 * WsPostsGallery.class.php [Beans]
 * 
 * Classe que representa a tabela ws_posts_gallery do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class WsPostsGallery extends Beans {

    private $post_id;
    private $gallery_id;
    private $gallery_image;
    private $gallery_date;

    function __construct() {
        $this->Controle = new Controle('ws_posts_gallery');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'post_id' => $this->getPost_id(),
            'gallery_image' => $this->getGallery_image(),
            'gallery_date' => $this->getGallery_date(),
            'gallery_id' => $this->getGallery_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setPost_id((isset($object->gallery_id) ? $object->gallery_id : null));
        $this->setGallery_image((isset($object->gallery_image) ? $object->gallery_image : null));
        $this->setGallery_date((isset($object->gallery_date) ? $object->gallery_date : null));
        $this->setPost_id((isset($object->post_id) ? $object->post_id : null));
    }

    /**
     * Retorna operações de insert, update, delete, e buscas
     * 
     * @return Controle
     */
    public function Execute() {
        $this->getThis();
        return $this->Controle;
    }

    /**
     * ****************************************
     * ************** GET & SET ***************
     * ****************************************
     */
    
    function getPost_id() {
        return $this->post_id;
    }

    function getGallery_id() {
        return $this->gallery_id;
    }

    function getGallery_image() {
        return $this->gallery_image;
    }

    function getGallery_date() {
        return $this->gallery_date;
    }

    function setPost_id($post_id) {
        $this->post_id = $post_id;
    }

    function setGallery_id($gallery_id) {
        $this->gallery_id = $gallery_id;
    }

    function setGallery_image($gallery_image) {
        $this->gallery_image = $gallery_image;
    }

    function setGallery_date($gallery_date) {
        $this->gallery_date = $gallery_date;
    }

}
