<?php

/**
 * Login.class.php [ Model ]
 * Responsavel por autenticar, validar e checar usuarios do sistema
 * 
 * @copyright (c) 2015, Adriano Reis AdrianoReis Tecnologias
 */
class Login {

    private $Level;
    private $Email;
    private $Senha;
    private $Error;
    private $Result;
    
    /**
     * <b>Informar Level:</b> Informe o nível de acesso mínimo para a área a ser protegida.
     * @param INT $Level = nível mínimo para acesso
     */
    function __construct($Level) {
        $this->Level = (int) $Level;
    }
    
    /**
     * <b>Efetuar Login:</b> Envelope um array atribuitivo com Índices STRING user [email], STRING pass.
     * Ao passar este array na ExeLogin() os dados são verificados e o login é feito!
     * @param ARRAY $UserData = user [email], pass
     */
    public function ExeLogin(array $UserData) {
        $this->Email = (string) strip_tags(trim($UserData['user']));
        $this->Senha = (string) strip_tags(trim($UserData['pass']));
        $this->setLogin();
    }

    function getError() {
        return $this->Error;
    }

    function getResult() {
        return $this->Result;
    }

    public function CheckLogin() {
        if (!isset($_SESSION['userlogin']) || $_SESSION['userlogin']['user_level'] < $this->Level):
            unset($_SESSION['userlogin']);
            return false;
        else:
            return true;
        endif;
    }

 /**
  * ****************************************
  * *************** PRIVATES ***************
  * ****************************************
  */

    private function setLogin() {
        if (!$this->Email || !$this->Senha || !Check::Email($this->Email)):
            $this->Error = ['Informe seu email e senha para efetuar seu login', WS_INFOR];
            $this->Result = false;
        elseif (!$this->getUser()):
            $this->Error = ['os dados informados não são compatíveis', WS_ALERT];
            $this->Result = false;
        elseif ($this->Result->user_level < $this->Level):
            $this->Error = ["Desculpe {$this->Result->user_name}, você não tem permissão para acessar esta área!", WS_ERROR];
            $this->Result = false;
        else:
            $this->Execute();
        endif;
    }

    private function getUser() {
        $this->Senha = md5($this->Senha);
        $WsUsers = new WsUsers();
        $WsUsers->setUser_email($this->Email);
        $WsUsers->setUser_password($this->Senha);
        $WsUsers->Execute()->Query("#user_email# AND #user_password#");
        if ($WsUsers->Execute()->getResult()):
            $this->Result = $WsUsers->Execute()->getResult()[0];
            return true;
        else:
            return false;
        endif;
    }

    private function Execute() {
        if (!session_id()):
            session_start();
        endif;

        $_SESSION['userlogin'] = (array) $this->Result;
        $this->Error = ["Olá {$this->Result->user_name}, seja bem vindo(a). Aguarde redirecionamento!", WS_ACCEPT];

        $this->Result = true;
    }

}
