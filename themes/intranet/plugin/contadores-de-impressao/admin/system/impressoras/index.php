<?php
if (file_exists(PLUGIN_PATH . "\contadores-de-impressao\_models\AdminImpressoras.class.php")):
    include PLUGIN_PATH . "\contadores-de-impressao\_models\AdminImpressoras.class.php";
endif;

$action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);
$AdminImpressoras = new AdminImpressoras();

if (!empty($action)):

    $toaction = explode("/", $action);

    $impressora = $AdminImpressoras->FindId($toaction[1]);

    if (!empty($impressora)):
        switch ($toaction[0]):

            case "active":
                $AdminImpressoras->ExeStatus($toaction[1], 1);
                WSErro("Impressora <b>$impressora->impressora_serial</b> ativo com sucesso!", WS_ACCEPT);
                break;

            case "inative":
                $AdminImpressoras->ExeStatus($toaction[1], 0);
                WSErro("Impressora <b>$impressora->impressora_serial</b> desativado com sucesso!", WS_ACCEPT);
                break;

            case "delete":
                if ($AdminImpressoras->ExeDelete($toaction[1])):
                    WSErro("Impressora <b>$impressora->impressora_serial</b> deletado com sucesso!", WS_ACCEPT);
                else:
                    WSErro("Erro ao deletar", WS_ERROR);
                endif;
                break;

            default :
                WSErro("Opss! opção invalida.", WS_ERROR);
                break;
        endswitch;
    else:
        WSErro("A impressora informada não pode ser encontrado!", WS_INFOR);
    endif;
endif;

$getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$Pager = new Pager(IMP_INCLUDE . "admin/&exe=impressoras/index&page=");
$Pager->ExePager($getPage, 15);

$search = filter_input(INPUT_POST, "search", FILTER_DEFAULT);
$where = (!empty($search) ? "WHERE impressora_serial like \"%$search%\" " : "");

$Read = new ImpImpressora();
if (!empty($search)):
    $Read->Execute()->FullRead("SELECT * FROM imp_impressora WHERE impressora_serial like '%$search%'");
else:
    $Read->Execute()->FullRead("SELECT * FROM imp_impressora ORDER BY impressora_status LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);
endif;
?>
<article>

    <form name="search" method="post" class="form-inline">
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Entre com serial" name="search" value="<?= $search; ?>">
                <span class="input-group-btn">
                    <input class="btn btn-success" type="submit" value="Go">
                </span>
            </div>
        </div>
    </form>

    <?php
    if (!$Read->Execute()->getResult()):
        $Pager->ReturnPage();
        WSErro("Desculpa, não encontramos nenhuma impressora!", WS_INFOR);
    else:
        ?>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Serial</th>
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Posto</th>
                    <th class="text-center">Modelo</th>
                    <th class="text-center">Taxa</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($Read->Execute()->getResult() as $imp):
                    extract((array) $imp);
                    ?>
                    <tr>
                        <td><?= $impressora_id; ?></td>
                        <td><?= $impressora_serial; ?></td>
                        <td><?= $impressora_descricao; ?></td>
                        <td><?= $AdminImpressoras->Posto($fk_postos); ?></td>
                        <td><?= $AdminImpressoras->Modelo($fk_modelo); ?></td>
                        <td><?= $AdminImpressoras->Taxa($fk_taxa); ?></td>
                        <td>
                            <ul class="post_actions plugin">
                                <li><a class="act_edit" href="<?= IMP_INCLUDE ?>admin/&exe=impressoras/update&impressoraId=<?= $impressora_id; ?>" title="Editar">Editar</a></li>
                                <?php if (!$impressora_status): ?>
                                    <li><a class="act_ative" href="<?= IMP_INCLUDE ?>admin/&exe=impressoras/index&action=active/<?= $impressora_id; ?>" title="Ativar">Ativar</a></li>
                                <?php else: ?>
                                    <li><a class="act_inative" href="<?= IMP_INCLUDE ?>admin/&exe=impressoras/index&action=inative/<?= $impressora_id; ?>" title="Inativar">Inativar</a></li>
                                <?php endif; ?>
                                <li><a class="act_delete" href="<?= IMP_INCLUDE ?>admin/&exe=impressoras/index&action=delete/<?= $impressora_id; ?>" title="Excluir">Deletar</a></li>
                            </ul>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
    <?php
    endif;
    ?>
    <div class="row">
        <?php
        $Pager->ExePaginator("imp_impressora");
        echo (!empty($search) ? "" : $Pager->getPaginator());
        ?>
    </div>
</article>
