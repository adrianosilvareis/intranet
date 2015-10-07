<?php

class FindFile {
    #variaveis

    private $path;
    private $titulo;
    private $iconUrl;
    private $icon;
    private $url;
    private $list;
    private $message;
    private $imageClass;
    private $tituloClass;
    private $class;
    private $id;
    private $size;

    #get e set

    public function setPath($path) {
        $this->path = $path;
    }

    public function getPath() {
        return $this->path;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setIconUrl($iconUrl) {
        $this->iconUrl = $iconUrl;
    }

    public function getIconUrl() {
        return $this->iconUrl;
    }

    public function setIcon($icon) {
        $this->icon = $icon;
    }

    public function getIcon() {
        $icones = new RecursiveDirectoryIterator($this->getIconUrl());
        foreach ($icones as $key => $value) {
            if ($value->getFilename() == $this->icon . ".png") {
                $this->setIconUrl($this->getIconUrl() . $this->icon . ".png");
                return;
            }
        }
        $this->setIconUrl($this->getIconUrl() . "arquivos.png");
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setImageClass($imageClass) {
        $this->imageClass = $imageClass;
    }

    public function getImageClass() {
        return $this->imageClass;
    }

    public function setClass($class) {
        $this->class = $class;
    }

    public function getClass() {
        return $this->class;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setTituloClass($tituloClass) {
        $this->tituloClass = $tituloClass;
    }

    public function getTituloClass() {
        return $this->tituloClass;
    }

    public function setSize($width, $height) {
        $this->size = 'width="' . $width . '" height="' . $height . '"';
    }

    public function getSize() {
        if ($this->size == "") {
            return 'width="70" height="70"';
        }
        return $this->size;
    }

    public function setList($list) {
        $this->list = $list;
    }

    public function getList() {
        try {
            $this->setList(new RecursiveDirectoryIterator($this->getPath()));
        } catch (RuntimeException $e) {
            $this->setMessage("Erro: 'Path' vazio ou invalido");
        }
        #$recursivo = new RecursiveIteratorIterator($list);
        return $this->list;
    }

    function execute() {

        // return '
        // <div id="'.$this->getId().'" style="width: 80px" class="'.$this->getClass().'">
        // 	<a href="'.$this->getUrl().'">
        // 		<img class="'.$this->getImageClass().'" src="'.$this->getIconUrl().'" alt="'.$this->getPath().'" '.$this->getSize().' />
        // 	</a>
        // 	<p class="'.$this->getTituloClass().'">'.$this->getTitulo().'</p>
        // </div>
        // ';

        return "
				<li><a href='{$this->getUrl()}''>{$this->getTitulo()}</a></li>
			";
    }

}

?>