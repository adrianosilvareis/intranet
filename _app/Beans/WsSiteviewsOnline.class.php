<?php

/**
 * WsSiteviewsOnline [Beans]
 * 
 * Classe que representa a tabela ws_siteviews_online do banco de dados
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class WsSiteviewsOnline extends Beans {

    private $online_id;
    private $online_session;
    private $online_startview;
    private $online_endview;
    private $online_ip;
    private $online_url;
    private $online_agent;
    private $agent_name;

    function __construct() {
        $this->Controle = new Controle('ws_siteviews_online');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'online_startview' => $this->getOnline_startview(),
            'online_endview' => $this->getOnline_endview(),
            'online_ip' => $this->getOnline_ip(),
            'online_url' => $this->getOnline_url(),
            'online_agent' => $this->getOnline_agent(),
            'agent_name' => $this->getAgent_name(),
            'online_session' => $this->getOnline_session(),
            'online_id' => $this->getOnline_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setOnline_id((isset($object->online_id) ? $object->online_id : null));
        $this->setOnline_session((isset($object->online_session) ? $object->online_session : null));
        $this->setOnline_startview((isset($object->online_startview) ? $object->online_startview : null));
        $this->setOnline_endview((isset($object->online_endview) ? $object->online_endview : null));
        $this->setOnline_ip((isset($object->online_ip) ? $object->online_ip : null));
        $this->setOnline_url((isset($object->online_url) ? $object->online_url : null));
        $this->setOnline_agent((isset($object->online_agent) ? $object->online_agent : null));
        $this->setAgent_name((isset($object->agent_name) ? $object->agent_name : null));
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
    
    function getOnline_id() {
        return (int) $this->online_id;
    }

    function getOnline_session() {
        return $this->online_session;
    }

    function setOnline_session($online_session) {
        $this->online_session = $online_session;
    }

    function getOnline_startview() {
        return $this->online_startview;
    }

    function getOnline_endview() {
        return $this->online_endview;
    }

    function getOnline_ip() {
        return $this->online_ip;
    }

    function getOnline_url() {
        return $this->online_url;
    }

    function getOnline_agent() {
        return $this->online_agent;
    }

    function getAgent_name() {
        return $this->agent_name;
    }

    function setOnline_id($online_id) {
        $this->online_id = $online_id;
    }

    function setOnline_startview($online_startview) {
        $this->online_startview = $online_startview;
    }

    function setOnline_endview($online_endview) {
        $this->online_endview = $online_endview;
    }

    function setOnline_ip($online_ip) {
        $this->online_ip = $online_ip;
    }

    function setOnline_url($online_url) {
        $this->online_url = $online_url;
    }

    function setOnline_agent($online_agent) {
        $this->online_agent = $online_agent;
    }

    function setAgent_name($agent_name) {
        $this->agent_name = $agent_name;
    }

}
