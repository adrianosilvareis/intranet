<?php

$File = file_get_contents('php://input');

if (!empty($File)):

    if (file_exists(json_decode($File)->FILE->tmp_name)):
        unlink(json_decode($File)->FILE->tmp_name);
        echo "removido";
    else:
        echo "arquivo não encontrado!";
    endif;
 
endif;