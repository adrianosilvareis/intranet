<?php
$FeSetor = new FeSetor();
$FeSetor->Execute()->findAll();
if (!$FeSetor->Execute()->getResult()):
    WSErro("Nenhum setor cadastrado!", WS_INFOR);
else:
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Execução</th>
                <th>Solicitante</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($FeSetor->Execute()->getResult() as $setor):
                extract((array) $setor);
                ?>    
                <tr>
                    <td><?= $met_descricao; ?></td>
                    <td><?= $set_execucao; ?></td>
                    <td><?= $set_solicita; ?></td>
                    <td><?= ($met_status ? "Ativo" : "Desativado"); ?></td>
                    <td><?= 'editar/desativar' ?></td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>
<?php endif; ?>