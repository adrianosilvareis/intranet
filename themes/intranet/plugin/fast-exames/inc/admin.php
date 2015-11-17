<?php
if (file_exists(FAST_PATH . '_models/AdminExames.class.php')):
    include_once FAST_PATH . '_models/AdminExames.class.php';
endif;


$AdminExames = new AdminExames();
$FeExames = new FeExames();
$FeExames->Execute()->findAll();
?>

<div class="panel panel-default">
    
    <div class="well well-sm btn-group">
        <h3 class="">Painel</h3>
        <a href="#" title="Novo" class="btn btn-danger glyphicon glyphicon-plus"></a>
        <a href="#" title="Editar" class="btn btn-danger glyphicon glyphicon-pencil"></a>
        <a href="#" title="Remover" class="btn btn-danger glyphicon glyphicon-trash"></a>
        <a href="#" title="Pagina usuario" class="btn btn-danger glyphicon glyphicon-user"></a>
        <a href="#" title="Confirmação" class="btn btn-danger glyphicon glyphicon-ok"></a>
    </div>
    
    <?php
    if (!$FeExames->Execute()->getResult()):
        WSErro("Nenhum Solicitação foi encontrada no momento!", WS_INFOR);
    else:
        ?>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="text-center">Solicitante</th>
                    <th class="text-center">Aberto em</th>
                    <th class="text-center">Setor</th>
                    <th class="text-center">Exame</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">O.S Paciente Teste</th>
                    <th class="text-center">Assinado por</th>
                    <th class="text-center">Fechado em</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($FeExames->Execute()->getResult() as $exames):
                    extract((array) $exames);
                    ?>
                    <tr>
                        <td><?= $AdminExames->Setor($fe_setor_soli); ?></td>
                        <td><?= date("d/m/Y H:i:s", strtotime($ex_data_abertura)); ?></td>
                        <td><?= $AdminExames->Setor($fe_setor_exec); ?></td>
                        <td><?= $ex_descricao; ?></td>
                        <td><?= ($ex_status ? "concluido" : "em processamento") ?></td>
                        <td><?= $ex_paciente_os; ?></td>
                        <td><?= $AdminExames->Usuario($ws_users); ?></td>
                        <td><?= date("d/m/Y H:i:s", strtotime($ex_data_fechamento)); ?></td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>

    <?php endif; ?>
</div>