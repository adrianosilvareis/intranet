<?php

$dir = HOME . "/" . REQUIRE_PATH . "/indicadores/downtime/";
Register::addRegister("<script src=\"{$dir}js/downtime.module.js\"></script>");
Register::addRegister("<script src=\"{$dir}js/controller/user.ctrl.js\"></script>");

include 'user.php';
?>