<div class="content list_content">

    <section>

        <header>
            <h1>Tipo:</h1>
        </header>

        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Oppss: você tentou editar um tipo que não existe no sistema!", WS_INFOR);
        endif;

        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if ($action):
            require_once '_models/AdminSetorType.class.php';

            $postAction = filter_input(INPUT_GET, 'tipo', FILTER_VALIDATE_INT);
            $postUpdate = new AdminSetorType();

            switch ($action):
                case 'active':
                    $postUpdate->ExeStatus($postAction, '1');
                    WSErro("O status do tipo foi atualizado para <b>ativo</b>. Setor publicado!", WS_ACCEPT);
                    break;

                case 'inative':
                    $postUpdate->ExeStatus($postAction, '0');
                    WSErro("O status do tipo foi atualizado para <b>inativo</b>. Setor agora é um rascunho!", WS_ACCEPT);
                    break;

                case 'delete':
                    $postUpdate->ExeDelete($postAction);
                    WSErro('O Tipo <b>' . $postUpdate->getError()[0] . "</b>, foi deletado com sucesso!", $postUpdate->getError()[1]);
                    break;

                default:
                    WSErro("Ação não foi identificada pelo sistema, favor utilize os botões", WS_ERROR);
                    break;
            endswitch;
        endif;

        $posti = 0;
        $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $Pager = new Pager("painel.php?exe=setor_type/index&page=");
        $Pager->ExePager($getPage, 6);

        $Read = new Controle();
        $Read->FullRead("SELECT * FROM ws_setor_type ORDER by type_status ASC, type_content DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);

        if (!$Read->getResult()):
            $Pager->ReturnPage();
            WSErro("Desculpa, ainda não temos tipos cadastrados", WS_INFOR);
        else:
            foreach ($Read->getResult() as $tipo):
                $posti++;
                extract((array) $tipo);
                $status = (!$type_status ? 'style="background: #fffed8"' : '' );
                ?>
                <article<?php if ($posti % 2 == 0) echo ' class="right" '; ?> <?= $status; ?>>
                    <div class="img thumb_small"></div>

                    <h1><?= Check::Words($type_content, 5) ?></h1>
                    <ul class="info post_actions">
                        <li><strong>Tipo:</strong> Tipos de setores</li>
                        
                        <li><a class="act_edit" href="painel.php?exe=setor_type/update&typeId=<?= $type_id; ?>" title="Editar">Editar</a></li>
                        <?php if (!$type_status): ?>
                            <li><a class="act_ative" href="painel.php?exe=setor_type/index&tipo=<?= $type_id; ?>&action=active" title="Ativar">Ativar</a></li>
                        <?php else: ?>
                            <li><a class="act_inative" href="painel.php?exe=setor_type/index&tipo=<?= $type_id; ?>&action=inative" title="Inativar">Inativar</a></li>
                        <?php endif; ?>
                        <li><a class="act_delete" href="painel.php?exe=setor_type/index&tipo=<?= $type_id; ?>&action=delete" title="Excluir">Deletar</a></li>
                    </ul>
                </article>
                <?php
            endforeach;

            echo "<div class=\"clear\"></div>";

            $Pager->ExePaginator("ws_setor_type");
            echo $Pager->getPaginator();
        endif;
        ?>

        <div class="clear"></div>
    </section>
</div> <!-- content home -->