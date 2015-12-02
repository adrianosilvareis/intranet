<?php
if (file_exists(FAST_PATH . "_models/AdminExames.class.php")):
    require_once FAST_PATH . "_models/AdminExames.class.php";
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
                WSErro("Exame <b>$exame->ex_descricao</b> ativo com sucesso!", WS_ACCEPT);
                break;

            case "inative":
                $AdminExames->ExeStatus($toaction[1], 0);
                WSErro("Exame <b>$exame->ex_descricao</b> desativado com sucesso!", WS_ACCEPT);
                break;

            case "delete":
                if ($AdminExames->ExeDelete($toaction[1])):
                    WSErro("Exame <b>$exame->ex_descricao</b> deletado com sucesso!", WS_ACCEPT);
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


$FeMaterial = new FeMaterial();
$FeMaterial->Execute()->FullRead("SELECT * FROM fe_exames ORDER BY ex_status LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);

$FeExames = new FeExames();
$FeExames->Execute()->findAll();

if (!$FeExames->Execute()->getResult()):
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
                    <td><?= $ex_descricao; ?></td>
                    <td><?= $ex_minemonico; ?></td>
                    <td><?= $AdminExames->Setor($fe_setor_exec); ?></td>
                    <td><?= $AdminExames->Acao($fe_acoes); ?></td>
                    <td><?= date('d/m/y | H:i', strtotime($ex_data_abertura)) . "H"; ?></td>
                    <td><?= date('d/m/y | H:i', strtotime($ex_data_fechamento)) . "H"; ?></td>
                    <td><?= $AdminExames->Setor($fe_setor_soli); ?></td>
                    <td><?= $AdminExames->Usuario($ws_users_soli); ?></td>
                    <td>
                        <ul class="post_actions plugin">
                            <li><a class="act_edit" href="<?= FAST_INCLUDE ?>admin/&exe=exames/update&examesId=<?= $ex_id; ?>#form" title="Editar">Editar</a></li>
                            <?php if (!$ex_status): ?>
                                <li><a class="act_ative" href="<?= FAST_INCLUDE ?>admin/&exe=exames/index&action=active/<?= $ex_id; ?>#form" title="Ativar">Ativar</a></li>
                            <?php else: ?>
                                <li><a class="act_inative" href="<?= FAST_INCLUDE ?>admin/&exe=exames/index&action=inative/<?= $ex_id; ?>#form" title="Inativar">Inativar</a></li>
                            <?php endif; ?>
                            <li><a class="act_delete" href="<?= FAST_INCLUDE ?>admin/&exe=exames/index&action=delete/<?= $ex_id; ?>#form" title="Excluir">Deletar</a></li>
                        </ul>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>

<?php endif; ?>