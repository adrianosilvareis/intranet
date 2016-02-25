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
    <nav>
        <h1><a href="painel.php" title="Dashboard">Dashboard</a></h1>

        <!--Query String-->
        <ul class="menu">
            <li id="principal" class="li"><a class="opensub" onclick="return false;" href="#">HOME</a>
                <ul class="sub">
                    <li><a href="#home_create" onclick="alterClass('#principal')" data-toggle="tab">Criar Post</a></li>
                    <li><a href="#home_list" data-toggle="tab">Listar / Editar Posts</a></li>
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
    <div class="tab-pane" id="home_create">Create HOME</div>
    <div class="tab-pane" id="home_list">LISTAR HOME</div>
</div>