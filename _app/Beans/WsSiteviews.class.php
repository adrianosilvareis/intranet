<?php

/**
 * WsSiteviews.class.php [Beans]
 * 
 * Classe que representa a tabela ws_Siteviews do banco de dados
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class WsSiteviews extends Beans {

    private $siteviews_id;
    private $siteviews_date;
    private $siteviews_users;
    private $siteviews_views;
    private $siteviews_pages;

    function __construct() {
        $this->Controle = new Controle('ws_siteviews');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'siteviews_date' => $this->getSiteviews_date(),
            'siteviews_users' => $this->getSiteviews_users(),
            'siteviews_views' => $this->getSiteviews_views(),
            'siteviews_pages' => $this->getSiteviews_pages(),
            'siteviews_id' => $this->getSiteviews_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($WsSiteviews) {
        $this->setSiteviews_id((isset($WsSiteviews->siteviews_id) ? $WsSiteviews->siteviews_id : null));
        $this->setSiteviews_date((isset($WsSiteviews->siteviews_date) ? $WsSiteviews->siteviews_date : null));
        $this->setSiteviews_users((isset($WsSiteviews->siteviews_users) ? $WsSiteviews->siteviews_users : null));
        $this->setSiteviews_views((isset($WsSiteviews->siteviews_views) ? $WsSiteviews->siteviews_views : null));
        $this->setSiteviews_pages((isset($WsSiteviews->siteviews_pages) ? $WsSiteviews->siteviews_pages : null));
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
    
    function getSiteviews_id() {
        return (int) $this->siteviews_id;
    }

    function getSiteviews_date() {
        return $this->siteviews_date;
    }

    function getSiteviews_users() {
        return $this->siteviews_users;
    }

    function getSiteviews_views() {
        return $this->siteviews_views;
    }

    function getSiteviews_pages() {
        return $this->siteviews_pages;
    }

    function setSiteviews_id($siteviews_id) {
        $this->siteviews_id = $siteviews_id;
    }

    function setSiteviews_date($siteviews_date) {
        $this->siteviews_date = $siteviews_date;
    }

    function setSiteviews_users($siteviews_users) {
        $this->siteviews_users = $siteviews_users;
    }

    function setSiteviews_views($siteviews_views) {
        $this->siteviews_views = $siteviews_views;
    }

    function setSiteviews_pages($siteviews_pages) {
        $this->siteviews_pages = $siteviews_pages;
    }

}
