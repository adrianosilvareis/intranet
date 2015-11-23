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
            if ($Login->CheckLogin()):
                include 'inc/admin.php';
            else:
                $Login->setLevel(2);
                if ($Login->CheckLogin()):
                    include 'inc/user.php';
                else:
                    WSErro("<b>Área Restrita!</b> Efetue login para acessar.", WS_INFOR);
                endif;
            endif;
            ?>
        </div>
    </div>
</section>