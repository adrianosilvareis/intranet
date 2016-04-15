<?php

include '../../_app/Config.inc.php';

if (!empty($_FILES['files'])):
    $gbFiles = Check::ListFiles($_FILES['files']);

    $Upload = new Upload();

    $RESP = array();

    $i = 0;
    foreach ($gbFiles as $File) :
        $imgName = 'temp' . substr(md5(time() + $i), 0, 5);
        $Upload->File($File, $imgName, 'temp', 50);

        if ($Upload->getError() && stripos($Upload->getError(), 'image')):
            $Upload->Image($File, $imgName, null, 'temp');
        endif;
        $RESP[$i]['NAME'] = $File['name'];
        $RESP[$i]['TYPE'] = $File['type'];
        $RESP[$i]['TMP_NAME'] = BASEDIR . '/uploads/' .$Upload->getResult();
        $RESP[$i]['RESULT'] = HOME . '/uploads/' . $Upload->getResult();
        $RESP[$i]['TYNY'] = HOME . "/tim.php?src=" . $RESP[$i]['RESULT'] . "&w=202&h=105";
        $RESP[$i]['ERROS'] = $Upload->getError();
        $i++;
    endforeach;

    echo json_encode($RESP);
endif;
