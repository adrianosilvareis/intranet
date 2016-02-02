<?php

$dataLogin['user'] = "adriano@tommasi.com.br";
$dataLogin['pass'] = "onairda1";
$Login->ExeLogin($dataLogin);

header("Location: " . HOME);