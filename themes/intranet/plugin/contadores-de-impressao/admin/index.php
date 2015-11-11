<header id="navtab">
    <nav>
        <h1><a href="<?= IMP_INCLUDE ?>admin" title="Dasboard">Dasboard</a></h1>


        <ul>
            <li class="li"><a class="opensub" onclick="return false;" href="#">Postos</a>
                <ul class="sub">
                    <li><a href="<?= IMP_INCLUDE ?>admin/postos/create">Criar Postos</a></li>
                    <li><a href="<?= IMP_INCLUDE ?>admin/postos/index">Listar / Editar Postos</a></li>
                </ul>
            </li>

            <li class="li"><a class="opensub" onclick="return false;" href="#">Impressoras</a>
                <ul class="sub">
                    <li><a href="<?= IMP_INCLUDE ?>admin/impressoras/create">Criar Impressoras</a></li>
                    <li><a href="<?= IMP_INCLUDE ?>admin/impressoras/index">Listar / Editar Impressoras</a></li>
                </ul>
            </li>

            <li class="li"><a class="opensub" onclick="return false;" href="#">Modelos</a>
                <ul class="sub">
                    <li><a href="<?= IMP_INCLUDE ?>admin/modelo/create">Criar Modelos</a></li>
                    <li><a href="<?= IMP_INCLUDE ?>admin/modelo/index">Listar / Editar Modelos</a></li>
                </ul>
            </li>

            <li class="li"><a class="opensub" onclick="return false;" href="#">Contadores</a>
                <ul class="sub">
                    <li><a href="<?= IMP_INCLUDE ?>admin/contadores/create">Criar Contadores</a></li>
                    <li><a href="<?= IMP_INCLUDE ?>admin/contadores/index">Listar / Editar Contadores</a></li>
                </ul>
            </li>

            <li class="li"><a class="opensub" onclick="return false;" href="#">Taxas</a>
                <ul class="sub">
                    <li><a href="<?= IMP_INCLUDE ?>admin/taxas/create">Criar Taxas</a></li>
                    <li><a href="<?= IMP_INCLUDE ?>admin/taxas/index">Listar / Editar Taxas</a></li>
                </ul>
            </li>

            <!-- adicionar novas categorias aqui-->

            <li class="li"><a href="<?= IMP_INCLUDE ?>" target="_blank" class="opensub">Ver Site</a></li>
        </ul>
    </nav>
</header>

<div class="panel">
    <?php
    $File = "";
    $Local = "";
    if (!empty($Link->getLocal()[3])):
        $Local = $Link->getLocal()[3];
        if (!empty($Link->getLocal()[4])):
            $File = $Link->getLocal()[4];
        endif;
    endif;

    if (!empty($File) && file_exists(IMP_PATH . "admin\system\\{$Local}\\{$File}.php")):
        include_once IMP_PATH . "admin\system\\{$Local}\\{$File}.php";
    elseif(!empty($Local)):
        include_once IMP_PATH . "admin\\404.php";
    endif;
    ?>
</div>