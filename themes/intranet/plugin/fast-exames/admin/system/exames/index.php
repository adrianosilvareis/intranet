<?php
if (file_exists(FAST_PATH . "_models/AdminExames.class.php")):
    require_once FAST_PATH . "_models/AdminExames.class.php";
endif;

$AdminExames = new AdminExames();

$FeExames = new FeExames();
$FeExames->Execute()->findAll();

if (!$FeExames->Execute()->getResult()):
    WSErro("Nenhum solicitação de alteraçao de exame encontrado!", WS_INFOR);
else:
    ?>
    <table class="table table-striped text-center">
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
                <th>Status Chamado</th>
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
                    <td><?= (!empty($ex_status) ? "Fechado" : "Aberto"); ?></td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>

<?php endif; ?>