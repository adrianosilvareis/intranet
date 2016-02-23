<?php

$HOST = str_replace(":1989", "", HTTP_HOST);
$HOST = $HOST . ":8080/FatJSF/";
header("Location: " . $HOST);