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
        Check::Manutencao($Link->getLocal());
        ?>        
    </head>

    <body>
        <div class="section bg-color-fundo">
            <div class="corpo bg-color-branco">
                <?php
                require(REQUIRE_PATH . '/inc/header.inc.php');

                if (!require($Link->getPatch())):
                    WSErro('Erro ao incluir arquivo de navegação!', WS_ERROR, true);
                endif;
                ?>
            </div>
            <?php require(REQUIRE_PATH . '/inc/footer.inc.php'); ?>
        </div>
    </body>
</html>
<?php
ob_end_flush();
