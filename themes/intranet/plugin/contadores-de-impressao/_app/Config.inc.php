<?php
//AUTO LOAD DE CALSSES ####################
function __autoload($Class_name) {

    $cDir = ['Conn', 'Helpers', 'Beans', 'Models', 'library'];
    $iDir = null;

    foreach ($cDir as $dirName):
        $file = __DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class_name . ".class.php";
        if (!$iDir && file_exists($file) && !is_dir($file)):
            require_once($file);
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possivel inclur {$Class_name}.class.php", E_USER_ERROR);
        die;
    endif;
}
