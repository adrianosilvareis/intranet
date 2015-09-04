<?php

/**
 * Pager.class [Helpers]

 * Realiza a gestão e apaginação de resultados do sistema
 * 
 * @copyright (c) 2015, Adriano Reis Empresa
 */
class Pager {

    /** DEFINE O PAGER */
    private $Page;
    private $Limit;
    private $Offset;

    /** REALIZA A LEITURA */
    private $Tabela;
    private $Termos;
    private $Places;
    private $BindParam;

    /** DEFINE O PAGINATOR */
    private $Rows;
    private $Link;
    private $MaxLinks;
    private $First;
    private $Last;

    /** RENDERIZA O PAGINATOR */
    private $Paginator;

    /**
     * <b>Iniciar Paginação:</b> Defina o link onde a paginação será¡ recuperada. Você ainda pode mudar os textos
     * do primeiro e último link de navegação e a quantidade de links exibidos (opcional)
     * @param STRING $Link = Ex: index.php?pagina&page=
     * @param STRING $First = Texto do link (Primeira PÃ¡gina)
     * @param STRING $Last = Texto do link (Ãšltima PÃ¡gina)
     * @param STRING $MaxLinks = Quantidade de links (5)
     */
    function __construct($Links, $First = null, $Last = null, $MaxLinks = null) {
        $this->Link = (string) $Links;
        $this->MaxLinks = ((int) $MaxLinks ? $MaxLinks : 5);
        $this->First = ((string) $First ? $First : 'Primeira pagina');
        $this->Last = ((string) $Last ? $Last : 'Última pagina');
    }

    /**
     * informa a primeira pagina e o limite de informaçoes por pagina
     * 
     * @param int $Page
     * @param int $Limit
     */
    public function ExePager($Page, $Limit) {
        $this->Page = ((int) $Page ? $Page : 1);
        $this->Limit = (int) $Limit;
        $this->Offset = ($this->Page * $this->Limit) - $this->Limit;
    }

    /**
     * <b>Retornar:</b> Caso informado uma page com número maior que os resultados, este método navega a paginação
     * em retorno até a página com resultados!
     * @return LOCATION = Retorna a página
     */
    public function ReturnPage() {
        if ($this->Page > 1):
            $nPage = $this->Page - 1;
            header("Location: {$this->Link}{$nPage}");
        endif;
    }

    /**
     * <b>Obter Página:</b> Retorna o número da página atualmente em foco pela URL. Pode ser usada para validar
     * a navegação da paginação!
     * @return INT = Retorna a página atual
     */
    public function getPage() {
        return $this->Page;
    }

    /**
     * Retorna o Limite de dados por pagina informado no <b>ExePage</b>
     * 
     * @return int
     */
    public function getLimit() {
        return $this->Limit;
    }

    /**
     * Retorna o Offset da pagina
     * 
     * @return int
     */
    public function getOffset() {
        return $this->Offset;
    }

    /**
     * seta as informações importantes ao Paginador.
     * 
     * @param string $Tabela
     * @param string $Termos
     * @param string $ParseString
     */
    public function ExePaginator($Tabela, $Termos = null, $ParseString = null, $BindParam = null) {
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;
        $this->BindParam = ($BindParam ? $BindParam : false);
        $this->Places = (string) $ParseString;
        $this->getSyntax();
    }

    /**
     * Retorna o HTML formatado do Paginador
     * 
     * @return HTML
     */
    public function getPaginator() {
        return $this->Paginator;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    private function getRow() {
        $Read = new Controle($this->Tabela);
        if (!empty($this->Places)):
            $Read->Query($this->Termos, $this->Places, $this->BindParam);
        else:
            $Read->findAll();
        endif;

        return $Read->getRowCount();
    }

    private function getSyntax() {

        $this->Rows = $this->getRow();

        if ($this->Rows > $this->Limit):
            $Paginas = ceil($this->Rows / ($this->Limit != 0 ? $this->Limit : 1));
            $MaxLinks = $this->MaxLinks;

            //começo da lista e primeira pagina
            $this->Paginator = "<ul class=\"pagination\">";
            $this->Paginator .= "<li><a title=\"{$this->First}\" href=\"{$this->Link}1\" >{$this->First}</a></li>";

            for ($iPag = $this->Page - $MaxLinks; $iPag <= $this->Page - 1; $iPag++):
                if ($iPag >= 1):
                    $this->Paginator .= "<li><a title=\"Página{$iPag}\" href=\"{$this->Link}{$iPag}\" >{$iPag}</a></li>";
                endif;
            endfor;

            $this->Paginator .= "<li class=\"active\"><a>{$this->Page}</a></li>";

            for ($dPag = $this->Page + 1; $dPag <= $this->Page + $MaxLinks; $dPag++):
                if ($dPag <= $Paginas):
                    $this->Paginator .= "<li><a title=\"Página{$dPag}\" href=\"{$this->Link}{$dPag}\" >{$dPag}</a></li>";
                endif;
            endfor;
            $this->Paginator .= "<li><a title=\"{$this->Last}\" href=\"{$this->Link}{$Paginas}\" >{$this->Last}</a></li>";
            $this->Paginator .= "</ul>";
        endif;
    }

}
