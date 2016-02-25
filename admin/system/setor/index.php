<div class="content list_content">

    <section>

        <header>
            <h1>Setores:</h1>
        </header>

        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Oppss: você tentou editar um setor que não existe no sistema!", WS_INFOR);
        endif;

        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if ($action):
            require_once '_models/AdminSetor.class.php';

            $postAction = filter_input(INPUT_GET, 'setor', FILTER_VALIDATE_INT);
            $postUpdate = new AdminPost;

            switch ($action):
                case 'active':
                    $postUpdate->ExeStatus($postAction, '1');
                    WSErro("O status do setor foi atualizado para <b>ativo</b>. Setor publicado!", WS_ACCEPT);
                    break;

                case 'inative':
                    $postUpdate->ExeStatus($postAction, '0');
                    WSErro("O status do setor foi atualizado para <b>inativo</b>. Setor agora é um rascunho!", WS_ACCEPT);
                    break;

                case 'delete':
                    $postUpdate->ExeDelete($postAction);
                    WSErro('O Setor ' . $postUpdate->getError()[0], $postUpdate->getError()[1]);

                    break;

                default:
                    WSErro("Ação não foi identificada pelo sistema, favor utilize os botões", WS_ERROR);
                    break;
            endswitch;
        endif;

        $posti = 0;
        $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $Pager = new Pager("painel.php?exe=setor/index&page=");
        $Pager->ExePager($getPage, 6);

        $Read = new Controle();
        $Read->FullRead("SELECT * FROM ws_setor ORDER by setor_status ASC, setor_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);

        if (!$Read->getResult()):
            $Pager->ReturnPage();
            WSErro("Desculpa, ainda não temos setor cadastrados", WS_INFOR);
        else:
            ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>teste</td>
                </tr>
            </tbody>
        </table>
        
            <?php
            foreach ($Read->getResult() as $setor):
                $posti++;
                extract((array) $setor);
                $status = (!$setor_status ? 'style="background: #fffed8"' : '' );
                ?>
                <article<?php if ($posti % 2 == 0) echo ' class="right" '; ?> <?= $status; ?>>
                    <div class="img thumb_small"></div>

                    <h1><?= Check::Words($setor_content, 5) ?></h1>
                    <ul class="info post_actions">
                        <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($setor_date)); ?>Hs</li>
                        <li><a class="act_edit" href="painel.php?exe=setor/update&setId=<?= $setor_id; ?>" title="Editar">Editar</a></li>

                        <?php if (!$setor_status): ?>
                            <li><a class="act_ative" href="painel.php?exe=setor/index&setor=<?= $setor_id; ?>&action=active" title="Ativar">Ativar</a></li>
                        <?php else: ?>
                            <li><a class="act_inative" href="painel.php?exe=setor/index&setor=<?= $setor_id; ?>&action=inative" title="Inativar">Inativar</a></li>
                        <?php endif; ?>
                        <li><a class="act_delete" href="painel.php?exe=setor/index&setor=<?= $setor_id; ?>&action=delete" title="Excluir">Deletar</a></li>
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