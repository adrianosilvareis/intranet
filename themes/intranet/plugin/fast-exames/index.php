<section class="section">    
    <div class="container">
        <div class="well">

            <?php
            //Check::Manutencao($Link->getLocal());
            include_once 'config.inc.php';
            $Login = new Login(3);
            ?>
            <header>
                <h1>Fast Exames</h1>
            </header>

            <?php
            if (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] >= 3):
                include 'admin/index.php';
            elseif (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] >= 2):
                include 'inc/user.php';
            elseif (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] == 1):
                WSErro("<b>Área Restrita!</b> Você não tem permissão para acessar esta área.", WS_INFOR);
            else:
                $Login->CheckLogin();
                WSErro("<b>Área Restrita!</b> Efetue login para acessar.", WS_INFOR);
            endif;
            ?>
        </div>
    </div>
</section>