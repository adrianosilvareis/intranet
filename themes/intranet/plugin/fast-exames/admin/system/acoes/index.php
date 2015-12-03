<?php
if (file_exists(FAST_PATH . "_models/AdminAcoes.class.php")):
    require_once FAST_PATH . "_models/AdminAcoes.class.php";
endif;

$action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);

if (!empty($action)):
    $AdminAcoes = new AdminAcoes();

    $toaction = explode("/", $action);

    $acao = $AdminAcoes->FindId($toaction[1]);

    if (!empty($acao)):
        switch ($toaction[0]):

            case "active":
                $AdminAcoes->ExeStatus($toaction[1], 1);
                WSErro("Ação <b>$acao->acao_descricao</b> ativo com sucesso!", WS_ACCEPT);
                break;

            case "inative":
                $AdminAcoes->ExeStatus($toaction[1], 0);
                WSErro("Ação <b>$acao->acao_descricao</b> desativado com sucesso!", WS_ACCEPT);
                break;

            case "delete":
                if ($AdminAcoes->ExeDelete($toaction[1])):
                    WSErro("Ação <b>$acao->acao_descricao</b> deletado com sucesso!", WS_ACCEPT);
                else:
                    WSErro("Erro ao deletar", WS_ERROR);
                endif;
                break;

            default :
                WSErro("Opss! opção invalida.", WS_ERROR);
                break;
        endswitch;
    else:
        WSErro("A ação informada não pode ser encontrado!", WS_INFOR);
    endif;
endif;

$getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$Pager = new Pager(FAST_INCLUDE . "admin/&exe=acoes/index&page=");
$Pager->ExePager($getPage, 15);


$FeAcoes = new FeAcoes();
$FeAcoes->Execute()->FullRead("SELECT * FROM fe_acoes ORDER BY acao_status LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}", true);

if (!$FeAcoes->Execute()->getResult()):
    $Pager->ReturnPage();
    WSErro("Nenhum ação cadastrado!", WS_INFOR);
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
            foreach ($FeAcoes->Execute()->getResult() as $acoes):
                extract((array) $acoes);
                ?>    
                <tr>
                    <td><?= $acao_id; ?></td>
                    <td><?= $acao_descricao; ?></td>
                    <td>
                        <ul class="post_actions plugin">
                            <li><a class="act_edit" href="<?= FAST_INCLUDE ?>admin/&exe=acoes/update&acaoId=<?= $acao_id; ?>#form" title="Editar">Editar</a></li>
                            <?php if (!$acao_status): ?>
                                <li><a class="act_ative" href="<?= FAST_INCLUDE ?>admin/&exe=acoes/index&action=active/<?= $acao_id; ?>#form" title="Ativar">Ativar</a></li>
                            <?php else: ?>
                                <li><a class="act_inative" href="<?= FAST_INCLUDE ?>admin/&exe=acoes/index&action=inative/<?= $acao_id; ?>#form" title="Inativar">Inativar</a></li>
                            <?php endif; ?>
                            <li><a class="act_delete" href="<?= FAST_INCLUDE ?>admin/&exe=acoes/index&action=delete/<?= $acao_id; ?>#form" title="Excluir">Deletar</a></li>
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
    $Pager->ExePaginator("fe_acoes");
    echo $Pager->getPaginator();
    ?>
</div>