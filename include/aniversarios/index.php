<?php

if (!Check::UserLogin(2) || !isset($Link->getLocal()[2])):
    include_once 'lista.php';
else:
    if ($Link->getLocal()[2] === "upload"):
        include_once 'upload.php';
    elseif ($Link->getLocal()[2] === "save"):
        include_once 'save.php';
    else:
        header("Location: " . HOME . "/plugin/aniversarios&error=opcao");
    endif;
endif;