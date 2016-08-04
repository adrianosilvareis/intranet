<?php

switch ($method) {
    case "GET":
        //retorno não implementado
        echo json_encode($request);
        break;
    case "POST":

        //Adiciona arquivo a pasta temporaria
        if (!empty($_FILES['files'])):
            $gbFiles = Check::ListFiles($_FILES['files']);

            $Upload = new Upload();

            $RESP = array();

            $i = 0;
            foreach ($gbFiles as $File) :
                $Upload->File($File, null, 'temp', 50);

                if ($Upload->getError() && stripos($Upload->getError(), 'image')):
                    $Upload->Image($File, null, null, 'temp');
                endif;

                $File['tmp_name'] = BASEDIR . '/uploads/' . $Upload->getResult();
                $RESP[$i]['RESULT'] = HOME . '/uploads/' . $Upload->getResult();
                $RESP[$i]['TYNY'] = HOME . "/tim.php?src=" . $RESP[$i]['RESULT'] . "&w=202&h=105";
                $RESP[$i]['URL'] = $Upload->getResult();
                $RESP[$i]['ERROS'] = $Upload->getError();
                $RESP[$i]['FILE'] = $File;
                $i++;
            endforeach;
            if ($Upload->getResult()):
                echo json_encode($RESP);
            else:
                echo $Upload->getError();
            endif;

        endif;
        break;
    case "DELETE":
        //deletar
        if (!empty($fileUrl)):

            if (file_exists($fileUrl)):
                unlink($fileUrl);
                $delete = "removido";
            else:
                $delete = "arquivo não encontrado!";
            endif;
            echo json_encode($delete);
        endif;
        
        break;

    default:
        break;
}
