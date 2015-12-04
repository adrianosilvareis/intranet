<?php
if (file_exists(FAST_PATH . "_models/AdminMetodo.class.php")):
    require_once FAST_PATH . "_models/AdminMetodo.class.php";
endif;

$action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);

if (!empty($action)):
    $AdminMetodo = new AdminMetodo();

    $toaction = explode("/", $action);

    $metodo = $AdminMetodo->FindId($toaction[1]);

    if (!empty($metodo)):
        switch ($toaction[0]):

            case "active":
                $AdminMetodo->ExeStatus($toaction[1], 1);
                WSErro("Metodo <b>$metodo->met_descricao</b> ativo com sucesso!", WS_ACCEPT);
                break;

            case "inative":
                $AdminMetodo->ExeStatus($toaction[1], 0);
                WSErro("Metodo <b>$metodo->met_descricao</b> desativado com sucesso!", WS_ACCEPT);
                break;

            case "delete":
                if ($AdminMetodo->ExeDelete($toaction[1])):
                    WSErro("Metodo <b>$metodo->met_descricao</b> deletado com sucesso!", WS_ACCEPT);
                else:
                    WSErro("Erro ao deletar", WS_ERROR);
                endif;
                break;

            default :
                WSErro("Opss! opção invalida.", WS_ERROR);
                break;
        endswitch;
    else:
        WSErro("O metodo informada não pode ser encontrado!", WS_INFOR);
    endif;
endif;

$getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$Pager = new Pager(FAST_INCLUDE . "admin/&exe=metodos/index&page=");
$Pager->ExePager($getPage, 15);

$FeMetodo = new FeMetodo();
$FeMetodo->Execute()->FullRead("SELECT * FROM fe_metodo ORDER BY met_status LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);

if (!$FeMetodo->Execute()->getResult()):
    $Pager->ReturnPage();
    WSErro("Nenhum metodo cadastrado!", WS_INFOR);
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
            foreach ($FeMetodo->Execute()->getResult() as $metodo):
                extract((array) $metodo);
                ?>    
                <tr>
                    <td><?= $met_id; ?></td>
                    <td><?= $met_descricao; ?></td>
                    <td>
                        <ul class="post_actions plugin">
                            <li><a class="act_edit" href="<?= FAST_INCLUDE ?>admin/&exe=metodos/update&metodoId=<?= $met_id; ?>#form" title="Editar">Editar</a></li>
                            <?php if (!$met_status): ?>
                                <li><a class="act_ative" href="<?= FAST_INCLUDE ?>admin/&exe=metodos/index&action=active/<?= $met_id; ?>#form" title="Ativar">Ativar</a></li>
                            <?php else: ?>
                                <li><a class="act_inative" href="<?= FAST_INCLUDE ?>admin/&exe=metodos/index&action=inative/<?= $met_id; ?>#form" title="Inativar">Inativar</a></li>
                            <?php endif; ?>
                            <li><a class="act_delete" href="<?= FAST_INCLUDE ?>admin/&exe=metodos/index&action=delete/<?= $met_id; ?>#form" title="Excluir">Deletar</a></li>
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
    $Pager->ExePaginator("fe_metodo");
    echo $Pager->getPaginator();
    ?>
</div>