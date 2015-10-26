<?php
if ($Link->getData()):
    extract($Link->getData());
else:
    header('Location: ' . HOME . DIRECTORY_SEPARATOR . '404');
endif;
?>

<section class="section">
    <div class="well content">
        
        <header>
            <h1 class="text-center">Equipe <small><?= $category_title; ?></small></h1>
            <p class="text-center"><?= $category_content; ?></p>
        </header>

        <?php
        $getPage = (int) (!empty($Link->getLocal()[2]) ? $Link->getLocal()[2] : 1);
        $Pager = new Pager(HOME . '/membros/' . $category_name . '/');
        $Pager->ExePager($getPage, 4);
        $Pager->ExePaginator("ws_posts", "post_status = 1 AND post_type = 'membros' AND (post_category = :cat OR post_cat_parent = :cat)", "cat={$category_id}", true);

        $Read = new WsPosts();
        $Read->Execute()->Query("post_status = 1 AND post_type = 'membros' AND (post_category = :cat OR post_cat_parent = :cat) ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "cat={$category_id}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);
        if (!$Read->Execute()->getResult()):
            $Pager->ReturnPage();
            WSErro("Desculpe, a categoria <b>{$category_title}</b> ainda não tem artigos publicados, favor volte mais tarde!", WS_INFOR);
        else:
            $View = new View();
            $membro = $View->Load("article_membro");
            $i = 0;
            echo "\n<!--membros-->\n";
            echo "\n<div class='row'>\n";
            foreach ($Read->Execute()->getResult() as $item):
                if ($i % 2 == 0 && $i != 0):
                    echo "</div>\n";
                    echo "<div class='row'>\n";
                endif;
                $item->post_title = Check::Words($item->post_title, 4);
                $item->post_content = Check::Words($item->post_content, 10);
                $item->datetime = date('Y-m-d', strtotime($item->post_date));
                $item->pubdate = date("d/m/Y H:i", strtotime($item->post_date));
                $View->Show((array) $item, $membro);
                $i++;
            endforeach;
            echo "</div>\n";
            echo "<!--membros end-->\n\n";
        endif;
        echo $Pager->getPaginator();
        ?>
    </div>
</section>