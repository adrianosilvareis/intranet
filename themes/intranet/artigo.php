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

        <div class="content artigos well">
            <!--<div>-->

            <!--CABEÇALHO GERAL-->
            <?php
            if (!empty($Link->getLocal()[2])):
                
                $action = $Link->getLocal()[2];
                require_once 'admin/_models/AdminPost.class.php';

                $postUpdate = new AdminPost;

                switch ($action):
                    case 'active':
                        $postUpdate->ExeStatus($post_id, '1');
                        $post_status = 1;
                        WSErro("O status do post foi atualizado para <b>ativo</b>. Post publicado!", WS_ACCEPT);
                        break;

                    case 'inative':
                        $postUpdate->ExeStatus($post_id, '0');
                        $post_status = 0;
                        WSErro("O status do post foi atualizado para <b>inativo</b>. Post agora é um rascunho!", WS_ACCEPT);
                        break;

                    case 'delete':
                        $postUpdate->ExeDelete($post_id);
                        WSErro('O post ' . $postUpdate->getError()[0], $postUpdate->getError()[1]); 
                        break;

                    default:
                        WSErro("Ação não foi identificada pelo sistema, favor utilize os botões", WS_ERROR);
                        break;
                endswitch;
            endif;
            
            if ($Login->CheckLogin()):
                ?>
                <section class="row thumbnail col-md-offset-10 col-md-2">
                    <h1 class="info">Painel de edição</h1>
                    <ul class=" post_actions">
                        <li><a class="act_edit" href="<?= HOME ?>/admin/painel.php?exe=posts/update&postId=<?= $post_id; ?>" title="Editar">Editar</a></li>
                        <?php if (!$post_status): ?>
                        <li><a class="act_ative" href="<?= HOME . "/artigo/$post_name" ?>/active" title="Ativar">Ativar</a></li>
                        <?php else: ?>
                            <li><a class="act_inative" href="<?= HOME . "/artigo/$post_name" ?>/inative" title="Inativar">Inativar</a></li>
                        <?php endif; ?>
                        <li><a class="act_delete" href="<?= HOME . "/artigo/$post_name" ?>/delete" title="Excluir">Deletar</a></li>
                    </ul>
                </section>
                <?php
            endif;
            ?>

            <header>
                <hgroup>
                    <h1><?= $post_title; ?></h1>
                    <div class="imagem">
                        <a title="<?= $post_title; ?>" href="<?= $post_url; ?>" target="_blank">
                            <?= Check::Image('uploads' . DIRECTORY_SEPARATOR . $post_cover, $post_title, 578) ?>
                        </a>
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
                    <section class="gallery row">
                        <hgroup>
                            <h3>
                                GALERIA:
                                <p> Veja fotos em: <mark><?= $post_title; ?></mark></p>
                            </h3>
                        </hgroup>

                        <ul style="list-style: none; margin-left: 250px; margin-right: 250px;">
                            <?php
                            $gb = 0;
                            foreach ($ReadGb->Execute()->getResult() as $gallery):
                                $gb++;
                                extract((array) $gallery);
                                ?>
                                <li style="float: left;">
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
            $readMode->Query("post_status = 1 AND post_id != :post_id AND #post_category# ORDER BY rand() LIMIT 4", "post_id={$post_id}&post_category={$post_category}");

            if ($readMode->getResult()):
                $View = new View;
                $tpl_m = $View->Load('article_relacionados');
                ?>
                <footer class="relacionados row">
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
        <?php //require(REQUIRE_PATH . '/inc/sidebar.inc.php');   ?>

        <div class="clear"></div>
    </article>

    <div class="clear"></div>
</section><!--/ site container -->