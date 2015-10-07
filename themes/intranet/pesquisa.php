<?php
$search = $Link->getLocal()[1];
$count = ($Link->getData()['count'] ? $Link->getData()['count'] : '0');
?>

<section class="section">
    <div class="container">
        <section class="section">
            <header>
                <h2>Pesquisa por: "<?= $search; ?>"</h2>
                <p>Sua pesquisa por <?= $search; ?> retornou <?= $count; ?> resultados:</p>
            </header>
        </section>

        <?php
        $getPage = (int) (!empty($Link->getLocal()[2]) ? $Link->getLocal()[2] : 1);
        $Pager = new Pager(HOME . '/pesquisa/' . $search . '/');
        $Pager->ExePager($getPage, 8);

        $readArt = new WsPosts();
        $readArt->Execute()->Query("post_status = 1 AND (post_title LIKE '%' :link '%' OR post_content LIKE '%' :link '%') ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "link={$search}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);
        if (!$readArt->Execute()->getResult()):
            $Pager->ReturnPage();
            WSErro("Desculpe, sua pesquisa não retornou resultados. Você pode resulmir sua pesquisa ou tentar outros termos!", WS_INFOR);
        else:
            $cc = 0;
            echo "<div class='row'>\n";
            foreach ($readArt->Execute()->getResult() as $cat):
                $View = new View();
                $tpl_cat = $View->Load('article_m');
                $cat->post_title = Check::Words($cat->post_title, 8);
                $cat->post_content = Check::Words($cat->post_content, 20);
                $cat->datetime = date('Y-m-d', strtotime($cat->post_date));
                $cat->pubdate = date('d/m/Y H:i', strtotime($cat->post_date));
                echo ($cc%4 == 0 ? "<div class='row'>\n</div>\n" : "");                
                echo "<div class='col-md-3'>";
                $View->Show((array) $cat, $tpl_cat);
                echo "</div>\n";
                $cc++;
            endforeach;
            echo "</div>\n";
        endif;


        $Pager->ExePaginator("ws_posts", "post_status = 1 AND (post_title LIKE '%' :link '%' OR post_content LIKE '%' :link '%')", "link={$search}");

        echo '<nav class="paginator">';
        echo $Pager->getPaginator();
        echo '</nav>';
        ?>

    </div>
</section>