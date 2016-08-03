<?php

/**
 * WsUsers.class.php [Beans]
 * 
 * Representa a tabela ws_users do branco de dados;
 * 
 * @copyright (c) 2015, Adriano Reis AdrianoReis
 */
class WsUsers extends Beans {

    private $user_id;
    private $user_nickname;
    private $user_name;
    private $user_lastname;
    private $user_email;
    private $user_password;
    private $user_birthday;
    private $user_registration;
    private $user_lastupdate;
    private $user_level;
    private $user_cover;
    private $user_status;
    private $area_id;
    private $perfil_id;

    function __construct() {
        $this->Controle = new Controle('ws_users');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     * 
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'user_nickname' => $this->getUser_nickname(),
            'user_name' => $this->getUser_name(),
            'user_lastname' => $this->getUser_lastname(),
            'user_email' => $this->getUser_email(),
            'user_password' => $this->getUser_password(),
            'user_birthday' => $this->getUser_birthday(),
            'user_registration' => $this->getUser_registration(),
            'user_lastupdate' => $this->getUser_lastupdate(),
            'user_level' => $this->getUser_level(),
            'user_cover' => $this->getUser_cover(),
            'user_status' => $this->getUser_status(),
            'area_id' => $this->getArea_id(),
            'perfil_id' => $this->getPerfil_id(),
            'user_id' => $this->getUser_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setUser_id((isset($object->user_id) ? $object->user_id : null));
        $this->setUser_nickname((isset($object->user_nickname) ? $object->user_nickname : null));
        $this->setUser_name((isset($object->user_name) ? $object->user_name : null));
        $this->setUser_lastname((isset($object->user_lastname) ? $object->user_lastname : null));
        $this->setUser_email((isset($object->user_email) ? $object->user_email : null));
        $this->setUser_password((isset($object->user_password) ? $object->user_password : null));
        $this->setUser_birthday((isset($object->user_birthday) ? $object->user_birthday : null));
        $this->setUser_registration((isset($object->user_registration) ? $object->user_registration : null));
        $this->setUser_lastupdate((isset($object->user_lastupdate) ? $object->user_lastupdate : null));
        $this->setUser_level((isset($object->user_level) ? $object->user_level : null));
        $this->setUser_cover((isset($object->user_cover) ? $object->user_cover : null));
        $this->setUser_status((isset($object->user_status) ? $object->user_status : null));
        $this->setArea_id((isset($object->area_id) ? $object->area_id : null));
        $this->setPerfil_id((isset($object->perfil_id) ? $object->perfil_id : null));
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
    function getUser_id() {
        return $this->user_id;
    }

    function getUser_nickname() {
        return $this->user_nickname;
    }

    function getUser_name() {
        return $this->user_name;
    }

    function getUser_lastname() {
        return $this->user_lastname;
    }

    function getUser_email() {
        return $this->user_email;
    }

    function getUser_password() {
        return $this->user_password;
    }

    function getUser_birthday() {
        return $this->user_birthday;
    }

    function getUser_registration() {
        return $this->user_registration;
    }

    function getUser_lastupdate() {
        return $this->user_lastupdate;
    }

    function getUser_level() {
        return $this->user_level;
    }

    function getUser_cover() {
        return $this->user_cover;
    }

    function getUser_status() {
        if (isset($this->user_status)):
            $this->user_status = ($this->user_status ? '1' : 'false');
        endif;
        return $this->user_status;
    }

    function getArea_id() {
        return $this->area_id;
    }

    function getPerfil_id() {
        return $this->perfil_id;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setUser_nickname($user_nickname) {
        $this->user_nickname = $user_nickname;
    }

    function setUser_name($user_name) {
        $this->user_name = $user_name;
    }

    function setUser_lastname($user_lastname) {
        $this->user_lastname = $user_lastname;
    }

    function setUser_email($user_email) {
        $this->user_email = $user_email;
    }

    function setUser_password($user_password) {
        $this->user_password = $user_password;
    }

    function setUser_birthday($user_birthday) {
        $this->user_birthday = $user_birthday;
    }

    function setUser_registration($user_registration) {
        $this->user_registration = $user_registration;
    }

    function setUser_lastupdate($user_lastupdate) {
        $this->user_lastupdate = $user_lastupdate;
    }

    function setUser_level($user_level) {
        $this->user_level = $user_level;
    }

    function setUser_cover($user_cover) {
        $this->user_cover = $user_cover;
    }

    function setUser_status($user_status) {
        $this->user_status = $user_status;
    }

    function setArea_id($area_id) {
        $this->area_id = $area_id;
    }

    function setPerfil_id($perfil_id) {
        $this->perfil_id = $perfil_id;
    }

}
