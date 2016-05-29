<div class="content list_content">

    <section>
        <a href="painel.php?exe=area_trabalho/create" class="user_cad">Cadastrar Área de Trabalho</a>
        <a href="painel.php?exe=area_category/index" class="user_cad">Cadastrar Categorias</a>
        <header>
            <h1>Área de Trabalho:</h1>
        </header>
        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Oppss: você tentou editar uma área que não existe no sistema!", WS_INFOR);
        endif;

        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if ($action):
            require_once '_models/AdminArea.class.php';

            $postAction = filter_input(INPUT_GET, 'area', FILTER_VALIDATE_INT);
            $postUpdate = new AdminArea();

            switch ($action):
                case 'active':
                    $postUpdate->ExeStatus($postAction, '1');
                    WSErro("O status da área foi atualizado para <b>ativo</b>. Área publicado!", WS_ACCEPT);
                    break;

                case 'inative':
                    $postUpdate->ExeStatus($postAction, '0');
                    WSErro("O status do área foi atualizado para <b>inativo</b>. Área agora é um rascunho!", WS_ACCEPT);
                    break;

                case 'delete':
                    $postUpdate->ExeDelete($postAction);
                    WSErro($postUpdate->getError()[0], $postUpdate->getError()[1]);
                    break;

                default:
                    WSErro("Ação não foi identificada pelo sistema, favor utilize os botões", WS_ERROR);
                    break;
            endswitch;
        endif;

        $posti = 0;
        $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $Pager = new Pager("painel.php?exe=area/index&page=");
        $Pager->ExePager($getPage, 6);

        $Read = new Controle();
        $Read->FullRead("SELECT * FROM ws_area_trabalho ORDER by area_status ASC, area_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);

        if (!$Read->getResult()):
            $Pager->ReturnPage();
            WSErro("Desculpa, ainda não temos áreas cadastrados", WS_INFOR);
        else:
            foreach ($Read->getResult() as $setor):
                $posti++;
                extract((array) $setor);
                $status = (!$area_status ? 'style="background: #fffed8"' : '' );
                ?>
                <article<?php if ($posti % 2 == 0) echo ' class="right" '; ?> <?= $status; ?>>
                    <div class="img thumb_small"></div>

                    <h1><?= Check::Words($area_title, 5) ?></h1>
                    <p class="post_views"><strong>Descrição:</strong> <?= Check::Words($area_content, 5) ?></p>
                    <ul class="info post_actions">
                        <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($area_date)); ?>Hs</li>
                        <li><a class="act_edit" href="painel.php?exe=area_trabalho/update&areaId=<?= $area_id; ?>" title="Editar">Editar</a></li>

                        <?php if (!$area_status): ?>
                            <li><a class="act_ative" href="painel.php?exe=area_trabalho/index&area=<?= $area_id; ?>&action=active" title="Ativar">Ativar</a></li>
                        <?php else: ?>
                            <li><a class="act_inative" href="painel.php?exe=area_trabalho/index&area=<?= $area_id; ?>&action=inative" title="Inativar">Inativar</a></li>
                        <?php endif; ?>
                        <li><a class="act_delete" href="painel.php?exe=area_trabalho/index&area=<?= $area_id; ?>&action=delete" title="Excluir">Deletar</a></li>
                    </ul>
                </article>
                <?php
            endforeach;

            echo "<div class=\"clear\"></div>";

            $Pager->ExePaginator("ws_setor");
            echo $Pager->getPaginator();
        endif;
        ?>

        <div class="clear"></div>
    </section>
</div> <!-- content home -->