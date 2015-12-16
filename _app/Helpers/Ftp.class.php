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
    private $Inicio;
    private $url;
    private $Link;
    private $Type;
    private $File;

    function __construct() {
        $this->setLocal();
        $this->Home = HOME . '/ftp';
        $this->Base = DOCUMENT_ROOT . DIRECTORY_SEPARATOR . THEME . DIRECTORY_SEPARATOR . 'ftp';
        $this->Dir = $this->Base . DIRECTORY_SEPARATOR . implode("/", $this->Local);
        $this->url = $this->Home . '/' . implode("/", $this->Local);
    }

    /**
     * Avalia se o caminho informado é um diretorio
     * 
     * @param string $Dir
     * @param string $File
     * @return boolean
     */
    function checkDir($Dir = null, $File = null) {
        $diretorio = (!empty($Dir) ? $Dir : $this->Dir);
        $diretorio = (!empty($File) ? $diretorio . '//' . $File : $diretorio);
        if (file_exists($diretorio) && is_dir($diretorio)):
            return true;
        else:
            return false;
        endif;
    }

    /**
     * retorna o icone pronto
     * 
     * @param string $File
     * @param string $Type
     */
    function getIcon($File, $Dir = null, $Type = null) {
        $this->File = $File;
        $this->Type = (!empty($Type) ? $Type : $this->getType());
        $Icon = $this->getIcone();
        $this->Link = $this->Inicio . implode("/", $this->Local);
        $url = ($Dir ? "$this->Link/$this->File" : "$this->url/$this->File");

        echo "<div class='col-md-2 ftp-icon'>\n"
        . "<a href='$url' " . (!$Dir ? 'target="_blank"' : '') . ">\n"
        . "<img src='$Icon' class='img-responsive' alt='{$File}' title='$File'>\n"
        . "</a>\n"
        . str_replace("_", "-", $File)
        . "</div>\n";
    }

    function setInicio($inicio) {
        $this->Inicio = $inicio;
    }

    function getNav() {
        $nav = "<a href=\"$this->Inicio\" title=\"inicio\" ><strong>Inicio</strong></a> / ";
        foreach ($this->Local as $value) {
            $nav .= "<a href=\"$this->Inicio/$value\" title=\"$value\" ><strong>$value</strong></a> / ";
        }

        echo $nav;
    }

    /**
     * Retorna o caminho da pasta que esta no momento.
     * 
     * @return string
     */
    function getDir() {
        return $this->Dir;
    }

    /**
     * Retorna a arvore da navegação em pastas
     * 
     * @return array
     */
    function getLocal() {
        return $this->Local;
    }

    /**
     * ****************************************
     * ************* PRIVATES *****************
     * ****************************************
     */

    /**
     * recebe a url da pasta que esta e mapeia em uma array
     */
    private function setLocal() {
        $this->Local = explode("/", filter_input(INPUT_GET, "ftp", FILTER_DEFAULT));
        if ($this->Local[0] == ''):
            array_shift($this->Local);
        endif;
        $this->Local = array_filter($this->Local);
    }

    /**
     * Retorna o tipo de arquivo armazenado em File
     * 
     * @return string type
     */
    private function getType() {
        $tipo = explode(".", $this->File);
        return array_pop($tipo);
    }

    /**
     * Retorna o caminho do icone com base no tipo
     * 
     * @return string url
     */
    private function getIcone() {
        $FileIcon = "C:/xampp/htdocs/intranet/themes/intranet/images/ftpIcons/$this->Type.png";
        if (!file_exists($FileIcon)):
            $icon = HOME . "/" . REQUIRE_PATH . "/images/ftpIcons/arquivos.png";
        else:
            $icon = HOME . "/" . REQUIRE_PATH . "/images/ftpIcons/$this->Type.png";
        endif;

        return $icon;
    }

}
