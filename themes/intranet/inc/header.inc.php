<div class="section bg-sucesso">
    <?php
    if (isset($_SESSION['login_report'])):
        WSErro($_SESSION['login_report'][0], $_SESSION['login_report'][1]);
        unset($_SESSION['login_report']);
    endif;
    ?>

    <div class="container">
        <?php
        if ($Login->CheckLogin()):
            $sql = "SELECT count(r.reg_id) as size FROM nc_registro r "
                    . "WHERE (r.user_recebimento = :user_id OR r.area_recebimento = :setor_id) "
                    . "AND r.reg_finalizado = 0";

            extract($_SESSION['userlogin']);

            $NcRegistro = new NcRegistro();
            $NcRegistro->Execute()->FullRead($sql, "user_id={$area_id}&setor_id={$area_id}");

            if ($NcRegistro->Execute()->getResult()):
                $size = $NcRegistro->Execute()->getResult()[0]->size;

                echo "<script>"
                . "var title = 'Notificação de não conformidade';"
                . "var icon = '" . HOME . "/themes/" . THEME . "/images/ncon.png';"
                . "var content = 'Olá, você ou seu setor tem {$size} notificações que precisão de atenção!';"
                . "var link = '" . HOME . "/plugin/nao-conformidade/&exe=user/list';"
                . "var notification = $size;"
                . "</script>";
            endif;
            ?>
            <ul class="systema_nav radius">
                <li class="avatar">
                    avatar
                    <?php if (!empty($user_cover)): ?>
                        <img src="<?= HOME ?>/tim.php?src=<?= HOME ?>/uploads/<?= $user_cover; ?>&w=90&h=90" title="avatar" class="img img-responsive">
                    <?php endif; ?>
                </li>
                <li class="username">
                    <span class="item">Olá, <?= $user_name; ?> <?= $user_lastname; ?></span>
                    <span class="item">Setor: <?= strtolower($area_trabalho->area_title); ?></span>
                </li>
                <?php if (Check::UserLogin(2)): ?>
                    <li><a class="icon profile radius" title="Perfil" href="<?= HOME ?>/admin/painel.php?exe=users/profile">Perfíl</a></li>
                    <li><a class="icon admin radius" title="Painel Admin" href="<?= HOME ?>/admin/painel.php">Admin</a></li>
                <?php else: ?>
                    <li><a class="icon profile radius" title="Perfil" href="<?= HOME ?>/profile">Perfíl</a></li>
                <?php endif; ?>
                <li><a class="icon logout radius" title="Sair dos sistema" href="<?= HOME ?>/&logoff=true">Sair</a></li>
                <li><a class="badge" title="Eventos aguardando resposta" href="<?= HOME ?>/plugin/nao-conformidade/&exe=user/list"><?= (!empty($size) ? $size : ""); ?></a></li>
            </ul>
        <?php endif; ?>

        <header style="margin-top: 55px;">
            <h1 class="notitle logo shadow-right"><?= SITENAME ?><a title="<?= SITENAME ?>" href="<?= HOME ?>"><img src="<?= HOME . '/themes/' . THEME ?>/images/header-trans-inverse.png" alt="<?= SITENAME ?>" class="img-responsive"></a></h1>

            <?php require "menu.inc.php"; ?>

            <?php // require "login.inc.php";    ?>

            <?php include "parabens.inc.php"; ?>
            <!-- modal -->
        </header>
    </div>
</div>

