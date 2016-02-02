<?php

/**
 * Register.class.php [Helpers]
 * Classe responsavel por manipular e validar registros e tags durante a execução do sistema
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class Register {

    private static $Data;
    private static $Register;

    /**
     * Registro de tags a ser lançado no fim da pagina.
     * Ex.: <script src='http://localhost/intranet/_cdn/_scripts.conf.js'></script>
     * 
     * @param string $Tags
     */
    public static function addRegister($Tags) {
        self::$Data = $Tags;
        self::setData();
    }

    /**
     * Retorna a lista de registros adicionado durante a execução do sistema.
     * 
     * @return String
     */
    public static function getRegister() {
        if (!empty(self::$Register)):
            self::$Register = implode("\n", self::$Register) . " \n";
        endif;

        echo self::$Register;
    }

    /**
     * ****************************************
     * ************** PRIVATES ****************
     * ****************************************
     */
    private static function setData() {
        if (empty(self::$Register) || !in_array(self::$Data, self::$Register)):
            self::$Register[] = self::$Data;
        endif;
    }

}
