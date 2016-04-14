<?php

include '../../_app/Config.inc.php';

if (!empty($_FILES['files'])):
    $gbFiles = Check::ListFiles($_FILES['files']);

    $Upload = new Upload();

    $RESP = array();

    $i = 0;
    foreach ($gbFiles as $file) :
        $imgName = 'temp' . substr(md5(time() + $i), 0, 5);
        $Upload->File($file, $imgName, 'temp',50);
        
        //verifica se é imagem e realiza o upload;
        
        $RESP[$i]['RESULT'] = $Upload->getResult();
        $RESP[$i]['ERROS'] = $Upload->getError();
        
        
        
        $i++;
    endforeach;
    
    echo json_encode($RESP);
endif;
