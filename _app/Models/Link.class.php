<?php

/**
 * Link.class.php [MODEL]
 * Classe responsavel por organizar o SEO do sistema e realizar a navegação
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class Link {

    private $File;
    private $Link;

    /** DATA */
    private $Local;
    private $Patch;
    private $Tags;
    private $Data;

    /** @var SEO */
    private $Seo;

    function __construct() {
        $this->Local = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
        $this->Local = ($this->Local ? $this->Local : 'index');
        $this->Local = explode('/', $this->Local);
        $this->File = (isset($this->Local[0]) ? $this->Local[0] : 'index');
        $this->Link = (isset($this->Local[1]) ? $this->Local[1] : null);
        $this->Seo = new Seo($this->File, $this->Link);
    }

    public function getTags() {
        $this->Tags = $this->Seo->getTags();
        echo $this->Tags;
    }

    public function getData() {
        $this->Data = $this->Seo->getData();
        return $this->Data;
    }

    function getLocal() {
        return $this->Local;
    }

    function getPatch() {
        $this->setPatch();
        return $this->Patch;
    }

    /**
     * ****************************************
     * *************** PRIVATES ***************
     * ****************************************
     */
    
    /*
     * verifica e inclui os arquivos por demanda. Podendo encontra-los dentro da pasta rais ou subpastas.
     * cada nivel de subpasta deve ser preestabelecido com elseif.
     */
    private function setPatch() {
        if (file_exists(REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . '.php')):
            $this->Patch = REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . '.php';
        elseif (file_exists(REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . DIRECTORY_SEPARATOR . $this->Link . '.php')):
            $this->Patch = REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . DIRECTORY_SEPARATOR . $this->Link . '.php';
        elseif (file_exists(REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . DIRECTORY_SEPARATOR . $this->Link . DIRECTORY_SEPARATOR . 'index.php')):
            $this->Patch = REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . DIRECTORY_SEPARATOR . $this->Link . DIRECTORY_SEPARATOR . 'index.php';
        else:
            $this->Patch = REQUIRE_PATH . DIRECTORY_SEPARATOR . '404.php';
        endif;
    }

}
