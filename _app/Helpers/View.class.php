<?php

/**
 * View [HELPER MVC]
 * Responsavel por carregar o template e povoar a view
 * arquitetura MVC
 * @copyright (c) year, Adriano S. Reis Programador
 */
class View {

    private $Data;
    private $Keys;
    private $Values;
    private $Template;

    /**
     * <b>Carregar Template View:</b> informe o caminho e o nome do arquivo que deseja carregar como view.
     * Não precisa informar extenção. O arquivo deve ter o formato view<b>.tpl.html</b>
     * @param STRING $Template = Caminho / Nome_do_arquivo
     */
    public function Load($Template) {
        $this->Template = REQUIRE_PATH . DIRECTORY_SEPARATOR . '_tpl' . DIRECTORY_SEPARATOR . (string) $Template;
        $this->Template = file_get_contents($this->Template . '.tpl.html');
        return $this->Template;
    }

    /**
     * <b>Exibir Template View:</b> Execute um foreach com um getResult() do seu model e informe o envelope
     * neste método para configurar a view. Não esqueça de carregar a view acima do foreach com o método Load.
     * @param array $Data = Array com dados obtidos
     */
    public function Show(array $Data, $View) {
        $this->setKeys($Data);
        $this->setValues();
        $this->ShowView($View);
    }

    /**
     * <b>Carregar PHP View:</b> 
     * para incluir, povoar e exibir o mesmo. Basta informar o caminho do arquivo<b>.inc.php</b> e um
     * envelope de dados dentro de um foreach!
     * @param STRING $File = Caminho / Nome_do_arquivo
     * @param ARRAY $Data = Array com dados obtidos
     */
    public function Request($File, array $Data) {
        extract($Data);
        require "{$File}.inc.php";
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    private function setKeys($Data) {
        $this->Data = $Data;
        $this->Data['HOME'] = HOME;
        $this->Keys = explode('&', '#' . implode('#&#', array_keys($this->Data)) . '#');
        $this->Keys[] = '#HOME#';
    }

    private function setValues() {
        $this->Values = array_values($this->Data);
    }

    private function ShowView($View) {
        $this->Template = $View;
        echo str_replace($this->Keys, $this->Values, $this->Template);
    }

}
