<?php

if (!PRODUCAO):
    define("NCONDIR", HOME . "/include/nao-conformidade/js");
    Register::addRegister("<script src='" . NCONDIR . "/model.app.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/config/config.value.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/config/route.config.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/controller/setor.ctrl.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/controller/origem.ctrl.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/controller/registro.ctrl.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/controller/avaliacao.ctrl.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/controller/registroUser.ctrl.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/controller/dashboard.ctrl.js'></script>");
endif;

$user = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_BOOLEAN);
$user_online = $_SESSION['userlogin'];

if (!$user && $user_online['user_level'] < 3) :
    require '/admin.php';
else :
    require '/user.php';
endif;
?>
