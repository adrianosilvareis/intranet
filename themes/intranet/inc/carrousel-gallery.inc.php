
<?php
$cat = Check::CatByName("slide");
$c = 0;
$Read = new WsPosts();
$Read->setPost_category($cat);
$Read->Execute()->Query("post_status = 1 AND (post_category = :cat OR post_cat_parent = :cat) ORDER BY post_date LIMIT 3", "cat={$cat}", true);
if (!$Read->Execute()->getResult()):
    WSErro("Opps! Não temos artigos em destaques!", WS_INFOR);
else:
    ?>
    <div id="carousel" data-interval="3000" class="carousel slide well" data-ride="carousel">
        <div class="carousel-inner" >
            <?php
            $View = new View();
            $siderbar = $View->Load("carousel_full");
            foreach ($Read->Execute()->getResult() as $bar):

                $gallery = new WsPostsGallery();
                $gallery->setPost_id($bar->post_id);
                $gallery->Execute()->Query("#post_id#");
                foreach ($gallery->Execute()->getResult() as $gal):
                    $gal->post_title = $bar->post_title;
                    $gal->datetime = date('Y-m-d', strtotime($bar->post_date));
                    $gal->pubdate = date("d/m/Y H:i", strtotime($bar->post_date));
                    $gal->post_content = Check::Words($bar->post_content, 30);
                    $gal->class = ($c == 0 ? "item active" : "item");
                    if (!$bar->post_url):
                        $gal->post_url = "#HOME#/artigo/$bar->post_name";
                    else:
                        $gal->post_url = $bar->post_url;
                    endif;
                    $View->Show((array) $gal, $siderbar);
                    $c++;
                endforeach;
            endforeach;
            ?>
        </div>
        <?php
        if ($c != 1):
        //echo "<a class='left carousel-control' href='#carousel' data-slide='prev'><i class='icon-prev fa fa-angle-left'></i></a>";
        //echo "<a class='right carousel-control' href='#carousel' data-slide='next'><i class='icon-next fa fa-angle-right'></i></a>";
        endif;
        ?>
    </div>
<?php
endif;
?>
