<?php
if ($Link->getData()):
    extract($Link->getData());
else:
    header('Location: ' . HOME . DIRECTORY_SEPARATOR . '404');
endif;
?>
<!--HOME CONTENT-->
<section class="section">

    <article class="col-md-12">
        <!--<article>-->

        <div class="content artigos">
            <!--<div>-->

            <!--CABEÇALHO GERAL-->
            <header>
                <hgroup>
                    <h1><?= $post_title; ?></h1>
                    <div class="imagem">
                        <?= Check::Image('uploads' . DIRECTORY_SEPARATOR . $post_cover, $post_title, 578) ?>
                    </div>
                    <time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>" pubdate>Enviada em: <?= date('d/m/Y H:i', strtotime($post_date)); ?>Hs</time>
                </hgroup>
            </header>

            <!--CONTEUDO-->
            <div class="htmlchars">
                <?= $post_content; ?>
                <!--ARQUIVOS-->
                <?php
                $Files = new WsPostsFile();
                $Files->setPost_id($post_id);
                $Files->Execute()->Query("#post_id# ORDER BY file_date DESC");
                if ($Files->Execute()->getResult()):
                    ?>
                    <section class="section">
                        <hgroup>
                            <h3>Links para Downloads:</h3>
                        </hgroup>
                        <ul>
                            <?php
                            foreach ($Files->Execute()->getResult() as $file):
                                extract((array) $file);
                                ?>
                                <li>
                                    <a href=href="<?= HOME ?>/uploads/<?= $file_url; ?>"><?= $file_name; ?></a> 
                                </li>
                                <?php
                            endforeach;
                            ?>
                        </ul>
                    </section>
                    <?php
                endif;
                ?>


                <!--GALERIA-->
                <?php
                $ReadGb = new WsPostsGallery;
                $ReadGb->setPost_id($post_id);
                $ReadGb->Execute()->Query("#post_id# ORDER BY gallery_date DESC");
                if ($ReadGb->Execute()->getResult()):
                    ?>
                    <section class="gallery">
                        <hgroup>
                            <h3>
                                GALERIA:
                                <p> Veja fotos em: <mark><?= $post_title; ?></mark></p>
                            </h3>
                        </hgroup>

                        <ul>
                            <?php
                            $gb = 0;
                            foreach ($ReadGb->Execute()->getResult() as $gallery):
                                $gb++;
                                extract((array) $gallery);
                                ?>
                                <li>
                                    <div class="img">
                                        <a href="<?= HOME ?>/uploads/<?= $gallery_image; ?>" rel="shadowbox[<?= $post_id; ?>]" title="Imagem <?= $gb; ?> do post <?= $post_title; ?>">
                                            <?= Check::Image('uploads' . DIRECTORY_SEPARATOR . $gallery_image, "Imagem {$gb} do post {$post_title}", 120, 80) ?>
                                        </a>
                                    </div>
                                </li>
                                <?php
                            endforeach;
                            ?>
                        </ul>
                        <div class="clear"></div>
                    </section>
                <?php endif; ?>
            </div>

            <!--RELACIONADOS-->
            <?php
            $readMode = new Controle;
            $readMode->setTable("ws_posts");
            $readMode->Query("post_status = 1 AND post_id != :post_id AND #post_category# ORDER BY rand() LIMIT 2", "post_id={$post_id}&post_category={$post_category}");

            if ($readMode->getResult()):
                $View = new View;
                $tpl_m = $View->Load('article_relacionados');
                ?>
                <footer class="relacionados">
                    <section>
                        <h3>Veja também:</h3>

                        <?php
                        foreach ($readMode->getResult() as $more):
                            $more->datetime = date('Y-m-d', strtotime($more->post_date));
                            $more->pubdate = date('d/m/Y H:i', strtotime($more->post_date));
                            $more->post_content = Check::Words($more->post_content, 20);
                            $View->Show((array) $more, $tpl_m);
                        endforeach;
                        ?>

                    </section>
                    <div class="clear"></div>
                </footer>
                <?php
            endif;
            ?>

            <!--Comentários aqui-->

        </div><!--art content-->

        <!--SIDEBAR-->
        <?php //require(REQUIRE_PATH . '/inc/sidebar.inc.php');  ?>

        <div class="clear"></div>
    </article>

    <div class="clear"></div>
</section><!--/ site container -->