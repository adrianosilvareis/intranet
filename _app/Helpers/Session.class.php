<?php

/**
 * Session.class.php [HELPER]
 * Classe responsavel por gerenciar atualizações, estatisticas e sessoes do sistema
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class Session {

    private $Date;
    private $Cache;
    private $Browser;

    /** @var WsSiteviews */
    private $Traffic;

    /** @var WsSiteviewsAgent */
    private $Agent;

    /** @var WsSiteviewsOnline */
    private $Usuario;

    function __construct($Cache = null) {
        session_start();
        $this->CheckSession($Cache);
    }

    //verifica e executa todos os metodos da classe
    private function CheckSession($Cache = null) {
        $this->Date = date("Y-m-d");
        $this->Cache = ( (int) $Cache ? $Cache : 20);

        if (empty($_SESSION['useronline'])):
            $this->setTraffic();
            $this->setSession();
            $this->CheckBrowser();
            $this->setUsuarios();
            $this->BrowserUpdate();
        else:
            $this->TrafficUpdate();
            $this->sessionUpdate();
            $this->CheckBrowser();
            $this->UsuariosUpdate();
        endif;

        $this->Date = null;
    }

    //inicia a sessao do usuario
    private function setSession() {
        $_SESSION['useronline'] = [
            "online_session" => session_id(),
            "online_startview" => date("Y-m-d"),
            "online_endview" => date("Y-m-d H:i:s", strtotime("+{$this->Cache}minutes")),
            "online_ip" => filter_input(INPUT_SERVER, "REMOTE_ADDR", FILTER_VALIDATE_IP),
            "online_url" => filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_DEFAULT),
            "online_agent" => filter_input(INPUT_SERVER, "HTTP_USER_AGENT", FILTER_DEFAULT)
        ];
    }

    //atualiza a sessao do usuario
    private function sessionUpdate() {
        $_SESSION['useronline']['online_endview'] = date("Y-m-d H:i:s", strtotime("+{$this->Cache}minutes"));
        $_SESSION['useronline']['online_url'] = filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_DEFAULT);
    }

    //verifica e insere o traffico na tabela
    private function setTraffic() {
        $this->getTraffic();

        if (!$this->Traffic->getSiteviews_id()):
            $this->Traffic->setSiteviews_date($this->Date);
            $this->Traffic->setSiteviews_users(1);
            $this->Traffic->setSiteviews_views(1);
            $this->Traffic->setSiteviews_pages(1);
            $this->Traffic->Execute()->insert($this->Traffic->getThis());
        else:
            if (!$this->getCookie()):
                $this->Traffic->setSiteviews_users($this->Traffic->getSiteviews_users() + 1);
                $this->Traffic->setSiteviews_views($this->Traffic->getSiteviews_views() + 1);
                $this->Traffic->setSiteviews_pages($this->Traffic->getSiteviews_pages() + 1);
            else:
                $this->Traffic->setSiteviews_views($this->Traffic->getSiteviews_views() + 1);
                $this->Traffic->setSiteviews_pages($this->Traffic->getSiteviews_pages() + 1);
            endif;
            $this->Traffic->Execute()->update($this->Traffic->getThis(), "siteviews_id");
        endif;
    }

    //verifica e atualiza os pagesviews
    private function TrafficUpdate() {
        $this->getTraffic();
        if (empty($this->Traffic->getSiteviews_id())):
            $_SESSION['useronline'] = null;
            $this->CheckSession();
        else:
            $this->Traffic->setSiteviews_pages($this->Traffic->getSiteviews_pages() + 1);
            $this->Traffic->Execute()->update($this->Traffic->getThis(), "siteviews_id");
        endif;
        $this->Traffic = null;
    }

    //obtem dados da tabela [HELPER TRAFFIC]
    private function getTraffic() {
        $this->Traffic = new WsSiteviews;
        $this->Traffic->setSiteviews_date($this->Date);
        $this->Traffic->Execute()->Query("#siteviews_date#");
        if ($this->Traffic->Execute()->getResult()):
            $this->Traffic->setThis($this->Traffic->Execute()->getResult()[0]);
        endif;
    }

    //verifica, cria e atualiza o cookie do usuario [HELPER TRAFFIC]
    private function getCookie() {
        $cookie = filter_input(INPUT_COOKIE, 'useronline', FILTER_DEFAULT);
        setcookie('useronline', base64_encode('upinside'), time() + 86400);
        if (!$cookie):
            return false;
        else:
            return true;
        endif;
    }

    //identifica navegador do usuario
    private function CheckBrowser() {
        $this->Browser = $_SESSION['useronline']['online_agent'];
        if (strpos($this->Browser, 'Chrome')):
            if (strpos($this->Browser, 'Edge')):
                $this->Browser = 'Edge';
            else:
                $this->Browser = 'Chrome';
            endif;

        elseif (strpos($this->Browser, 'Firefox')):
            $this->Browser = 'Firefox';
        elseif (strpos($this->Browser, 'MSIE') || strpos($this->Browser, 'Trident/')):
            $this->Browser = 'IE';
        else:
            $this->Browser = 'outros';
        endif;
    }

    //atualiza o browser do usuario
    private function BrowserUpdate() {
        $this->Agent = new WsSiteviewsAgent;
        $this->Agent->setAgent_name($this->Browser);
        $result = $this->Agent->Execute()->Query("#agent_name#");

        if (!$result):
            $this->Agent->setAgent_name($this->Browser);
            $this->Agent->setAgent_views(1);
            $this->Agent->Execute()->insert($this->Agent->getThis());
        else:
            $this->Agent->setThis($result[0]);
            $this->Agent->setAgent_views($this->Agent->getAgent_views() + 1);
            $this->Agent->Execute()->update($this->Agent->getThis(), 'agent_id');
        endif;
    }

    //cadastra usuario online na tabela
    private function setUsuarios() {
        $sesOnline = $_SESSION['useronline'];
        $sesOnline['agent_name'] = $this->Browser;
        $sesOnline['online_id'] = null;

        $this->Usuario = new WsSiteviewsOnline;
        $this->Usuario->setThis((object) $sesOnline);

        $this->Usuario->Execute()->insert($this->Usuario->getThis());
    }

    //atualiza navegacao de usuario online na tabela
    private function UsuariosUpdate() {
        $this->Usuario = new WsSiteviewsOnline;
        $this->Usuario->setOnline_endview($_SESSION['useronline']['online_endview']);
        $this->Usuario->setOnline_url($_SESSION['useronline']['online_url']);
        $this->Usuario->setOnline_session($_SESSION['useronline']['online_session']);

        $this->Usuario->Execute()->update($this->Usuario->getThis(), 'online_session');

        if (!$this->Usuario->Execute()->getRowCount()):
            $Read = new Controle('ws_siteviews_online');
            $Read->Query("#online_session#", "online_session={$_SESSION['useronline']['online_session']}");
            if (!$Read->getResult()):
                $this->setUsuarios();
            endif;
        endif;
    }

}
