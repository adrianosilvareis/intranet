<?php

/**
 * WsSiteviewsAgent [Beans]
 * 
 * Classe que representa a tabela ws_siteviews_agent do banco de dados
 * @copyright (c) year, Adriano S. Reis Programador
 */
class WsSiteviewsAgent extends Beans {

    private $agent_id;
    private $agent_name;
    private $agent_views;

    function __construct() {
        $this->Controle = new Controle('ws_siteviews_agent');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'agent_name' => $this->getAgent_name(),
            'agent_views' => $this->getAgent_views(),
            'agent_id' => $this->getAgent_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setAgent_id((isset($object->agent_id) ? $object->agent_id : null));
        $this->setAgent_name((isset($object->agent_name) ? $object->agent_name : null));
        $this->setAgent_views((isset($object->agent_views) ? $object->agent_views : null));
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
    
    function getAgent_id() {
        return (int) $this->agent_id;
    }

    function getAgent_name() {
        return $this->agent_name;
    }

    function getAgent_views() {
        return $this->agent_views;
    }

    function setAgent_id($agent_id) {
        $this->agent_id = $agent_id;
    }

    function setAgent_name($agent_name) {
        $this->agent_name = $agent_name;
    }

    function setAgent_views($agent_views) {
        $this->agent_views = $agent_views;
    }

}
