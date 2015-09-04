<?php

/**
 * Classe que gerencia a negociação com o banco de dados
 *
 * @copyright (c) 2015, Adriano Reis AdrianoReis Tecnologia
 */
abstract class Business extends Conn {

    /** @var string Nome da tabela */
    protected $Table;

    /** @var PDOStatement */
    protected $Stmt;

    /**
     * Termos da queryString
     * @var string 
     */
    protected $Termos;

    /**
     * Dados utilizados executar o codigo
     * 
     * @var array 
     */
    protected $Dados;

    /**
     * true para gerar bindParam com todos os dados
     *
     * @var boolean
     */
    protected $BindParam;

    /**
     *  Resultado da busca ou da operação, 
     * 
     * @var Object 
     */
    protected $Result;

    abstract public function insert($Dados);

    abstract public function update($Dados, $IdFild, $Termos = null);

    abstract public function delete($Dados, $Termos = null);

    public function setDados($Dados) {
        $this->Dados = $Dados;
    }

    public function getDados() {
        return $this->Dados;
    }

    /**
     * ****************************************
     * *************** BUSCAS *****************
     * ****************************************
     */

    /**
     * <b>O parametro deve ser um array atribuitivo apenas com Id da tabela</b>
     * 
     * @param array $Dados
     * @return array
     */
    public function find($Dados = null) {
        if (!$Dados):
            $Dados = $this->getDados();
        endif;
        $dados = $this->setWhile($Dados);
        $while = implode(' AND ', $dados['Condition']);
        $sql = "SELECT * FROM {$this->Table} WHERE {$while}";
        $this->Execute($sql);
        $this->Stmt->execute($this->Dados);
        $this->Result = $this->Stmt->fetch();
        return $this->Result;
    }

    /**
     * <b>Não é passado com os Joins</b>
     * 
     * @return array[Objetos]
     */
    public function findAll() {
        $this->Termos = "SELECT * FROM $this->Table";
        $this->Busca(null, true);
        $this->Result = $this->Stmt->fetchAll();
        return $this->Result;
    }

    /**
     * @param Nome do campo Indice $FildName
     * 
     * @return Ultimo Id do Banco
     */
    public function MaxFild($FildName) {
        $this->Termos = "SELECT MAX({$FildName}) as 'id' FROM {$this->Table}";
        $this->Busca(null, true);
        $this->Result = $this->Stmt->fetch()->id;
        return $this->Result;
    }

    /**
     * Os termos são a queryString a partir do WHERE deixando-o de fora,
     * Os dados podem ser um array atribuitivo ou uma parseString
     * 
     * @param string $Termos
     * @param parseString array $Dados
     */
    public function Query($Termos, $Dados = null, $BindParam = null) {
        $this->Termos = "SELECT * FROM {$this->Table} WHERE " . $Termos;
        $this->BindParam = ($BindParam ? $BindParam : false);
        $this->Busca($Dados, true);
        $this->Result = $this->Stmt->fetchAll();
        return $this->Result;
    }

    /**
     * query String completa, com a possibilidade de executar os dados ou criar os bindParam
     * 
     * @param string $Termos
     * @param string array $Dados
     * @param boolean $BindParam
     */
    public function FullRead($Termos, $Dados = null, $BindParam = null) {
        $this->Termos = $Termos;
        $this->BindParam = ($BindParam ? $BindParam : false);
        $this->Busca($Dados, true);
        $this->Result = $this->Stmt->fetchAll();
        return $this->Result;
    }

    /**
     * Executa a busca com os Termos, Dados e Binds já setados.
     * 
     * @return Object
     */
    public function Busca($Dados = null, $new = null) {
        $this->setFilds($Dados);
        $this->Execute($this->Termos);
        $this->Commit();
        if (!$new):
            $this->Result = $this->Stmt->fetchAll();
            return $this->Result;
        endif;
    }

    protected function Execute($Sql) {
        $this->Stmt = Conn::prepare($Sql);

        if ($this->Dados && array_key_exists('limit', $this->Dados)) {
            $Limit = (int) $this->Dados['limit'];
            $this->Stmt->bindParam(':limit', $Limit, PDO::PARAM_INT);
            unset($this->Dados['limit']);
        }

        if ($this->Dados && array_key_exists('offset', $this->Dados)) {
            $Offset = (int) $this->Dados['offset'];
            $this->Stmt->bindParam(':offset', $Offset, PDO::PARAM_INT);
            unset($this->Dados['offset']);
        }

        if ($this->BindParam):
            foreach ($this->Dados as $dado => $value):
                $this->Stmt->bindParam(":{$dado}", $value);
            endforeach;
            $this->Dados = null;
        endif;
    }

    public function getRowCount() {
        return $this->Stmt->rowCount();
    }

    /**
     * <b>Executa a query preparada</b>
     * 
     * @return boolean
     */
    protected function Commit() {
        try {
            if (!$this->BindParam):
                $this->Stmt->execute($this->Dados);
            else:
                $this->Stmt->execute();
            endif;
            $this->Result = $this->getRowCount();
        } catch (PDOException $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine());
            $this->Result = false;
        }
        return $this->Result;
    }

    /**
     * Trabalha os dados para montar a query string
     * 
     * <b>Retorna um array atribuitivo com os seguintes campos
     * 
     * string Fields = campos informados nos dados Ex.: compo1, compo2
     * 
     * string Values = valores para a queryString Ex.: :campo1, :campo2
     * 
     * array Condition = condições para a query Ex.: campo1 = :campo1
     * 
     * array Links = links Ex.: #campo1#
     * </b>
     * @param string, array $Dados
     * @return array
     */
    protected function setWhile($Dados) {
        $this->parseString($Dados);
        $Keys = array_keys($this->Dados);
        $Fields = implode(', ', $Keys);
        $Values = ':' . implode(', :', $Keys);
        $Links = [];
        foreach ($Keys as $value):
            $Condition[$value] = "{$value} = :{$value}";
            $Links[] = "#" . $value . "#";
        endforeach;
        unset($Keys);

        return ['Fields' => $Fields, 'Values' => $Values, 'Condition' => $Condition, 'Links' => $Links];
    }

    /**
     * Cria os links e os insere nos devidos lugares, caso exista.
     * 
     * @param string array $Dados
     */
    protected function setFilds($Dados) {
        if (!$Dados):
            $Dados = $this->Dados;
        endif;

        if ($Dados):
            $Replace = $this->setWhile($Dados);
            $this->Termos = str_replace($Replace['Links'], $Replace['Condition'], $this->Termos);
        endif;
    }

    /*
     * ****************************************
     * ********* PRIVATES FUNCTION ************
     * ****************************************
     */

    /**
     * Trabalha a parseString e popula com um array os Dados
     * 
     * @param string array $Dados
     */
    private function parseString($Dados) {
        if (!is_array($Dados)):
            parse_str($Dados, $Dados);
        endif;
        $this->Dados = $Dados;
    }

}
