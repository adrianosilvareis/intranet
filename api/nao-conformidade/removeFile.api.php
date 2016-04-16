<?php

$File = file_get_contents('php://input');

if (file_exists(json_decode($File)->TMP_NAME)):
    unlink(json_decode($File)->TMP_NAME);
    echo "removido";
else:
    echo "arquivo não encontrado!";
endif;
