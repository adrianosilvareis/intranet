<?php
/**
 * ****************************************
 * ***** Pagina de redirecionamento *******
 * **************************************** 
 */

/**
 * Executa o redirecionamento para os links e faz a contagem de views
 */

echo "redirecionamento...<br>";

$link = filter_input(INPUT_GET, "url", FILTER_DEFAULT);
$link = explode("/", $link);
if (!empty($link[1]) && $link[1] == "post"):
    $post_id = $link[2];
    $url = Check::ContPostViews($post_id);
    var_dump($url);
    header("Location: $url");
elseif(!empty($link[1]) && $link[1] == "categoria"):
    $category_id = $link[2];
    Check::ContCategoryViews($category_id);
endif;

echo "<div class='well'><h1>Se estiver vendo esta mensagem, <small>algo deu errado! entre em contato com o CPD.</small></h1></div>";