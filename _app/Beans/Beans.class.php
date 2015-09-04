<?php

abstract class Beans{
    
    /**
     *
     * @var Controle 
     */
    protected $Controle;
    
    abstract public function setThis($object);
    
    abstract public function getThis();
    
    abstract public function Execute();
  
}