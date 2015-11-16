<?php
if (file_exists(PLUGIN_PATH . "\contadores-de-impressao\_models\AdminTaxas.class.php")):
    include PLUGIN_PATH . "\contadores-de-impressao\_models\AdminTaxas.class.php";
endif;

$action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);

if (!empty($action)):
    $AdminTaxas = new AdminTaxas();

    $toaction = explode("/", $action);

    $taxa = $AdminTaxas->FindId($toaction[1]);

    if (!empty($taxa)):
        switch ($toaction[0]):

            case "active":
                $AdminTaxas->ExeStatus($toaction[1], 1);
                WSErro("Taxa de impressão <b>$taxa->taxa_descricao</b> ativo com sucesso!", WS_ACCEPT);
                break;

            case "inative":
                $AdminTaxas->ExeStatus($toaction[1], 0);
                WSErro("Taxa de impressão <b>$taxa->taxa_descricao</b> desativado com sucesso!", WS_ACCEPT);
                break;

            case "delete":
                if ($AdminTaxas->ExeDelete($toaction[1])):
                    WSErro("Taxa de impressão <b>$taxa->taxa_descricao</b> deletado com sucesso!", WS_ACCEPT);
                else:
                    WSErro("Erro ao deletar", WS_ERROR);
                endif;
                break;

            default :
                WSErro("Opss! opção invalida.", WS_ERROR);
                break;
        endswitch;
    else:
        WSErro("A taxa informada não pode ser encontrado!", WS_INFOR);
    endif;
endif;

$getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$Pager = new Pager(IMP_INCLUDE . "admin/&exe=taxas/index&page=");
$Pager->ExePager($getPage, 15);

$Read = new AppPostos();
$Read->Execute()->FullRead("SELECT * FROM app_taxa_impress ORDER BY taxa_status LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);
?>
<article>
    <?php
    if (!$Read->Execute()->getResult()):
        $Pager->ReturnPage();
        WSErro("Desculpa, ainda não temos taxa cadastrados", WS_INFOR);
    else:
        ?>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center">Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($Read->Execute()->getResult() as $mod):
                    extract((array) $mod);
                    ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $taxa_descricao; ?></td>
                        <td><?= $taxa_valor; ?></td>
                        <td><?= $taxa_status; ?></td>
                        <td>
                            <ul class="post_actions plugin">
                                <li><a class="act_edit" href="<?= IMP_INCLUDE ?>admin/&exe=taxas/update&taxaId=<?= $taxa_id; ?>" title="Editar">Editar</a></li>
                                <?php if (!$taxa_status): ?>
                                    <li><a class="act_ative" href="<?= IMP_INCLUDE ?>admin/&exe=taxas/index&action=active/<?= $taxa_id; ?>" title="Ativar">Ativar</a></li>
                                <?php else: ?>
                                    <li><a class="act_inative" href="<?= IMP_INCLUDE ?>admin/&exe=taxas/index&action=inative/<?= $taxa_id; ?>" title="Inativar">Inativar</a></li>
                                <?php endif; ?>
                            <!--<li><a class="act_delete" href="<?= IMP_INCLUDE ?>admin/&exe=modelo/index&action=delete/<?= $taxa_id; ?>" title="Excluir">Deletar</a></li>;-->
                            </ul>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>

    <?php endif; ?>

    <div class="row">
        <?php
        $Pager->ExePaginator("app_taxa_impress");
        echo $Pager->getPaginator();
        ?>
    </div>
</article>
