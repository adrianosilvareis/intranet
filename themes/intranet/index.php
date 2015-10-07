<hr>
<div class="col-md-9">

    <div id="carousel" data-interval="3000" class="carousel slide well" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $cat = Check::CatByName("destaque");
            $Read = new WsPosts();
            $Read->setPost_category($cat);
            $Read->Execute()->Query("post_status = 1 AND (post_category = :cat OR post_cat_parent = :cat) ORDER BY post_date LIMIT 3", "cat={$cat}", true);
            if (!$Read->Execute()->getResult()):
                WSErro("Opps! Não temos artigos em destaques!", WS_INFOR);
            else:
                $View = new View();
                $siderbar = $View->Load("carousel_m");
                $c = 0;
                foreach ($Read->Execute()->getResult() as $bar):
                    $bar->datetime = date('Y-m-d', strtotime($bar->post_date));
                    $bar->pubdate = date("d/m/Y H:i", strtotime($bar->post_date));
                    $bar->post_content = Check::Words($bar->post_content, 6);
                    $bar->class = ($c == 0 ? "item active" : "item");
                    if (!$bar->post_url):
                        $bar->post_url = "#HOME#/artigo/#post_name#";
                    endif;
                    $View->Show((array) $bar, $siderbar);
                    $c++;
                endforeach;
            endif;
            ?>

        </div>
        <?php
        if ($c != 1):
            echo "<a class='left carousel-control' href='#carousel' data-slide='prev'><i class='icon-prev fa fa-angle-left'></i></a>";
            echo "<a class='right carousel-control' href='#carousel' data-slide='next'><i class='icon-next fa fa-angle-right'></i></a>";
        endif;
        ?>
    </div>

    <section class="well">

        <div class="row"><h1 class="title-page">Intranet Tommasi</h1></div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <a href="<?= HOME ?>/membros/equipe-de-ti/"><img src="<?= HOME . '/themes/' . THEME ?>/images/site.png" alt="Intranet" class="img-responsive"></a>
            </div>
            <div class="col-md-6">
                <div class="text-justify">
                    <p>A <strong>INTRANET TOMMASI</strong>, surgiu da real necessidade de um maior abastecimento de informações sobre o que acontece em nosso Laboratório.</p>
                    <p>Para que todos nós, funcionários do Tommasi Laboratório, participemos mais ativamente do resultado gerado pela empresa e para nos informar mais sobre o que acontece em nossa instituição.</p>
                    <p>Este portal completa 6 anos de atividades, em 2015, e para que ele continue a melhorar e se tornar cada vez mais útil, necessitamos que todos colaborem com o abastecimento de informações e opiniões, para o crescimento de nosso trabalho.</p>
                    <p class="text-right"><a href="<?= HOME ?>/membros/equipe-de-ti/">TI – Tecnologia da Informação</a></p>
                </div>
            </div>
        </div>

    </section>
</div>

<?php
//coluna direita
$cat = Check::CatByName("siderbar-left");
require(REQUIRE_PATH . '/inc/siderbar.inc.php');
