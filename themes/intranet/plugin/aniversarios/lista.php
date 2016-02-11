<section class="section">

    <dic class="container">
        <div class="row">
            <img src="<?= INCLUDE_PATH ?>/images/cabecalhos/aniversariantesdomes.png" alt="Aniversariantes do Mês" class="img-responsive img-rounded">
        </div>
        <?php
        $error = filter_input(INPUT_GET, "error", FILTER_DEFAULT);
        if (isset($error)):
            if ($error === "arquivo"):
                WSErro("Arquivo inválido!", WS_ERROR);
            elseif ($error === "opcao"):
                WSErro("Opção inválida!", WS_INFOR);
            elseif ($error === "save"):
                WSErro("Arquivo salvo com sucesso!", WS_ACCEPT);
            endif;
        endif;
        ?>
        <div class="table-responsive">	
            <table class="table table-striped table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Setor</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $AppNiver = new AppNiver();
                    foreach ($AppNiver->Execute()->findAll() as $Niver):
                        extract((array) $Niver);
                        ?>                    
                        <tr>
                            <td><?= $niver_id; ?></td>
                            <td><?= $niver_nome; ?></td>
                            <td><?= $niver_setor; ?></td>
                            <td><?= date("d/m/Y", strtotime($niver_data)); ?></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </dic>
</section>