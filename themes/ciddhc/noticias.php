<?php
if ($Link->getData()):
    $getResult = $Link->getData();
    $post_type = $getResult[0]->post_type;
    $titulo = ($getResult[0]->post_type == 'post' ? 'Mais notícias' : $getResult[0]->post_type);
else:
    header('Location: ' . HOME . DIRECTORY_SEPARATOR . '404');
endif;
?>
<div class="section">
    <div class="well">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center title"><?= $titulo; ?></h1>
            </div>
        </div>
        <?php
        $View = new View();
        $membro = $View->Load("noticias_m");
        $getPage = (int) (!empty($Link->getLocal()[2]) ? $Link->getLocal()[2] : 1);
        $Pager = new Pager(HOME . '/noticias/' . $post_type . '/');
        $Pager->ExePager($getPage, 6);
        $Read = new WsPosts;
        $Read->setPost_type($post_type);
        $Read->Execute()->Query("post_status = 1 AND post_type = :type ORDER BY post_date DESC, post_category DESC LIMIT :limit OFFSET :offset", "type={$post_type}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);
        if (!$Read->Execute()->getResult()):
            $Pager->ReturnPage();
            WSErro("Desculpe não temos noticias no momento, favor volte mais tarde!", WS_INFOR);
        else:
            $i = 0;
            echo "<div class='row'>\n";
            foreach ($Read->Execute()->getResult() as $item):
                if ($i % 3 == 0 && $i != 0):
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
        endif;
        $Pager->ExePaginator("ws_posts", "post_status = 1 AND #post_type#", "post_type={$getResult[0]->post_type}");
        ?>
    </div>
    <?= $Pager->getPaginator(); ?>
</div>