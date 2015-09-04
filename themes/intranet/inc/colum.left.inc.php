<div class="col-md-8">

    <!--posts-->
    <div class="col-md-12">


        <section class="nomargin section">

            <h1 class="nomargin"><a href="<?= HOME ?>/noticias/post" class="btn btn-site">Mais notícias</a></h1>
            <div class="col-md-12 divbloco bg-color-rosa"></div>

            <article class="row"><!-- primeira linha -->
                <?php
                $offset = Check::getOffset(2, 3, $All);
                $Read->Execute()->Busca("cat={$cat}&limit=2&offset={$offset}");
                if (!$Read->Execute()->getResult()):
                    WSErro("Desculpe, não temos posts no momento, favor volte mais tarde!", WS_INFOR);
                else:
                    foreach ($Read->Execute()->getResult() as $row):
                        $row->post_title = Check::Words($row->post_title, 2);
                        $row->post_content = Check::Words($row->post_content, 5);
                        $row->datetime = date('Y-m-d', strtotime($row->post_date));
                        $row->pubdate = date("d/m/Y H:i", strtotime($row->post_date));
                        $View->Show((array) $row, $tpl_p);
                    endforeach;
                endif;
                ?>
            </article><!-- primeira linha -->

            <div class="col-md-12 divbloco bg-color-azul"></div>

            <article class="row"><!-- segunda linha -->
                <?php
                $offset = Check::getOffset(2, 5, $All);
                $Read->Execute()->Busca("cat={$cat}&limit=2&offset={$offset}");
                if (!$Read->Execute()->getResult()):
                    WSErro("Desculpe, não temos posts no momento, favor volte mais tarde!", WS_INFOR);
                else:
                    foreach ($Read->Execute()->getResult() as $row):
                        $row->post_title = Check::Words($row->post_title, 2);
                        $row->post_content = Check::Words($row->post_content, 5);
                        $row->datetime = date('Y-m-d', strtotime($row->post_date));
                        $row->pubdate = date("d/m/Y H:i", strtotime($row->post_date));
                        $View->Show((array) $row, $tpl_p);
                    endforeach;
                endif;
                ?>
            </article><!-- segunda linha -->
        </section>
    </div>
    <!--posts-->

    <!-- cartilhas -->
    <div class="col-md-12">

        <section class="nomargin section">

            <h1 class="nomargin"><a href="<?= HOME ?>/noticias/cartilhas/" class="btn btn-site">Cartilhas</a></h1>

            <?php
            $Read->Execute()->Query("post_status = 1 AND post_type = 'cartilhas' AND (post_cat_parent = :cat OR post_category = :cat) ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "cat={$cat}&limit=2&offset=0", true);
            if (!$Read->Execute()->getResult()):
                echo "<div style='display: block;margin-top:40px;'>\n";
                WSErro("Desculpe, não temos cartilhas no momento, favor volte mais tarde!", WS_INFOR);
                echo "</div>\n";
            else:
                foreach ($Read->Execute()->getResult() as $row):
                    $row->datetime = date('Y-m-d', strtotime($row->post_date));
                    $row->pubdate = date("d/m/Y H:i", strtotime($row->post_date));
                    $View->Show((array) $row, $cartilha);
                endforeach;
            endif;
            ?>
        </section>

    </div>
    <!-- cartilhas -->

    <!-- Canal Youtube -->
    <div class="col-md-12">

        <section class="nomargin section">
            
            <h1 class="nomargin"><a href="https://www.youtube.com/channel/<?= CANAL ?>" target="_blank" class="btn btn-site">Canal do Youtube</a></h1>
            
            <?php
            $AppYou = new AppYoutube();
            $AppYou->Execute()->Query("youtube_status = 1 ORDER BY youtube_date DESC LIMIT :limit OFFSET :offset", "limit=2&offset=0", true);
            if (!$AppYou->Execute()->getResult()):
                echo "<div style='display: block;margin-top:40px;'>\n";
                WSErro("Desculpe, não temos videos no momento, favor volte mais tarde!", WS_INFOR);
                echo "</div>\n";
            else:
                foreach ($AppYou->Execute()->getResult() as $row):
                    $row->datetime = date('Y-m-d', strtotime($row->youtube_date));
                    $row->pubdate = date("d/m/Y H:i", strtotime($row->youtube_date));
                    $View->Show((array) $row, $youtube);
                endforeach;
            endif;
            ?>
        </section>
    </div>
    <!-- Canal do youtube -->

</div>