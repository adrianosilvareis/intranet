<?php

$Login = new Login(2);

if ($Login->CheckLogin()):
    if (file_exists(__DIR__ . "/php/adm.php")):
        include __DIR__ . "/php/adm.php";
    endif;
else:
    if (file_exists(__DIR__ . "/php/user.php")):
        include __DIR__ . "/php/user.php";
    endif;
endif;