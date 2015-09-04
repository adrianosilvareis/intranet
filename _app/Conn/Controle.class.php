<?php

/**
 * Controle [Controle das informações]
 * Camada responsavel por gerenciar as informaçoes do banco
 * @copyright (c) 2015, Adriano S. Reis SunTzu Tecnologia
 */
class Controle extends Business {

    function __construct($Table = null) {
        $this->Table = $Table;
    }

    public function setTable($Table) {
        $this->Table = (string) $Table;
    }

    public function getResult() {
        return $this->Result;
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

}
