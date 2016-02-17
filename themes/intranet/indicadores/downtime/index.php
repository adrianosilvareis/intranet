<?php

$dir = HOME . "/" . REQUIRE_PATH . "/indicadores/downtime/";
Register::addRegister("<script src=\"{$dir}js/downtime.module.js\"></script>");
Register::addRegister("<script src=" . HOME . "/" . REQUIRE_PATH . "/js/angular/filter/timestampBr.filter.js></script>");
Register::addRegister("<script src=\"{$dir}js/controller/user.ctrl.js\"></script>");

include 'user.php';
?>