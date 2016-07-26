<div class="content list_content">

    <section>
        
        <a href="painel.php?exe=perfil/create" class="user_cad">Novo Perfil</a>
        <a href="painel.php?exe=acessos/index" class="user_cad">Itens de perfil</a>
        
        <header>
            <h1>Perfis:</h1>
        </header>
        
        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Oppss: você tentou editar um perfil que não existe no sistema!", WS_INFOR);
        endif;

        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if ($action):
            require_once '_models/AdminPerfil.class.php';

            $perfilAction = filter_input(INPUT_GET, 'perfil', FILTER_VALIDATE_INT);
            $perfilUpdate = new AdminPerfil();

            switch ($action):
                case 'active':
                    $perfilUpdate->ExeStatus($perfilAction, '1');
                    WSErro("O status do perfil foi atualizado para <b>ativo</b>. Perfil publicado!", WS_ACCEPT);
                    break;

                case 'inative':
                    $perfilUpdate->ExeStatus($perfilAction, '0');
                    WSErro("O status do perfil foi atualizado para <b>inativo</b>. Perfil agora é um rascunho!", WS_ACCEPT);
                    break;

                case 'delete':
                    $perfilUpdate->ExeDelete($perfilAction);
                    WSErro('O perfil ' . $perfilUpdate->getError()[0], $perfilUpdate->getError()[1]);

                    break;

                default:
                    WSErro("Ação não foi identificada pelo sistema, favor utilize os botões", WS_ERROR);
                    break;
            endswitch;
        endif;

        $posti = 0;
        $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $Pager = new Pager("painel.php?exe=perfil/index&page=");
        $Pager->ExePager($getPage, 6);

        $Read = new Controle();
        $Read->FullRead("SELECT * FROM ws_perfil ORDER by perfil_status ASC, perfil_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);

        if (!$Read->getResult()):
            $Pager->ReturnPage();
            WSErro("Desculpa, ainda não temos perfis cadastrados", WS_INFOR);
        else:
            foreach ($Read->getResult() as $post):
                $posti++;
                extract((array) $post);
                $status = (!$perfil_status ? 'style="background: #fffed8"' : '' );
                ?>
                <article<?php if ($posti % 2 == 0) echo ' class="right" '; ?> <?= $status; ?>>
                    <div class="img thumb_small"></div>
                    
                    <h1><a href="painel.php?exe=perfil/update&perfilId=<?= $perfil_id; ?>" title="Ver Post"><?= Check::Words($perfil_title, 5) ?></a></h1>
                    <p class="post_views"><strong>Descrição:</strong> <?= Check::Words($perfil_content, 5) ?></p>
                    <ul class="info post_actions">
                        <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($perfil_date)); ?>Hs</li>
                        <li><a class="act_edit" href="painel.php?exe=perfil/update&perfilId=<?= $perfil_id; ?>" title="Editar">Editar</a></li>

                        <?php if (!$perfil_status): ?>
                            <li><a class="act_ative" href="painel.php?exe=perfil/index&perfil=<?= $perfil_id; ?>&action=active" title="Ativar">Ativar</a></li>
                        <?php else: ?>
                            <li><a class="act_inative" href="painel.php?exe=perfil/index&perfil=<?= $perfil_id; ?>&action=inative" title="Inativar">Inativar</a></li>
                        <?php endif; ?>
                        <li><a class="act_delete" href="painel.php?exe=perfil/index&perfil=<?= $perfil_id; ?>&action=delete" title="Excluir">Deletar</a></li>
                    </ul>
                </article>


                <?php
            endforeach;

            echo "<div class=\"clear\"></div>";

            $Pager->ExePaginator("ws_perfil");
            echo $Pager->getPaginator();
        endif;
        ?>

        <div class="clear"></div>
    </section>
</div> <!-- content home -->