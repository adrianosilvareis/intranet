<div class="section bg-sucesso">
    <?php
    if (isset($_SESSION['login_report'])):
        WSErro($_SESSION['login_report'][0], $_SESSION['login_report'][1]);
        unset($_SESSION['login_report']);
    endif;
    ?>

    <div class="container">

        <?php if ($Login->CheckLogin()): ?>
            <ul class="systema_nav radius">
                <li class="username">Olá, <?= $_SESSION['userlogin']['user_name']; ?> <?= $_SESSION['userlogin']['user_lastname']; ?></li>  
                <?php if (Check::UserLogin(2)): ?>
                    <li><a class="icon profile radius" href="<?= HOME ?>/admin/painel.php?exe=users/profile">Perfíl</a></li>
                    <li><a class="icon admin radius" href="<?= HOME ?>/admin/painel.php">Admin</a></li>
                <?php else: ?>
                    <li><a class="icon profile radius" href="<?= HOME ?>/profile">Perfíl</a></li>
                <?php endif; ?>
                <li><a class="icon logout radius" href="<?= HOME ?>/&logoff=true">Sair</a></li>
            </ul>
        <?php endif; ?>

        <header>
            <h1 class="notitle logo shadow-right"><?= SITENAME ?><a title="<?= SITENAME ?>" href="<?= HOME ?>"><img src="<?= HOME . '/themes/' . THEME ?>/images/header-trans-inverse.png" alt="<?= SITENAME ?>" class="img-responsive"></a></h1>

            <?php require "menu.inc.php"; ?>

            <?php // require "login.inc.php"; ?>
            
            <?php include "parabens.inc.php"; ?>
            <!-- modal -->
        </header>
    </div>
</div>

