<?php

define("DEBUG", HOME . "/include/debug/js");

Register::addRegister("<script src='" . DEBUG . "/app.js'></script>");
Register::addRegister("<script src='" . DEBUG . "/controllers/control.js'></script>");
?>

<section ng-app="aplication">
    <h1>Aplicação</h1>
    <div ng-view=""></div>
</section>