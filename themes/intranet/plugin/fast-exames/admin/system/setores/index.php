<?php
if (file_exists(FAST_PATH . "_models/AdminSetor.class.php")):
    require_once FAST_PATH . "_models/AdminSetor.class.php";
endif;

$action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);

if (!empty($action)):
    $AdminSetor = new AdminSetor();

    $toaction = explode("/", $action);

    $setor = $AdminSetor->FindId($toaction[1]);

    if (!empty($setor)):
        switch ($toaction[0]):

            case "active":
                $AdminSetor->ExeStatus($toaction[1], 1);
                WSErro("Setor <b>$setor->set_descricao</b> ativo com sucesso!", WS_ACCEPT);
                break;

            case "inative":
                $AdminSetor->ExeStatus($toaction[1], 0);
                WSErro("Setor <b>$setor->set_descricao</b> desativado com sucesso!", WS_ACCEPT);
                break;

            case "delete":
                if ($AdminSetor->ExeDelete($toaction[1])):
                    WSErro("Setor <b>$setor->set_descricao</b> deletado com sucesso!", WS_ACCEPT);
                else:
                    WSErro("Erro ao deletar", WS_ERROR);
                endif;
                break;

            default :
                WSErro("Opss! opção invalida.", WS_ERROR);
                break;
        endswitch;
    else:
        WSErro("O setor informado não pode ser encontrado!", WS_INFOR);
    endif;
endif;

$getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$Pager = new Pager(FAST_INCLUDE . "admin/&exe=setores/index&page=");
$Pager->ExePager($getPage, 15);


$FeSetor = new FeSetor();
$FeSetor->Execute()->FullRead("SELECT * FROM fe_setor ORDER BY set_status LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);
if (!$FeSetor->Execute()->getResult()):
    $Pager->ReturnPage();
    WSErro("Nenhum setor cadastrado!", WS_INFOR);
else:
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Descrição</th>
                <th>Execução</th>
                <th>Solicitante</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($FeSetor->Execute()->getResult() as $setor):
                extract((array) $setor);
                ?>    
                <tr>
                    <td><?= $set_id; ?></td>
                    <td><?= $set_descricao; ?></td>
                    <td><label>
                            <input class="checkbox disabled" type="checkbox" <?= ($set_execucao ? "checked" : "") ?>>
                        </label></td>
                    <td><label>
                            <input class="checkbox disabled" type="checkbox" <?= ($set_solicita ? "checked" : "") ?>>
                        </label></td>
                    <td>
                        <ul class="post_actions plugin">
                            <li><a class="act_edit" href="<?= FAST_INCLUDE ?>admin/&exe=setores/update&setorId=<?= $set_id; ?>#form" title="Editar">Editar</a></li>
                            <?php if (!$set_status): ?>
                                <li><a class="act_ative" href="<?= FAST_INCLUDE ?>admin/&exe=setores/index&action=active/<?= $set_id; ?>#form" title="Ativar">Ativar</a></li>
                            <?php else: ?>
                                <li><a class="act_inative" href="<?= FAST_INCLUDE ?>admin/&exe=setores/index&action=inative/<?= $set_id; ?>#form" title="Inativar">Inativar</a></li>
                            <?php endif; ?>
                            <li><a class="act_delete" href="<?= FAST_INCLUDE ?>admin/&exe=setores/index&action=delete/<?= $set_id; ?>#form" title="Excluir">Deletar</a></li>
                        </ul>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>
<?php endif; ?>

<div class="row" id="form">
    <?php
    $Pager->ExePaginator("fe_setor");
    echo $Pager->getPaginator();
    ?>
</div>