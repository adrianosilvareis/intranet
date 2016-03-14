<?php

/**
 * Conn.class.php [CONEXAO]
 * Clase abstrata de conexao, Padrão Singleton.
 * retorna um objeto PDO pelo metodo estatico getConn();
 * @copyright (c) 2015, Adriano Reis SunTzu Tecnologia
 */
class ConexaoBancoDeDados {

    /** @var PDO */
    private static $instance = null;

    /**
     * instancia de informações de conexão.
     * @var Array 
     */
    private static $InfoConexaoBD;

    /**
     * Connecta com o banco de dados pattern singleton.
     * Retorna um objeto PDO!
     */
    private static function getInstance() {
        try {
            if (!isset(self::$instance)):
                $dsn = "mysql:host=" . self::$InfoConexaoBD['DB_HOST'] . ";dbname=" . self::$InfoConexaoBD['DB_NAME'];
                $options = [ PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                self::$instance = new PDO($dsn, self::$InfoConexaoBD['DB_USER'], self::$InfoConexaoBD['DB_PASS'], $options);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            endif;
        } catch (PDOException $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine());
            die;
        }

        return self::$instance;
    }

    /**
     * Prepare statament 
     * @return PDO::prepare
     */
    public static function prepare($sql, $InfoConexaoBD) {
        if (!empty($InfoConexaoBD) && self::$InfoConexaoBD != $InfoConexaoBD):
            self::$InfoConexaoBD = $InfoConexaoBD;
            self::$instance = null;
        endif;

        return self::getInstance()->prepare($sql);
    }

}
