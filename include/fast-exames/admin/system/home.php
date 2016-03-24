<?php
if (file_exists('include/fast-exames/_models/AdminExames.class.php')):
    include_once 'include/fast-exames/_models/AdminExames.class.php';
endif;

Register::addRegister("<script src='" . HOME . "/js/google-charts/columns.charts.js'></script>");

$FeExames = new FeExames();
$AdminExames = new AdminExames();
//Total por usuarios
$FeExames->Execute()->FullRead("SELECT count(e.ws_users) as 'cont' , u.* FROM fe_exames e "
        . "JOIN ws_users u ON(u.user_id = e.ws_users) "
        . "GROUP BY e.ws_users;");
$usuarios = $FeExames->Execute()->getResult();

//Tempo Medio dias corrisdos
$ListaTempoMedio = $FeExames->Execute()->FullRead("SELECT e.ex_data_abertura as 'data_inicio' , e.ex_data_fechamento  as 'data_fim' "
        . "FROM fe_exames e where e.ex_status=1");

$TempoMedio = $AdminExames->TempoMedio($ListaTempoMedio);

//Tempo medio de resolução por periodo
//LastMonth
$lastMonth = date('Y-m-d H:i:s', strtotime('-1 month'));
$mes = $FeExames->Execute()->FullRead("SELECT e.ex_data_abertura as 'data_inicio' , e.ex_data_fechamento  as 'data_fim' "
        . "FROM fe_exames e where e.ex_status=1 AND e.ex_data_abertura >= '$lastMonth'");

$month = $AdminExames->TempoMedio($mes);

//LastWeek
$lastWeek = date('Y-m-d H:i:s', strtotime('-1 week'));
$semana = $FeExames->Execute()->FullRead("SELECT e.ex_data_abertura as 'data_inicio' , e.ex_data_fechamento  as 'data_fim' "
        . "FROM fe_exames e where e.ex_status=1 AND e.ex_data_abertura >= '$lastWeek'");

$week = $AdminExames->TempoMedio($semana);

//LastDay
$lastDay = date('Y-m-d H:i:s', strtotime('-1 day'));
$dia = $FeExames->Execute()->FullRead("SELECT e.ex_data_abertura as 'data_inicio' , e.ex_data_fechamento  as 'data_fim' "
        . "FROM fe_exames e where e.ex_status=1 AND e.ex_data_abertura >= '$lastDay'");

$day = $AdminExames->TempoMedio($dia);
?>

<script>
    var titlecolumn = "Exames por usuario";
    var datacolumn = <?php require HOME . "/api/fast-exames/column_chart.api.php"; ?>;
</script>

<div class="row">
    <div class="col-md-4">

        <article class="list-group">
            <h3 class="list-group-item list-group-item-success">Total por usuario</h3>
            <?php
            $total = 0;
            foreach ($usuarios as $exames):
                extract((array) $exames);
                $total += $cont;
                ?>
                <a class="list-group-item"><?= $user_name . " " . $user_lastname; ?><span class="badge"><?= $cont; ?></span></a>
            <?php endforeach; ?>
            <a class="list-group-item active bodered">Total<span class="badge"><?= $total; ?></span></a>
        </article>

        <article class="list-group">
            <h3 class="list-group-item list-group-item-success">Tempo medio dias corridos</h3>
            <a class="list-group-item">Maior Tempo:<span class="badge"><?= Check::RecuperaData($TempoMedio['max'])['return']; ?></span></a>
            <a class="list-group-item">Menor Tempo:<span class="badge"><?= Check::RecuperaData($TempoMedio['min'])['return']; ?></span></a>
            <a class="list-group-item active bodered">Tempo Medio:<span class="badge"><?= Check::RecuperaData($TempoMedio['media'])['return']; ?></span></a>
        </article>

        <article class="list-group">
            <h3 class="list-group-item list-group-item-success">Tempo medio de resolução</h3>
            <a class="list-group-item">Mês<span class="badge"><?= Check::RecuperaData($month['media'])['return']; ?></span></a>
            <a class="list-group-item">Semana<span class="badge"><?= Check::RecuperaData($week['media'])['return']; ?></span></a>
            <a class="list-group-item">Hoje<span class="badge"><?= Check::RecuperaData($day['media'])['return']; ?></span></a>
            <a class="list-group-item active bodered">Total<span class="badge"><?= Check::RecuperaData($TempoMedio['media'])['return']; ?></span></a>
        </article>

        <article class="list-group">
            <h3 class="list-group-item list-group-item-success">Total de solicitações</h3>
            <a class="list-group-item">Mês<span class="badge"><?= $month['count']; ?></span></a>
            <a class="list-group-item">Semana<span class="badge"><?= $week['count']; ?></span></a>
            <a class="list-group-item">Hoje<span class="badge"><?= $day['count']; ?></span></a>
            <a class="list-group-item active bodered">Total<span class="badge"><?= $total; ?></span></a>
        </article>

    </div>

    <div class="col-md-8">

        <div id="columnchart_values" style="width: 100%; height: 400px; padding-bottom: 55px; float: left;"></div>

        <div class="clearfix"></div>

        <?php
        $FeExames->Execute()->FullRead("SELECT e.ex_id, e.ex_descricao, e.ex_minemonico, e.ex_data_abertura "
                . "FROM fe_exames e WHERE e.ex_cancelado=0 AND e.ex_status=0");

        if (!$FeExames->Execute()->getResult()):
            WSErro("Nenhum exame pendende te alteração no momento!", WS_INFOR);
        else:
            ?>
            <table class="table table-striped table-hover" style="text-align: center">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: center">Exames aguardando alteração</th>
                    </tr>
                    <tr>
                        <th style="text-align: center">Descrição</th>
                        <th style="text-align: center">Minemonico</th>
                        <th style="text-align: center">Data Solicitação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($FeExames->Execute()->getResult() as $exames):
                        extract((array) $exames);
                        ?>    
                        <tr>
                            <td><a href="<?= FAST_INCLUDE ?>admin/&exe=exames/update&examesId=<?= $ex_id; ?>#form"><?= Check::Words($ex_descricao, 4); ?></a></td>
                            <td><a href="<?= FAST_INCLUDE ?>admin/&exe=exames/update&examesId=<?= $ex_id; ?>#form"><?= $ex_minemonico; ?></a></td>
                            <td><a href="<?= FAST_INCLUDE ?>admin/&exe=exames/update&examesId=<?= $ex_id; ?>#form"><?= date('d/m/y | H:i', strtotime($ex_data_abertura)) . "H"; ?></a></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>
</div>