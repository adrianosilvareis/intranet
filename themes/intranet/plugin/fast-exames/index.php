<section class="section">
    <div class="container">
        <div class="well">

            <?php
            //Check::Manutencao($Link->getLocal());
            include_once 'config.inc.php';
            $Login = new Login(1);
            ?>
            <header>
                <h1>Fast Exames</h1>
            </header>

            <?php
            if ($Login->CheckLogin()):
                include 'inc/admin.php';
            else:
                include 'inc/user.php';
            endif;
            ?>
        </div>
    </div>
</section>