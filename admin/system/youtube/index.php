<div class="content list_content">

    <section>

        <h1>Videos:</h1>

        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Oppss: você tentou editar um video que não existe no sistema!", WS_INFOR);
        endif;

        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if ($action):
            require_once '_models/AdminYoutube.class.php';

            $tubeAction = filter_input(INPUT_GET, 'post', FILTER_VALIDATE_INT);
            $tubeUpdate = new AdminYoutube();

            switch ($action):
                case 'active':
                    $tubeUpdate->ExeStatus($tubeAction, '1');
                    WSErro("O status do video foi atualizado para <b>ativo</b>. Video publicado!", WS_ACCEPT);
                    break;

                case 'inative':
                    $tubeUpdate->ExeStatus($tubeAction, '0');
                    WSErro("O status do video foi atualizado para <b>inativo</b>. Video agora é um rascunho!", WS_ACCEPT);
                    break;

                case 'delete':
                    $tubeUpdate->ExeDelete($tubeAction);
                    WSErro($tubeUpdate->getError()[0], $tubeUpdate->getError()[1]);

                    break;

                default:
                    WSErro("Ação não foi identificada pelo sistema, favor utilize os botões", WS_ERROR);
                    break;
            endswitch;
        endif;

        $posti = 0;
        $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $Pager = new Pager("painel.php?exe=youtube/index&page=");
        $Pager->ExePager($getPage, 6);

        $Read = new Controle();
        $Read->FullRead("SELECT * FROM app_youtube ORDER by youtube_status ASC, youtube_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);

        if ($Read->getResult()):
            foreach ($Read->getResult() as $post):
                $posti++;
                extract((array) $post);
                $status = (!$youtube_status ? 'style="background: #fffed8"' : '' );
                ?>
                <article<?php if ($posti % 2 == 0) echo ' class="right" '; ?> <?= $status; ?>>

                    <div class="img thumb_small">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe style="width: 120px; height: 70px;" class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $youtube_url; ?>"
                                    allowfullscreen=""></iframe>
                        </div>
                    </div>

                    <ul class="info post_actions">
                        <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($youtube_date)); ?>Hs</li>
                        <!--<li><a class="act_view" target="_blank" href="../artigo/<?= $post_name; ?>" title="Ver no site">Ver no site</a></li>;-->
                        <li><a class="act_edit" href="painel.php?exe=youtube/update&tubeId=<?= $youtube_id; ?>" title="Editar">Editar</a></li>

                        <?php if (!$youtube_status): ?>
                            <li><a class="act_ative" href="painel.php?exe=youtube/index&post=<?= $youtube_id; ?>&action=active" title="Ativar">Ativar</a></li>
                        <?php else: ?>
                            <li><a class="act_inative" href="painel.php?exe=youtube/index&post=<?= $youtube_id; ?>&action=inative" title="Inativar">Inativar</a></li>
                        <?php endif; ?>

                        <li><a class="act_delete" href="painel.php?exe=youtube/index&post=<?= $youtube_id; ?>&action=delete" title="Excluir">Deletar</a></li>
                    </ul>

                </article>
                <?php
            endforeach;
        else:
            $Pager->ReturnPage();
            WSErro("Desculpa, ainda não temos videos cadastrados", WS_INFOR);
        endif;
        ?>

        <div class="clear"></div>
    </section>
    <?php
    $Pager->ExePaginator("app_youtube");
    echo $Pager->getPaginator();
    ?>
    <div class="clear"></div>
</div> <!-- content home -->