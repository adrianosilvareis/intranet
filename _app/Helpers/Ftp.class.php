<?php

/**
 * Ftp.class.php [Helpers]
 * Classe responsavel por manipular e validar arquivos no sistema
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class Ftp {

    private $Dir;
    private $Local;
    private $Base;
    private $Home;
    private $url;
    private $Link;
    private $File;
    
    function __construct() {
        $this->setLocal();
        $this->Home = HOME . '/ftp';
        $this->Base = DOCUMENT_ROOT . DIRECTORY_SEPARATOR . THEME . DIRECTORY_SEPARATOR . 'ftp';
        $this->Dir = $this->Base . DIRECTORY_SEPARATOR . implode("/", $this->Local);
        $this->url = $this->Home . '/' . implode("/", $this->Local);
    }

    function checkDir($Dir = null, $File = null) {
        $this->Dir = (!empty($Dir) ? $Dir : $this->Dir);
        $this->Dir = (!empty($File) ? $this->Dir . '//' . $File : $this->Dir);
        if (file_exists($this->Dir) && is_dir($this->Dir)):
            return true;
        else:
            return false;
        endif;
    }
    
    function getIcon(){
        
    }

    function setLink($Link) {
        $this->Link = $Link . "/&ftp=" . implode("/", $this->Local);
    }

    function getDir() {
        return $this->Dir;
    }

    function getLocal() {
        return $this->Local;
    }
    
//    private
    private function setLocal() {
        $this->Local = explode("/", filter_input(INPUT_GET, "ftp", FILTER_DEFAULT));
        if ($this->Local[0] == ''):
            array_shift($this->Local);
        endif;
        $this->Local = array_filter($this->Local);
    }

}
