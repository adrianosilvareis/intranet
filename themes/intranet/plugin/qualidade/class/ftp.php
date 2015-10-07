<?php

//function __autoload($class_name) {
//    require_once 'class/' . $class_name . '.php';
//}

$FindFile = new FindFile();

$FindFile->setPath("arquivos");
$FindFile->setUrl("#");
$FindFile->setIconUrl("/ftp/img/arquivo.png");
$FindFile->setTitulo("titulo");
$FindFile->setClass("icon");
/*
  $value->getPath();//pasta raiz
  $value->getPathname();//endereço completo
  $value->getFilename();//nome do FindFile
 */
if (isset($_GET['path'])) {
    $FindFile->setPath($_GET['path']);
}

echo "<ul>";
foreach ($FindFile->getList() as $key => $value) {
    if (is_dir($value) && $value->getFilename() != "." && $value->getFilename() != "..") {
        $tipo = "pasta";
        $arr = explode(".", utf8_encode($value->getFilename()));
        if (isset($arr[1])) {
            $tipo = $arr[1];
        };
        $FindFile->setIconUrl('img/pastas/');
        $FindFile->setIcon($tipo);
        $FindFile->getIcon();
        $FindFile->setTitulo($arr[0]);
        $FindFile->setUrl('index.php?path=' . utf8_encode($value->getPathname()));
        echo $FindFile->execute();
    };
}

foreach ($FindFile->getList() as $key => $value) {
    if (is_file($value) && $value->getFilename() != "Thumbs.db") {
        $arr = explode(".", $value->getFilename());
        $tipo = $arr[count($arr) - 1];
        $FindFile->setIconUrl('img/tipos/');
        $FindFile->setIcon($tipo);
        $FindFile->getIcon();
        $FindFile->setTitulo(utf8_encode($value->getFilename()));
        $FindFile->setUrl(utf8_encode($value->getPathname()));
        echo $FindFile->execute();
    }
}
echo "</ul>";

echo $FindFile->getMessage();
