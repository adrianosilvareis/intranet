<?php
if (file_exists(FAST_PATH . "_models/AdminExames.class.php")):
    require_once FAST_PATH . "_models/AdminExames.class.php";
endif;

$AdminExames = new AdminExames();
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Status Chamado</th>
            <th>Descrição</th>
            <th>Método</th>
            <th>Material</th>
            <th>Data Solicitação</th>
            <th>Data Conclusão</th>
            <th>Paciente teste</th>
            <th>Setor Solicitante</th>
            <th>Solicitante</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $FeExames = new FeExames();
        $FeExames->Execute()->findAll();
        foreach ($FeExames->Execute()->getResult() as $exames):
            extract((array) $exames);
            ?>    
            <tr>
                <td><?= (!empty($ex_status) ? "Fechado" : "Aberto"); ?></td>
                <td><?= $ex_descricao; ?></td>
                <td><?= $AdminExames->Metodo($fe_metodo); ?></td>
                <td><?= $fe_material; ?></td>
                <td><?= $ex_data_abertura; ?></td>
                <td><?= $ex_data_fechamento; ?></td>
                <td><?= $ex_paciente_os; ?></td>
                <td><?= $fe_setor_soli; ?></td>
                <td><?= $ws_users_soli; ?></td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>