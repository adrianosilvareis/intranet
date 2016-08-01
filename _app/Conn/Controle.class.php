<?php

/**
 * Controle [Controle das informações]
 * Camada responsavel por gerenciar as informaçoes do banco
 * @copyright (c) 2015, Adriano S. Reis SunTzu Tecnologia
 */
class Controle extends Business {

    function __construct($Table = null) {
        $this->Table = $Table;
        $this->InfoConexaoBD = ['DB_HOST' => DB_HOST, 'DB_NAME' => DB_NAME, 'DB_USER' => DB_USER, 'DB_PASS' => DB_PASS];
    }

    public function setTable($Table) {
        $this->Table = (string) $Table;
    }

    public function getResult() {
        return $this->Result;
    }

    /**
     * Deve ser inserido um array com os seguintes campos
     * <br><b>[DB_HOST] = Host do Banco</b>
     * <br><b>[DB_NAME] = Nome do Banco</b>
     * <br><b>[DB_USER] = Usuario</b>
     * <br><b>[DB_PASS] = Senha</b>
     * 
     * @param array $DBConn
     */
    public function setDBConn(array $DBConn) {
        $this->InfoConexaoBD = $DBConn;
    }

    /**
     * array atribuitivo com os dados a serem incluidos e seus respectivos campos
     * @param parseString array $Dados
     */
    public function insert($Dados = null) {
        if (!$Dados):
            $Dados = $this->getDados();
        endif;        
        $Syntax = $this->setWhile($Dados);
        $Sql = "INSERT INTO {$this->Table} ({$Syntax['Fields']}) VALUES ({$Syntax['Values']})";
        $this->Execute($Sql);
        $this->Result = $this->Commit();
        return $this->Result;
    }

    /**
     * Deve ser informado um array atribuitifo ou uma parseString para atualizar os dados
     * 
     * O campo <b>IdFild</b> deve ser  informado o nome do campo que servira com obase para encontrar o objeto a ser atualizado.
     * Ex.: id_fild
     * 
     * @param parseString array $Dados
     * @param string $IdFild
     * @param string $Termos
     * @return boolean
     */
    public function update($Dados, $IdFild, $Termos = null) {
        if (!$Dados):
            $Dados = $this->getDados();
        endif;
        $Syntax = $this->setWhile($Dados);
        $Syntax['Id'] = $Syntax['Condition'][$IdFild];
        unset($Syntax['Condition'][$IdFild]);

        if (!empty($Termos)):
            $Syntax['Condition'] = $Termos;
        else:
            $Syntax['Condition'] = implode(', ', $Syntax['Condition']);
        endif;
        
        $Sql = "UPDATE {$this->Table} SET {$Syntax['Condition']} WHERE {$Syntax['Id']}";
        $this->Execute($Sql);
        $this->Result = $this->Commit();
        return $this->Result;
    }

    /**
     * <b>Atribuição do array é o nome do Id na tabela</b>
     * 
     * array atribuitivo com o ID do valor a ser excluido
     * @param array $Dados
     */
    public function delete($Dados = null, $Termos = null) {
        if (!$Dados):
            $Dados = $this->getDados();
        endif;
        $Syntax = $this->setWhile($Dados);
        if (!empty($Termos)):
            $Syntax['Condition'] = $Termos;
        else:
            $Syntax['Condition'] = implode(' AND ', $Syntax['Condition']);
        endif;

        $Sql = "DELETE FROM {$this->Table} WHERE {$Syntax['Condition']}";
        $this->Execute($Sql);
        $this->Result = $this->Commit();
        return $this->Result;
    }

    /**
     * 
     * @return boolean
     */
    public function truncate() {

        $this->Execute("SET FOREIGN_KEY_CHECKS = 0");
        $this->Result = $this->Commit();

        $this->Execute("TRUNCATE TABLE $this->Table");
        $this->Result = $this->Commit();

        $this->Execute("SET FOREIGN_KEY_CHECKS = 0");
        $this->Result = $this->Commit();

        return $this->Result;
    }

}
