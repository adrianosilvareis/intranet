<?php
$View = new View();
$carousel = $View->Load("carousel_m");
$cartilha = $View->Load("cartilhas_m");
$youtube = $View->Load("youtube_m");
$tpl_p = $View->Load("article_p");
$tpl_m = $View->Load("article_m");

$Read = new WsPosts();
$result = $Read->Execute()->FullRead("SELECT COUNT(post_name) as 'cont' FROM ws_posts WHERE post_type = 'post'")[0]->cont;
$All = (!empty($Read->Execute()->findAll()) ? (int) $result : 0);
?>
<section class="section">
    <div class="well">
        <!-- carrousel -->
        <section class="section">

            <div id="fullcarousel-example" data-interval="4000" class="carousel slide"
                 data-ride="carousel">

                <?php
                $cat = Check::CatByName('destaque');
                $Read->Execute()->Query("post_status = 1 AND post_type = 'post' AND (post_cat_parent = :cat OR post_category = :cat) ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "cat={$cat}&limit=3&offset=0", true);
                if (!$Read->Execute()->getResult()):
                    WSErro("Desculpe não temos posts no momento, favor volte mais tarde!", WS_INFOR);
                else:
                    ?>


                    <!-- Indicators -->
                    <?php if ($Read->Execute()->getRowCount() > 1): ?>                         
                        <ol class="carousel-indicators">
                            <?php
                            $i = 0;
                            foreach ($Read->Execute()->getResult() as $ind):
                                $class = ($i == 0 ? "active" : "");
                                echo "<li data-target='#fullcarousel-example' data-slide-to='{$i}' class='{$class}'></li>" . "\n";
                                $i++;
                            endforeach;
                            ?>
                        </ol>
                    <?php endif; ?>


                    <!--itens-->
                    <div class="carousel-inner">
                        <?php
                        $i = 0;
                        foreach ($Read->Execute()->getResult() as $item):
                            $item->post_title = Check::Words($item->post_title, 12);
                            $item->post_content = Check::Words($item->post_content, 38);
                            $item->datetime = date('Y-m-d', strtotime($item->post_date));
                            $item->pubdate = date("d/m/Y H:i", strtotime($item->post_date));
                            $item->class = ($i == 0 ? "item active" : "item");
                            $View->Show((array) $item, $carousel);
                            $i++;
                        endforeach;
                        ?>
                    </div>


                    <?php
                    if ($Read->Execute()->getRowCount() > 1):
                        echo "<a class='left carousel-control' href='#fullcarousel-example' data-slide='prev'><i class='icon-prev fa fa-angle-left'></i></a>" . "\n";
                        echo "<a class='right carousel-control' href='#fullcarousel-example' data-slide='next'><i class='icon-next fa fa-angle-right'></i></a>" . "\n";
                    endif;
                endif;
                ?>

            </div>

        </section>
        <!-- carrousel -->


        <div class="row">
            <!--columa esquerda-->
            <?php
            //coluna esquerda
            require(REQUIRE_PATH . '/inc/colum.left.inc.php');

            //coluna direita
            require(REQUIRE_PATH . '/inc/colum.right.inc.php');
            ?>
        </div>

    </div>
</section>