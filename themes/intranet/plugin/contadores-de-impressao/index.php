<section class="section">
    <div class="container">
        <div class="well">

            <?php
            //Check::Manutencao($Link->getLocal());
            include_once 'config.inc.php';
            ?>
            <header>
                <h1>Contadores de impressão</h1>
            </header>
            
            <?php
            if (!empty($Link->getLocal()[2]) && is_numeric($Link->getLocal()[2])):
                include_once 'inc/impressoras.inc.php';
            elseif (!empty($Link->getLocal()[2]) && $Link->getLocal()[2] === "admin"):
                include PLUGIN_PATH . "\contadores-de-impressao\admin\index.php";
            else:
                include_once 'inc/postos.inc.php';
            endif;
            ?>
        </div>
    </div>
</section>