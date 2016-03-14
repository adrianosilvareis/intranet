<?php
if (file_exists('include/fast-exames/_models/AdminMaterial.class.php')):
    include_once 'include/fast-exames/_models/AdminMaterial.class.php';
endif;

$action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);

if (!empty($action)):
    $AdminMaterial = new AdminMaterial();

    $toaction = explode("/", $action);

    $material = $AdminMaterial->FindId($toaction[1]);

    if (!empty($material)):
        switch ($toaction[0]):

            case "active":
                $AdminMaterial->ExeStatus($toaction[1], 1);
                WSErro("Material <b>$material->mat_descricao</b> ativo com sucesso!", WS_ACCEPT);
                break;

            case "inative":
                $AdminMaterial->ExeStatus($toaction[1], 0);
                WSErro("Material <b>$material->mat_descricao</b> desativado com sucesso!", WS_ACCEPT);
                break;

            case "delete":
                if ($AdminMaterial->ExeDelete($toaction[1])):
                    WSErro("Material <b>$material->mat_descricao</b> deletado com sucesso!", WS_ACCEPT);
                else:
                    WSErro("Erro ao deletar", WS_ERROR);
                endif;
                break;

            default :
                WSErro("Opss! opção invalida.", WS_ERROR);
                break;
        endswitch;
    else:
        WSErro("O material informada não pode ser encontrado!", WS_INFOR);
    endif;
endif;

$getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$Pager = new Pager(FAST_INCLUDE . "admin/&exe=materiais/index&page=");
$Pager->ExePager($getPage, 15);


$FeMaterial = new FeMaterial();
$FeMaterial->Execute()->FullRead("SELECT * FROM fe_material ORDER BY mat_status LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);

if (!$FeMaterial->Execute()->getResult()):
    $Pager->ReturnPage();
    WSErro("Nenhum material cadastrado!", WS_INFOR);
else:
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Descrição</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($FeMaterial->Execute()->getResult() as $material):
                extract((array) $material);
                ?>    
                <tr>
                    <td><?= $mat_id; ?></td>
                    <td><?= $mat_descricao; ?></td>
                    <td>
                        <ul class="post_actions plugin">
                            <li><a class="act_edit" href="<?= FAST_INCLUDE ?>admin/&exe=materiais/update&materialId=<?= $mat_id; ?>#form" title="Editar">Editar</a></li>
                            <?php if (!$mat_status): ?>
                                <li><a class="act_ative" href="<?= FAST_INCLUDE ?>admin/&exe=materiais/index&action=active/<?= $mat_id; ?>#form" title="Ativar">Ativar</a></li>
                            <?php else: ?>
                                <li><a class="act_inative" href="<?= FAST_INCLUDE ?>admin/&exe=materiais/index&action=inative/<?= $mat_id; ?>#form" title="Inativar">Inativar</a></li>
                            <?php endif; ?>
                            <li><a class="act_delete" href="<?= FAST_INCLUDE ?>admin/&exe=materiais/index&action=delete/<?= $mat_id; ?>#form" title="Excluir">Deletar</a></li>
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
    $Pager->ExePaginator("fe_material");
    echo $Pager->getPaginator();
    ?>
</div>