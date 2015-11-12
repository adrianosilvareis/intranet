<?php
ob_start();

$Login = new Login(1);
$getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
Check::UserOnline();

if (!$Login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: ' . IMP_INCLUDE);
else:
    $userlogin = $_SESSION['userlogin'];
endif;
?>
<header id="navtab">
    <nav>
        <h1><a href="<?= IMP_INCLUDE ?>admin" title="Dasboard">Dasboard</a></h1>

        <?php
        //ATIVA MENU
        if (isset($getexe)):
            $linkto = explode('/', $getexe);
        else:
            $linkto = array();
        endif;
        ?>
        <ul>
            <li class="li<?php if (in_array('postos', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Postos</a>
                <ul class="sub">
                    <li><a href="<?= IMP_INCLUDE ?>admin/&exe=postos/create">Criar Postos</a></li>
                    <li><a href="<?= IMP_INCLUDE ?>admin/&exe=postos/index">Listar / Editar Postos</a></li>
                </ul>
            </li>

            <li class="li<?php if (in_array('impressoras', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Impressoras</a>
                <ul class="sub">
                    <li><a href="<?= IMP_INCLUDE ?>admin/&exe=impressoras/create">Criar Impressoras</a></li>
                    <li><a href="<?= IMP_INCLUDE ?>admin/&exe=impressoras/index">Listar / Editar Impressoras</a></li>
                </ul>
            </li>

            <li class="li<?php if (in_array('modelo', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Modelos</a>
                <ul class="sub">
                    <li><a href="<?= IMP_INCLUDE ?>admin/&exe=modelo/create">Criar Modelos</a></li>
                    <li><a href="<?= IMP_INCLUDE ?>admin/&exe=modelo/index">Listar / Editar Modelos</a></li>
                </ul>
            </li>

            <li class="li<?php if (in_array('contadores', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Contadores</a>
                <ul class="sub">
                    <li><a href="<?= IMP_INCLUDE ?>admin/&exe=contadores/create">Criar Contadores</a></li>
                    <li><a href="<?= IMP_INCLUDE ?>admin/&exe=contadores/index">Listar / Editar Contadores</a></li>
                </ul>
            </li>

            <li class="li<?php if (in_array('taxas', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Taxas</a>
                <ul class="sub">
                    <li><a href="<?= IMP_INCLUDE ?>admin/&exe=taxas/create">Criar Taxas</a></li>
                    <li><a href="<?= IMP_INCLUDE ?>admin/&exe=taxas/index">Listar / Editar Taxas</a></li>
                </ul>
            </li>

            <!-- adicionar novas categorias aqui-->

            <li class="li"><a href="<?= IMP_INCLUDE ?>" target="_blank" class="opensub">Ver Site</a></li>
        </ul>
    </nav>
</header>

<div class="panel">
    <?php
    //QUERY STRING
    if (!empty($getexe)):
        $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . strip_tags(trim($getexe) . '.php');
    else:
        $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'home.php';
    endif;

    if (file_exists($includepatch)):
        require_once($includepatch);
    else:
        echo "<div class=\"content notfound\">";
        WSErro("<b>Erro ao incluir tela:</b> Erro ao incluir o controller /{$getexe}.php!", WS_ERROR);
        echo "</div>";
    endif;
    ?>
</div>