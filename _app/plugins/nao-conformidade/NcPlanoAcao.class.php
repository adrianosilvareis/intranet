<?php

/**
 * NcPlanoAcao.class.php [BEANS]
 *
 * @copyright (c) 2016, S. Reis, Adriano
 */
class NcPlanoAcao {

    private $plano_id;
    private $reg_id;
    private $plano_o_que;
    private $plano_quem;
    private $plano_onde;
    private $plano_date_max;
    private $plano_date_performs;
    private $plano_realizado;
    private $plano_demand;
    private $plano_completed;
    private $user_demand;
    private $data_notification;

    function __construct() {
        $this->Controle = new Controle('nc_registro');
    }

    /**
     * 
     * @return Objeto pupulado com todos os dados não nulo setado anteriormente.
     *
     */
    public function getThis() {
        $this->Controle->setDados(array_filter([
            'reg_id' => $this->getReg_id(),
            'plano_o_que' => $this->getPlano_o_que(),
            'plano_quem' => $this->getPlano_quem(),
            'plano_onde' => $this->getPlano_onde(),
            'plano_date_max' => $this->getPlano_date_max(),
            'plano_date_performs' => $this->getPlano_date_performs(),
            'plano_realizado' => $this->getPlano_realizado(),
            'plano_demand' => $this->getPlano_demand(),
            'data_notification' => $this->getData_notification(),
            'plano_id' => $this->getPlano_id()
        ]));
        return $this->Controle->getDados();
    }

    /**
     * transforma a stdClass neste objeto, transferindo todos os dados não nulos para esta classe;
     * 
     * @param stdClass $object
     */
    public function setThis($object) {
        $this->setPlano_id((isset($object->plano_id) ? $object->plano_id : null));
        $this->setReg_id((isset($object->reg_id) ? $object->reg_id : null));
        $this->setPlano_o_que((isset($object->plano_o_que) ? $object->plano_o_que : null));
        $this->setPlano_quem((isset($object->plano_quem) ? $object->plano_quem : null));
        $this->setPlano_onde((isset($object->plano_onde) ? $object->plano_onde : null));
        $this->setPlano_date_max((isset($object->plano_date_max) ? $object->plano_date_max : null));
        $this->setPlano_date_performs((isset($object->plano_date_performs) ? $object->plano_date_performs : null));
        $this->setPlano_realizado((isset($object->plano_realizado) ? $object->plano_realizado : null));
        $this->setPlano_demand((isset($object->plano_demand) ? $object->plano_demand : null));
        $this->setData_notification((isset($object->data_notification) ? $object->data_notification : null));
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
    function getPlano_id() {
        return $this->plano_id;
    }

    function getReg_id() {
        return $this->reg_id;
    }

    function getPlano_o_que() {
        return $this->plano_o_que;
    }

    function getPlano_quem() {
        return $this->plano_quem;
    }

    function getPlano_onde() {
        return $this->plano_onde;
    }

    function getPlano_date_max() {
        return $this->plano_date_max;
    }

    function getPlano_date_performs() {
        return $this->plano_date_performs;
    }

    function getPlano_realizado() {
        return $this->plano_realizado;
    }

    function getPlano_demand() {
        return $this->plano_demand;
    }

    function getPlano_completed() {
        return $this->plano_completed;
    }

    function getUser_demand() {
        return $this->user_demand;
    }

    function getData_notification() {
        return $this->data_notification;
    }

    function setPlano_id($plano_id) {
        $this->plano_id = $plano_id;
    }

    function setReg_id($reg_id) {
        $this->reg_id = $reg_id;
    }

    function setPlano_o_que($plano_o_que) {
        $this->plano_o_que = $plano_o_que;
    }

    function setPlano_quem($plano_quem) {
        $this->plano_quem = $plano_quem;
    }

    function setPlano_onde($plano_onde) {
        $this->plano_onde = $plano_onde;
    }

    function setPlano_date_max($plano_date_max) {
        $this->plano_date_max = $plano_date_max;
    }

    function setPlano_date_performs($plano_date_performs) {
        $this->plano_date_performs = $plano_date_performs;
    }

    function setPlano_realizado($plano_realizado) {
        $this->plano_realizado = $plano_realizado;
    }

    function setPlano_demand($plano_demand) {
        $this->plano_demand = $plano_demand;
    }

    function setPlano_completed($plano_completed) {
        $this->plano_completed = $plano_completed;
    }

    function setUser_demand($user_demand) {
        $this->user_demand = $user_demand;
    }

    function setData_notification($data_notification) {
        $this->data_notification = $data_notification;
    }


}
