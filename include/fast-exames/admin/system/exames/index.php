<?php
if (file_exists('include/fast-exames/_models/AdminExames.class.php')):
    include_once 'include/fast-exames/_models/AdminExames.class.php';
endif;

$action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);
$AdminExames = new AdminExames();

if (!empty($action)):

    $toaction = explode("/", $action);

    $exame = $AdminExames->FindId($toaction[1]);

    if (!empty($exame)):
        switch ($toaction[0]):

            case "active":
                $AdminExames->ExeStatus($toaction[1], 1);
                WSErro("Exame <b>$exame->ex_descricao</b> concluido com sucesso!", WS_ACCEPT);
                break;

            case "inative":
                $AdminExames->ExeStatus($toaction[1], 0);
                WSErro("Exame <b>$exame->ex_descricao</b> aberto com sucesso!", WS_ACCEPT);
                break;

            case "delete":
                if ($AdminExames->ExeCancelar($toaction[1], 1)):
                    WSErro("Exame <b>$exame->ex_descricao</b> deletado com sucesso!", WS_ACCEPT);
                else:
                    WSErro("Erro ao deletar", WS_ERROR);
                endif;
                break;
            case "undelete":
                if ($AdminExames->ExeCancelar($toaction[1], 0)):
                    WSErro("Exame <b>$exame->ex_descricao</b> ativo com sucesso!", WS_ACCEPT);
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
$Pager = new Pager(FAST_INCLUDE . "admin/&exe=exames/index&page=");
$Pager->ExePager($getPage, 15);


$FeExames = new FeExames();
$FeExames->Execute()->FullRead("SELECT * FROM fe_exames WHERE ex_cancelado = 0 ORDER BY ex_status, ex_data_fechamento DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);

if (!$FeExames->Execute()->getResult()):
    $Pager->ReturnPage();
    WSErro("Nenhum solicitação de alteraçao de exame encontrado!", WS_INFOR);
else:
    ?>
    <table class="table table-striped text-center" id="form">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Minemônico</th>
                <th>Setor</th>
                <th>Ações</th>
                <th>Data Solicitação</th>
                <th>Data Conclusão</th>
                <th>Solicitante(Setor)</th>
                <th>Solicitante</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($FeExames->Execute()->getResult() as $exames):
                extract((array) $exames);
                ?>    
                <tr>
                    <td><?= Check::Words($ex_descricao, 4); ?></td>
                    <td><?= $ex_minemonico; ?></td>
                    <td><?= $AdminExames->Setor($ws_setor_exec); ?></td>
                    <td><?= $AdminExames->Acao($fe_acoes); ?></td>
                    <td><?= date('d/m/y | H:i', strtotime($ex_data_abertura)) . "H"; ?></td>
                    <td><?= (($ex_data_fechamento != "0000-00-00 00:00:00") ? date('d/m/y | H:i', strtotime($ex_data_fechamento)) . "H" : ""); ?></td>
                    <td><?= $AdminExames->Setor($ws_setor_soli); ?></td>
                    <td><?= $AdminExames->Usuario($ws_users_soli); ?></td>
                    <td>
                        <ul class="post_actions plugin">
                            <li><a class="act_edit" href="<?= FAST_INCLUDE ?>admin/&exe=exames/update&examesId=<?= $ex_id; ?>#form" title="Editar">Editar</a></li>
                            <?php if (!$ex_status): ?>
                                <li><a class="act_ative" href="<?= FAST_INCLUDE ?>admin/&exe=exames/index&action=active/<?= $ex_id; ?>#form" title="Concluir">Ativar</a></li>
                            <?php else: ?>
                                <li><a class="act_inative" href="<?= FAST_INCLUDE ?>admin/&exe=exames/index&action=inative/<?= $ex_id; ?>#form" title="Abrir">Inativar</a></li>
                            <?php endif; ?>
                            <?php if (!$ex_cancelado): ?>
                                <li><a class="act_delete" href="<?= FAST_INCLUDE ?>admin/&exe=exames/index&action=delete/<?= $ex_id; ?>#form" title="Inativar">Deletar</a></li>
                            <?php else: ?>
                                <li><a class="act_accept" href="<?= FAST_INCLUDE ?>admin/&exe=exames/index&action=undelete/<?= $ex_id; ?>#form" title="Ativar">Deletar</a></li>
                            <?php endif; ?>
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
    $Pager->ExePaginator("fe_exames");
    echo $Pager->getPaginator();
    ?>
</div>