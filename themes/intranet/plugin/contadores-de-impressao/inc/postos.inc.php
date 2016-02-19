<?php
if (file_exists(PLUGIN_PATH . "\contadores-de-impressao\_models\AdminPostos.class.php")):
    include PLUGIN_PATH . "\contadores-de-impressao\_models\AdminPostos.class.php";
endif;

$AdPostos = new AdminPostos();
$AdPostos->Lista();
/**
 * Formulario de atualização
 */
$posto = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($posto)):
    if (in_array('', $posto)):
        WSErro("Opss! Preencha todos os campos!", WS_INFOR);
    else:
        unset($posto['sendPosto']);
        $AdPostos->ExeUpdate($posto);
    endif;
endif;

/**
 * Tratamento de erro
 */
if (!empty($Link->getLocal()[2]) && Check::UserLogin(2)):

    switch ($Link->getLocal()[2]):
        case "ok":
            WSErro("Registro já concluido", WS_ACCEPT);
            break;

        case "erro":
            WSErro("Oppss! Este posto não existe ou não tem impressoras vinculadas.", WS_ERROR);
            break;

        case "update":
            if (!$posto):
                $posto = (array) $AdPostos->getPostoId($Link->getLocal()[3]);
            endif;
            ?>
            <form name="update" method="POST" class="form-inline form-group">
                <input type="hidden" name="postos_id" value="<?= $posto['postos_id']; ?>" />
                <input type="text" name="postos_nome" value="<?= $posto['postos_nome']; ?>" class="form-control"/>
                <input type="text" name="postos_numero" value="<?= $posto['postos_numero']; ?>" class="form-control" />
                <input type="submit" name="sendPosto" value="Atualizar" class="btn btn-primary"/>
            </form>
            <?php
            break;

        case "inative":
            if (!empty($Link->getLocal()[3])):
                ($AdPostos->ExeStatus($Link->getLocal()[3], 0) ? WSErro("Posto <b>{$AdPostos->getPostoId($Link->getLocal()[3])->postos_nome}</b> inativado com sucesso!", WS_ACCEPT) : WSErro("Oppss! Erro ao inativar o posto <b>{$AdPostos->getPostoId($Link->getLocal()[3])->postos_nome}</b>.", WS_ERROR));
                $AdPostos->ListAdmin();
            else:
                WSErro("Oppss! Opção inválida.", WS_ALERT);
            endif;
            break;

        case "active":
            if (!empty($Link->getLocal()[3])):
                ($AdPostos->ExeStatus($Link->getLocal()[3], 1) ? WSErro("Posto <b>{$AdPostos->getPostoId($Link->getLocal()[3])->postos_nome}</b> ativado com sucesso!", WS_ACCEPT) : WSErro("Oppss! Erro ao ativar o posto <b>{$AdPostos->getPostoId($Link->getLocal()[3])->postos_nome}</b>.", WS_ERROR));
                $AdPostos->ListAdmin();
            else:
                WSErro("Oppss! Opção inválida.", WS_ALERT);
            endif;
            break;

        case "delete":
            WSErro("Esta opção não deve ser usada, desative o posto.", WS_ERROR);
            break;

        default:
            WSErro("Oppss! Opção inválida.", WS_ALERT);
            break;
    endswitch;

elseif (!empty($Link->getLocal()[2])):
    switch ($Link->getLocal()[2]) :

        case "ok":
            WSErro("Registro já concluido", WS_ACCEPT);
            break;

        case "erro":
            WSErro("Oppss! Este posto não existe ou não tem impressoras vinculadas.", WS_ERROR);
            break;

        default:
            WSErro("Oppss! Opção inválida.", WS_ALERT);
            break;

    endswitch;
endif;

if (Check::UserLogin(2)):
    echo "<a title=\"Gerenciamento\" href=\"" . IMP_INCLUDE . "admin\" class=\"btn btn-danger glyphicon glyphicon-cog\" style=\"float: right; margin: 25px;\"></a>";
endif;
?>

<div class="panel">
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>Unidades</th>
                <?php if (Check::UserLogin(2)): ?>
                    <th>Todos as impressoras</th>
                    <th>Ações</th>
                <?php else: ?>
                    <th>Pendente</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>

            <?php
            if (Check::UserLogin(2)):
                $AdPostos->ListAdmin();
                foreach ($AdPostos->getResult() as $imp):
                    extract((array) $imp);
                    ?>
                    <tr class="text-center">
                        <td <?php
                        if (!$cont): echo "class='danger'";
                        endif;
                        ?>>
                            <a href="<?= IMP_INCLUDE . $postos_id; ?>"><?= $postos_nome; ?></a>
                        </td>
                        <td <?php
                        if (!$cont): echo "class='danger'";
                        endif;
                        ?>>
                                <?= $cont; ?>
                        </td>
                        <td <?php
                        if (!$cont): echo "class='danger'";
                        endif;
                        ?>>
                            <ul class="post_actions plugin">
                                <li><a class="act_edit" href="<?= IMP_INCLUDE ?>update/<?= $postos_id; ?>" title="Editar">Editar</a></li>
                                <?php if (!$postos_ativo): ?>
                                    <li><a class="act_ative" href="<?= IMP_INCLUDE ?>active/<?= $postos_id; ?>" title="Ativar">Ativar</a></li>
                                <?php else: ?>
                                    <li><a class="act_inative" href="<?= IMP_INCLUDE ?>inative/<?= $postos_id; ?>" title="Inativar">Inativar</a></li>
                                <?php endif; ?>
                                <li><a class="act_delete" href="<?= IMP_INCLUDE ?>delete/<?= $postos_id; ?>" title="Excluir">Deletar</a></li>
                            </ul>
                        </td>
                    </tr>
                    <?php
                endforeach;
            else:
                if (!$AdPostos->getRestantes()):
                    WSErro("Não existem postos a ser exibido!", WS_INFOR);
                else:
                    foreach ($AdPostos->getRestantes() as $imp):
                        extract((array) $imp);
                        ?>
                        <tr class="text-center">
                            <td>
                                <a href="<?= IMP_INCLUDE . $postos_id; ?>"><?= $postos_nome; ?></a>
                            </td>
                            <td>
                                <?= $cont; ?>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                endif;
            endif;
            ?>

        </tbody>
    </table>
</div>