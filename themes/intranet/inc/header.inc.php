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
                    . "WHERE (r.user_recebimento = :user_id OR r.setor_recebimento = :setor_id) "
                    . "AND r.reg_finalizado = 0";
            $NcRegistro = new NcRegistro();
            $NcRegistro->Execute()->FullRead($sql, "user_id={$_SESSION['userlogin']['user_id']}&setor_id={$_SESSION['userlogin']['setor_id']}");
            
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
                <li class="username">Olá, <?= $_SESSION['userlogin']['user_name']; ?> <?= $_SESSION['userlogin']['user_lastname']; ?></li>  
                <?php if (Check::UserLogin(2)): ?>
                    <li><a class="icon profile radius" title="Perfil" href="<?= HOME ?>/admin/painel.php?exe=users/profile">Perfíl</a></li>
                    <li><a class="icon admin radius" title="Painel Admin" href="<?= HOME ?>/admin/painel.php">Admin</a></li>
                <?php else: ?>
                    <li><a class="icon profile radius" title="Perfil" href="<?= HOME ?>/profile">Perfíl</a></li>
                <?php endif; ?>
                <li><a class="icon logout radius" href="<?= HOME ?>/&logoff=true">Sair</a></li>
                <li><a class="badge" title="sair" href="<?= HOME ?>/plugin/nao-conformidade/&exe=user/list"><?= (!empty($size) ? $size : ""); ?></a></li>
            </ul>
        <?php endif; ?>

        <header>
            <h1 class="notitle logo shadow-right"><?= SITENAME ?><a title="<?= SITENAME ?>" href="<?= HOME ?>"><img src="<?= HOME . '/themes/' . THEME ?>/images/header-trans-inverse.png" alt="<?= SITENAME ?>" class="img-responsive"></a></h1>

            <?php require "menu.inc.php"; ?>

            <?php // require "login.inc.php";    ?>

            <?php include "parabens.inc.php"; ?>
            <!-- modal -->
        </header>
    </div>
</div>

