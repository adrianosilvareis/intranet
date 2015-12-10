<?php

/**
 * Ftp.class.php [Helpers]
 * Classe responsavel por manipular e validar arquivos no sistema
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class Ftp {

    private static $Dir;
    private static $Local;
    
    static function checkDir($Dir) {
        if (file_exists($Dir) && is_dir($Dir)):
            self::$Dir = $Dir;
            return true;
        else:
            return false;
        endif;
    }
    
    static function getDir(){
        return self::$Dir;
    }
    
    static function getLocal() {
        return self::$Local;
    }

    static function setLocal($Local) {
        self::$Local = $Local;
    }


}
