<?php

if (!PRODUCAO):
    define("NCONDIR", HOME . "/include/nao-conformidade/js");
    Register::addRegister("<script src='" . NCONDIR . "/model.app.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/config/config.value.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/config/route.config.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/controller/setor.ctrl.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/controller/origem.ctrl.js'></script>");
//    Register::addRegister("<script src='" . NCONDIR . "/controller/registro.ctrl.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/controller/avaliacao.ctrl.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/controller/registroUser.ctrl.js'></script>");
    Register::addRegister("<script src='" . NCONDIR . "/controller/dashboard.ctrl.js'></script>");
endif;

$exe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
$user_online = $_SESSION['userlogin'];

if (!$exe && $user_online['user_level'] < 3) :
    require '/admin.php';
else :
    $exe = explode("/", $exe)[1];

    echo "<div class='well' ng-app='naoConformidade'>";

    if ($exe === 'list'):
        echo "<div class='btn-group'>";
        echo "<a href='/intranet/plugin/nao-conformidade/&exe=user/cadastro' class='btn btn-danger'>Registrar novo Evento</a>";
        echo "<a href='/intranet/plugin/nao-conformidade/&exe=user/update' class='btn btn-primary'>Atualizar Lista</a>";
        echo "</div>";
        require '/user.php';
    elseif ($exe === 'cadastro'):
        echo "<a href='/intranet/plugin/nao-conformidade/&exe=user/list' class='btn btn-primary'>Painel de Controle</a>";
        require 'system/registro/cadastro.php';
    elseif($exe === 'update'):
        header("Location: " . HOME . '/plugin/nao-conformidade/&exe=user/list');
    else:
        header("Location: " . HOME . "/404.php");
    endif;

    echo "</div>";
endif;