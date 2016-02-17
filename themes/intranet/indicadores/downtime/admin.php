<section class="section">
    <h1><span style="font-size: 0.8em;color: #787878">Indicadores <small>Relatorio de tempo de parada</small></span></h1>

    <?php
    $Read = new Controle();

    $Read->FullRead("select t.equip_id, t.time_id, t.time_stop, t.time_start, "
            . "t.time_lastupdate, t.equip_author, e.equip_title, e.equip_content, "
            . "e.equip_date, e.equip_status, e.equip_lastupdate "
            . "from dt_downtime t JOIN dt_equipamentos e ON(e.equip_id = t.equip_id)");
    ?>

    <h2>Meta: <small>48 Hours.</small></h2>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Equipamento</th>
                    <th>Descrição</th>
                    <th>Data ativação</th>
                    <th>Ultima atualização</th>
                    <th>Hora da parada</th>
                    <th>Hora da reativação</th>
                    <th>Responsável</th>
                    <th>Tempo de parada</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Read->getResult() as $key): ?>
                    <tr>
                        <td><?= $key->equip_title; ?></td>
                        <td><?= $key->equip_content; ?></td>
                        <td><?= date("d/m/Y H:i", strtotime($key->equip_date)); ?></td>
                        <td><?= date("d/m/Y H:i", strtotime($key->equip_lastupdate)); ?></td>
                        <td><?= date("d/m/Y H:i", strtotime($key->time_stop)); ?></td>
                        <td><?= ($key->time_start != "0000-00-00 00:00:00" ? date("d/m/Y H:i", strtotime($key->time_start)) : ""); ?></td>
                        <td><?= $key->equip_author; ?></td>
                        <td><?= ($key->time_start != "0000-00-00 00:00:00" ? Check::DataDiff($key->time_stop, $key->time_start, 2) : ""); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>