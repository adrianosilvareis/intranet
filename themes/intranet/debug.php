<hr>
<div class="col-md-9">

    <?php include "inc/parabens.inc.php"; ?>

    <?php include "inc/carrousel-gallery.inc.php"; ?>

    <?php
    $Titulo = "Destaques";
    $Categoria = "destaque";
    include "inc/noticias_tres.inc.php";
    ?>
    
</div>

<?php
//coluna direita
$cat = Check::CatByName("siderbar-left");
require("inc/siderbar.inc.php");
