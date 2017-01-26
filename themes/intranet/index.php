<hr>
<div class="col-md-9">

    <?php
    $carrousel = Check::CatByName("destaques");
//    include "inc/carrousel-gallery.inc.php";
    include "inc/carrousel.inc.php";
    ?>

    <?php
    $Titulo = "Destaques";
    $Categoria = "destaques";
    $Ordem = "post_date";
//    $Offset = 3;
    include "inc/noticias_tres.inc.php";
    ?>

    <?php
    $Titulo = "Convênios";
    $Categoria = "convenios";
    $Ordem = "post_views";
    include "inc/noticias_tres.inc.php";
    ?>

    <?php
    $Titulo = "Nota Fiscal";
    $Categoria = "nota-fiscal";
    $Ordem = "post_views";
    include "inc/noticias_tres.inc.php";
    ?>

</div>

<?php
//coluna direita
$cat = Check::CatByName("siderbar-left");
$fixo = Check::CatByName("siderbar-left-fixo");
require("inc/siderbar.inc.php");
