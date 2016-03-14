<?php
ob_start();
require_once './_app/Config.inc.php';
$Session = new Session;
?>
<!DOCTYPE html>
<html lang="pt-br" itemscope itemtype="http://schema.org/Article">

    <head>
        <?php
        $Link = new Link;
        $Link->getTags();
        ?>
    </head>

    <body>
        <?php
        $Login = new Login(5);
        require(REQUIRE_PATH . '/inc/header.inc.php');
        ?>

        <div class="section">
            <div class="container">
                <?php
                if (!require($Link->getPatch())):
                    WSErro('Erro ao incluir arquivo de navegação!', WS_ERROR, true);
                endif;
                ?>
            </div>
        </div>

        <?php
        require(REQUIRE_PATH . '/inc/footer.inc.php');

        Register::getRegister();
        ?>
    </body>
</html>
<?php
ob_end_flush();
