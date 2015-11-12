<?php
if (file_exists(PLUGIN_PATH . "\contadores-de-impressao\_models\AdminPostos.class.php")):
    include PLUGIN_PATH . "\contadores-de-impressao\_models\AdminPostos.class.php";
endif;

$action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);

if (!empty($action)):
    $AdminPostos = new AdminPostos();

    $toaction = explode("/", $action);

    $posto = $AdminPostos->getPostoId($toaction[1]);

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
            $AdminPostos->ExeDelete($toaction[1]);
            WSErro("Posto <b>$posto->postos_nome</b> deletado com sucesso!", WS_ACCEPT);
            break;

        default :
            WSErro("Opss! opção invalida.", WS_ERROR);
            break;
    endswitch;
endif;

$Read = new AppPostos();
$Read->Execute()->FullRead("SELECT * FROM app_postos ORDER BY postos_ativo");
?>
<article>
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th class="text-center">Nome</th>
                <th class="text-center">Numero</th>
                <th class="text-center">Status</th>
                <th class="text-center">Impressoras</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($Read->Execute()->getResult() as $posto):
                extract((array) $posto);
                $postos_cont = 10;
                ?>
                <tr>
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
</article>
