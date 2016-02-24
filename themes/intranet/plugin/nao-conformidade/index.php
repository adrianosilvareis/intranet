<?php
define("NCONDIR", HOME . "/" . REQUIRE_PATH . "/plugin/nao-conformidade/js");
Register::addRegister("<script src='" . NCONDIR . "/model.app.js'></script>");
Register::addRegister("<script src='" . NCONDIR . "/config.value.js'></script>");
Register::addRegister("<script src='" . NCONDIR . "/controller/setor.ctrl.js'></script>");

//include 'system/setor/index.php';
?>
<script>
    var alterClass = function (id) {
        $('.active').removeClass('active');
        $(id).addClass('active');
    };
</script>
<header id="navtab">
    <ul class="systema_nav radius">
        <li class="username">Olá Adriano Reis</li>
        <li><a class="icon profile radius" href="painel.php?exe=users/profile">Perfíl</a></li>
        <li><a class="icon users radius" href="painel.php?exe=users/users">Usuários</a></li>
        <li><a class="icon logout radius" href="painel.php?logoff=true">Sair</a></li>
    </ul>
    <nav>
        <h1><a href="painel.php" title="Dasboard">Dasboard</a></h1>

        <!--Query String-->
        <ul class="menu">
            <li id="principal" class="li"><a class="opensub" onclick="return false;" href="#">HOME</a>
                <ul class="sub">
                    <li><a href="#home" onclick="alterClass('#principal')" data-toggle="tab">Criar Post</a></li>
                    <li><a href="#home" data-toggle="tab">Listar / Editar Posts</a></li>
                </ul>
            </li>

            <li id="cat" class="li"><a class="opensub" onclick="return false;" href="#">Categorias</a>
                <ul class="sub">
                    <li><a href="#profile" onclick="alterClass('#cat')" data-toggle="tab">Criar Categoria</a></li>
                    <li><a href="#profile" data-toggle="tab">Listar / Editar Categorias</a></li>
                </ul>
            </li>

            <!--<li class="li"><a href="../" target="_blank" class="opensub">Ver Site</a></li>-->
        </ul>
    </nav>
</header>

<div class="tab-content">
    <div class="tab-pane" id="home">HOME</div>
    <div class="tab-pane" id="profile">PROFILE</div>
    <div class="tab-pane active" id="messages">MESSAGE</div>
    <div class="tab-pane" id="settings">SETTING</div>
</div>