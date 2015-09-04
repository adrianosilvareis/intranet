<?php

/**
 * WsPost.class.php [Beans]
 * 
 * Classe que representa a tabela ws_posts do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class WsPosts extends Beans {

    private $post_id;
    private $post_name;
    private $post_title;
    private $post_content;
    private $post_cover;
    private $post_date;
    private $post_author;
    private $post_category;
    private $post_cat_parent;
    private $post_views;
    private $post_last_views;
    private $post_status;
    private $post_type;

    function __construct() {
        $this->Controle = new Controle('ws_posts');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'post_name' => $this->getPost_name(),
            'post_title' => $this->getPost_title(),
            'post_content' => $this->getPost_content(),
            'post_cover' => $this->getPost_cover(),
            'post_date' => $this->getPost_date(),
            'post_author' => $this->getPost_author(),
            'post_category' => $this->getPost_category(),
            'post_cat_parent' => $this->getPost_cat_parent(),
            'post_views' => $this->getPost_views(),
            'post_last_views' => $this->getPost_last_views(),
            'post_status' => $this->getPost_status(),
            'post_type' => $this->getPost_type(),
            'post_id' => $this->getPost_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setPost_name((isset($object->post_name) ? $object->post_name : null));
        $this->setPost_title((isset($object->post_title) ? $object->post_title : null));
        $this->setPost_content((isset($object->post_content) ? $object->post_content : null));
        $this->setPost_cover((isset($object->post_cover) ? $object->post_cover : null));
        $this->setPost_date((isset($object->post_date) ? $object->post_date : null));
        $this->setPost_author((isset($object->post_author) ? $object->post_author : null));
        $this->setPost_category((isset($object->post_category) ? $object->post_category : null));
        $this->setPost_cat_parent((isset($object->post_cat_parent) ? $object->post_cat_parent : null));
        $this->setPost_views((isset($object->post_views) ? $object->post_views : null));
        $this->setPost_last_views((isset($object->post_last_views) ? $object->post_last_views : null));
        $this->setPost_status((isset($object->post_status) ? $object->post_status : null));
        $this->setPost_type((isset($object->post_type) ? $object->post_type : null));
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

    function getPost_name() {
        return $this->post_name;
    }

    function getPost_title() {
        return $this->post_title;
    }

    function getPost_content() {
        return $this->post_content;
    }

    function getPost_cover() {
        return $this->post_cover;
    }

    function getPost_date() {
        return $this->post_date;
    }

    function getPost_author() {
        return $this->post_author;
    }

    function getPost_category() {
        return $this->post_category;
    }

    function getPost_cat_parent() {
        return $this->post_cat_parent;
    }

    function getPost_views() {
        return $this->post_views;
    }

    function getPost_last_views() {
        return $this->post_last_views;
    }

    function getPost_status() {
        return $this->post_status;
    }

    function getPost_type() {
        return $this->post_type;
    }

    function setPost_id($post_id) {
        $this->post_id = $post_id;
    }

    function setPost_name($post_name) {
        $this->post_name = $post_name;
    }

    function setPost_title($post_title) {
        $this->post_title = $post_title;
    }

    function setPost_content($post_content) {
        $this->post_content = $post_content;
    }

    function setPost_cover($post_cover) {
        $this->post_cover = $post_cover;
    }

    function setPost_date($post_date) {
        $this->post_date = $post_date;
    }

    function setPost_author($post_author) {
        $this->post_author = $post_author;
    }

    function setPost_category($post_category) {
        $this->post_category = $post_category;
    }

    function setPost_cat_parent($post_cat_parent) {
        $this->post_cat_parent = $post_cat_parent;
    }

    function setPost_views($post_views) {
        $this->post_views = $post_views;
    }

    function setPost_last_views($post_last_views) {
        $this->post_last_views = $post_last_views;
    }

    function setPost_status($post_status) {
        $this->post_status = (int) $post_status;
    }

    function setPost_type($post_type) {
        $this->post_type = $post_type;
    }

}
