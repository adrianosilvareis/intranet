<?php

/**
 * Ftp.class.php [Helpers]
 * Classe responsavel por manipular e validar dados de conexao FTP
 * 
 * @copyright (c) 2016, Adriano S. Reis Programador
 */
class Ftp {

    private $Conn;
    private $Host;
    private $Dir;
    private $Pager;
    private $Result;
    private $Error;

    function __construct($Pager = null) {
        $this->Pager = $Pager;
    }

    function setConn($host) {
        $this->Host = $host;
        try {
            $this->Conn = ftp_connect($this->Host);
            $this->Result = true;
        } catch (Error $e) {
            $this->Conn = null;
            $this->Result = false;
            $this->Error = "Ocorreu um erro ao iniciar FTP: " . $e;
            echo $this->Error;
        }
    }

    function Download($local_file, $remote_file) {
        
        //cria pasta temp caso não exista
        if (!file_exists(DOCUMENT_ROOT . NAME . '/ftp/temp')):
            mkdir(DOCUMENT_ROOT . NAME . '/ftp/temp');
        endif;
        
        // open some file to write to
        $handle = fopen(DOCUMENT_ROOT . NAME . '/ftp' . $local_file, 'w');

        // try to download $remote_file and save it to $handle
        if (ftp_fget($this->Conn, $handle, $remote_file, FTP_ASCII, 0)) {
            echo "successfully written to $local_file\n";
            return true;
        } else {
            echo "There was a problem while downloading $remote_file to $local_file\n";
        }
    }

    function getNav($dir = null) {

        $nav = "<a href=\"$this->Pager&ftp=.\" title=\"inicio\" ><strong>Inicio</strong></a> / ";

        if (!empty($dir)) {
            $link = explode("/", $dir);

            $c = 0;
            foreach ($link as $key) {
                if (!empty($key) && $key != "."):
                    $url = "";
                    for ($i = 0; $i <= $c; $i++) {
                        $url .= $link[$i] . "/";
                    }
                    $nav .= "<a href=\"$this->Pager&ftp=$url\" title=\"$key\" ><strong>$key</strong></a> / ";
                endif;
                $c++;
            }
        }

        return $nav;
    }

    function getIcon($url, $title, $type = null, $isFile = null) {
        $img = FTP_HOME . "/images/$type.png";
        if (!file_exists(getcwd() . "/ftp/images/$type.png") && $isFile):
            $img = FTP_HOME . "/images/arquivos.png";
        endif;

        echo "<div class=col-md-2 ftp-icon>
                <a href=\"$this->Pager$url\" title=\"$title\" " . ($isFile ? "target=\"_blank\"" : "") . ">
                    <img class='img-responsive' src=\"$img\" alt=\"$title\">
                </a>
                <p>$title</p>
             </div>";
    }

    function setLogin($User, $Pass) {
        try {
            ftp_login($this->Conn, $User, $Pass);
            $this->Result = true;
        } catch (Error $e) {
            $this->Result = false;
            $this->Error = "Ocorreu um erro ao tentar logar no servidor FTP: " . $e;
            echo $this->Error;
        }
    }

    function nlist($dir) {
        $this->Dir = $dir;
        return ftp_nlist($this->Conn, $this->Dir);
    }

    function ftp_is_dir($dir) {

        // get current directory
        $original_directory = ftp_pwd($this->Conn);
        // test if you can change directory to $dir
        // suppress errors in case $dir is not a file or not a directory

        if (ftp_chdir($this->Conn, $dir)) {
            // If it is a directory, then change the directory back to the original directory
            ftp_chdir($this->Conn, $original_directory);
            return true;
        } else {
            return false;
        }
    }

    function getError() {
        return $this->Error;
    }

    function getResult() {
        return $this->Result;
    }

}
