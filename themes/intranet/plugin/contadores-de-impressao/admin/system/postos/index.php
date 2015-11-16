<?php
if (file_exists(PLUGIN_PATH . "\contadores-de-impressao\_models\AdminPostos.class.php")):
    include PLUGIN_PATH . "\contadores-de-impressao\_models\AdminPostos.class.php";
endif;

$action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);

if (!empty($action)):
    $AdminPostos = new AdminPostos();

    $toaction = explode("/", $action);

    $posto = $AdminPostos->getPostoId($toaction[1]);

    if (!empty($posto)):
        switch ($toaction[0]):

            case "active":
                $AdminPostos->ExeStatus($toaction[1], 1);
                WSErro("Posto <b>$posto->postos_nome</b> ativo com sucesso!", WS_ACCEPT);
                break;

            case "inative":
                $AdminPostos->ExeStatus($toaction[1], 0);
                WSErro("Posto <b>$posto->postos_nome</b> desativado com sucesso!", WS_ACCEPT);
                break;

            case "delete":
                if ($AdminPostos->ExeDelete($toaction[1])):
                    WSErro("Posto <b>$posto->postos_nome</b> deletado com sucesso!", WS_ACCEPT);
                else:
                    WSErro("Erro ao deletar", WS_ERROR);
                endif;
                break;

            default :
                WSErro("Opss! opção invalida.", WS_ERROR);
                break;
        endswitch;
    else:
        WSErro("O posto informado não pode ser encontrado!", WS_INFOR);
    endif;
endif;

$getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$Pager = new Pager(IMP_INCLUDE . "admin/&exe=postos/index&page=");
$Pager->ExePager($getPage, 15);

$Read = new AppPostos();
$Read->Execute()->FullRead("SELECT * FROM app_postos ORDER BY postos_ativo LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);
?>
<article>
    <?php
    if (!$Read->Execute()->getResult()):
        $Pager->ReturnPage();
        WSErro("Desculpa, ainda não temos postos cadastrados", WS_INFOR);
    else:
        ?>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Numero</th>
                    <th class="text-center">Impressoras</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($Read->Execute()->getResult() as $posto):
                    extract((array) $posto);

                    $postos_cont = $Read->Execute()->FullRead("SELECT count(impressora_id) as 'postos_cont' FROM app_impressora WHERE fk_postos = $postos_id")[0]->postos_cont;
                    ?>
                    <tr class="<?php
                    if (!$postos_cont): echo "danger text-danger";
                    endif;
                    ?>">
                        <td><?= $i++; ?></td>
                        <td><?= $postos_nome; ?></td>
                        <td><?= $postos_numero; ?></td>
                        <td><?= $postos_cont; ?></td>
                        <td>
                            <ul class="post_actions plugin">
                                <li><a class="act_edit" href="<?= IMP_INCLUDE ?>admin/&exe=postos/update&postoId=<?= $postos_id; ?>" title="Editar">Editar</a></li>
                                <?php if (!$postos_ativo): ?>
                                    <li><a class="act_ative" href="<?= IMP_INCLUDE ?>admin/&exe=postos/index&action=active/<?= $postos_id; ?>" title="Ativar">Ativar</a></li>
                                <?php else: ?>
                                    <li><a class="act_inative" href="<?= IMP_INCLUDE ?>admin/&exe=postos/index&action=inative/<?= $postos_id; ?>" title="Inativar">Inativar</a></li>
                                <?php endif; ?>
                                <li><a class="act_delete" href="<?= IMP_INCLUDE ?>admin/&exe=postos/index&action=delete/<?= $postos_id; ?>" title="Excluir">Deletar</a></li>
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
        $Pager->ExePaginator("app_postos");
        echo $Pager->getPaginator();
        ?>
    </div>
</article>
