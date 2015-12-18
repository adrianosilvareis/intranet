<hr>
<div class="col-md-9">

    <?php include "inc/carrousel-gallery.inc.php"; ?>

    <?php include "inc/parabens.inc.php"; ?>

    <?php
    $Titulo = "Destaques";
    $Categoria = "destaque";
    $Ordem = "post_date";
    include "inc/noticias_tres.inc.php";
    ?>

    <?php
    $Titulo = "Convênios";
    $Categoria = "convenios";
    $Ordem = "post_views";
    include "inc/noticias_tres.inc.php";
    ?>
    
</div>

<?php
//coluna direita
$cat = Check::CatByName("siderbar-left");
require("inc/siderbar.inc.php");
