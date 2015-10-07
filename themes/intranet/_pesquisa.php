<?php
$search = $Link->getLocal()[1];
$count = ($Link->getData()['count'] ? $Link->getData()['count'] : '0');
?>
<!--HOME CONTENT-->
<div class="site-container">

    <section class="page_categorias">
        <header class="cat_header">
            <h2>Pesquisa por: "<?= $search; ?>"</h2>
            <p class="tagline">Sua pesquisa por <?= $search; ?> retornou <?= $count; ?> resultados:</p>
        </header>

        <?php
        $getPage = (int) (!empty($Link->getLocal()[2]) ? $Link->getLocal()[2] : 1);
        $Pager = new Pager(HOME . '/pesquisa/' . $search . '/');
        $Pager->ExePager($getPage, 4);

        $readArt = new WsPosts();
        $readArt->Execute()->Query("post_status = 1 AND (post_title LIKE '%' :link '%' OR post_content LIKE '%' :link '%') ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "link={$search}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);
        if (!$readArt->Execute()->getResult()):
            $Pager->ReturnPage();
            WSErro("Desculpe, sua pesquisa não retornou resultados. Você pode resulmir sua pesquisa ou tentar outros termos!", WS_INFOR);
        else:
            $cc = 0;
            foreach ($readArt->Execute()->getResult() as $cat):
                $cc++;
                $View = new View();
                $tpl_cat = $View->Load('article_m');
                $class = ($cc % 3 == 0 ? ' class="right"' : null);
                echo "<span{$class}>";
                $cat->post_title = Check::Words($cat->post_title, 8);
                $cat->post_content = Check::Words($cat->post_content, 20);
                $cat->datetime = date('Y-m-d', strtotime($cat->post_date));
                $cat->pubdate = date('d/m/Y H:i', strtotime($cat->post_date));
                $View->Show((array) $cat, $tpl_cat);
                echo "</span>";
            endforeach;
        endif;

        $Pager->ExePaginator("ws_posts", "post_status = 1 AND (post_title LIKE '%' :link '%' OR post_content LIKE '%' :link '%')", "link={$search}");

        echo '<nav class="paginator">';
        echo '<h2>Mais resultados para NOME DA CATEGORIA</h2>';
        echo $Pager->getPaginator();
        echo '</nav>';
        ?>

    </section>

    <div class="clear"></div>
</div><!--/ site container -->