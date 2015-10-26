<?php
if ($Link->getData()):
    extract($Link->getData());
else:
    header('Location: ' . HOME . DIRECTORY_SEPARATOR . '404');
endif;
?>

<section class="section">
    <div class="container">

        <div class="section">
            <div class="well">

                <header>
                    <h1 class="text-center"><?= $category_title; ?></h1>
                    <p class="text-center lead"><?= $category_content; ?></p>
                </header>
                <hr>
                <?php
                $getPage = (int) (!empty($Link->getLocal()[2]) ? $Link->getLocal()[2] : 1);
                $Pager = new Pager(HOME . '/grupo/' . $category_name . '/');
                $Pager->ExePager($getPage, 12);

                $Read = new WsPosts();
                $Read->Execute()->Query("post_status = 1 AND (post_category = :cat OR post_cat_parent = :cat) ORDER BY post_date, post_views DESC LIMIT :limit OFFSET :offset", "cat={$category_id}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);

                if (!$Read->Execute()->getResult()):
                    $Pager->ReturnPage();
                    WSErro("Desculpe, ainda não temos artigos cadastrado nesta categoria!", WS_INFOR);
                else:
                    ?>
                    <div class="row">
                        <?php
                        $View = new View();
                        $grupo_p = $View->Load('grupo_p');
                        $i = 0;
                        foreach ($Read->Execute()->getResult() as $item):
                            if ($i % 4 == 0 && $i != 0):
                                echo "</div>\n";
                                echo "<div class='row'>\n";
                            endif;
                            $item->post_title = Check::Words($item->post_title, 4);
                            $item->datetime = date('Y-m-d', strtotime($item->post_date));
                            $item->pubdate = date("d/m/Y H:i", strtotime($item->post_date));
                            $View->Show((array) $item, $grupo_p);
                            $i++;
                        endforeach;
                    endif;
                    ?>
                </div>

            </div>
            <?php
            $Pager->ExePaginator("ws_posts", "post_status = 1 AND (post_category = :cat OR post_cat_parent = :cat)", "cat={$category_id}");
            echo $Pager->getPaginator();
            ?>
        </div>

    </div>
</section>