<?php
if (file_exists(PLUGIN_PATH . "\contadores-de-impressao\_models\AdminModelo.class.php")):
    include PLUGIN_PATH . "\contadores-de-impressao\_models\AdminModelo.class.php";
endif;

$action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);

if (!empty($action)):
    $AdminModelo = new AdminModelo();

    $toaction = explode("/", $action);

    $modelo = $AdminModelo->FindId($toaction[1]);

    if (!empty($modelo)):
        switch ($toaction[0]):

            case "active":
                $AdminModelo->ExeStatus($toaction[1], 1);
                WSErro("Modelo de impressão <b>$modelo->modelo_descricao</b> ativo com sucesso!", WS_ACCEPT);
                break;

            case "inative":
                $AdminModelo->ExeStatus($toaction[1], 0);
                WSErro("Modelo de impressão <b>$modelo->modelo_descricao</b> desativado com sucesso!", WS_ACCEPT);
                break;

            case "delete":
                if ($AdminModelo->ExeDelete($toaction[1])):
                    WSErro("Modelo de impressão <b>$modelo->modelo_descricao</b> deletado com sucesso!", WS_ACCEPT);
                else:
                    WSErro("Erro ao deletar", WS_ERROR);
                endif;
                break;

            default :
                WSErro("Opss! opção invalida.", WS_ERROR);
                break;
        endswitch;
    else:
        WSErro("O modelo informado não pode ser encontrado!", WS_INFOR);
    endif;
endif;

$getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$Pager = new Pager(IMP_INCLUDE . "admin/&exe=modelo/index&page=");
$Pager->ExePager($getPage, 15);

$Read = new AppPostos();
$Read->Execute()->FullRead("SELECT * FROM app_modelo ORDER BY modelo_status LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);
?>
<article>
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nome</th>
                <th class="text-center">Status</th>
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
                    <td><?= $modelo_descricao; ?></td>
                    <td><?= $modelo_status; ?></td>
                    <td>
                        <ul class="post_actions plugin">
                            <li><a class="act_edit" href="<?= IMP_INCLUDE ?>admin/&exe=modelo/update&modeloId=<?= $modelo_id; ?>" title="Editar">Editar</a></li>
                            <?php if (!$modelo_status): ?>
                                <li><a class="act_ative" href="<?= IMP_INCLUDE ?>admin/&exe=modelo/index&action=active/<?= $modelo_id; ?>" title="Ativar">Ativar</a></li>
                            <?php else: ?>
                                <li><a class="act_inative" href="<?= IMP_INCLUDE ?>admin/&exe=modelo/index&action=inative/<?= $modelo_id; ?>" title="Inativar">Inativar</a></li>
                            <?php endif; ?>
                            <!--<li><a class="act_delete" href="<?= IMP_INCLUDE ?>admin/&exe=modelo/index&action=delete/<?= $modelo_id; ?>" title="Excluir">Deletar</a></li>;-->
                        </ul>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>

    <div class="row">
        <?php
        $Pager->ExePaginator("app_postos");
        echo $Pager->getPaginator();
        ?>
    </div>
</article>
