<?php
$ImpPostos = new ImpPostos();
$ImpPostos->Execute()->find("postos_id={$Link->getLocal()[2]}");
?>

<a style="float: right;" class="btn btn-info" href="<?= IMP_INCLUDE ?>">Voltar</a>
<h2><small><?= $ImpPostos->Execute()->getResult()->postos_nome; ?></small></h2>

<?php
if (file_exists(PLUGIN_PATH . "\contadores-de-impressao\_models\AdminImpressoras.class.php")):
    include PLUGIN_PATH . "\contadores-de-impressao\_models\AdminImpressoras.class.php";
endif;

$AdImpress = new AdminImpressoras($Link->getLocal()[2]);

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['sendContador'])):
    unset($data['sendContador']);

    $minContador = $AdImpress->MinContador($data['contadores_contador'], $Link->getLocal()[3]);
    if (!$minContador):
        $AdImpress->ExeRegister($data);
        header("Location: " . IMP_INCLUDE . $Link->getLocal()[2]);
    else:
        WSErro("O contador deve ser maior que: <b>{$minContador[0]->contadores_contador}</b>", WS_INFOR);
    endif;
endif;

if (!empty($Link->getLocal()[3]) && is_numeric($Link->getLocal()[3])):
    $impressora = $AdImpress->CheckStatus($Link->getLocal()[2], $Link->getLocal()[3]);

    if ($impressora === "nulo"):
        WSErro("Opsss! Esta impressora não existe ou não pertence a este posto.", WS_ERROR);
    elseif (!$impressora):
        WSErro("Impressora registrada com sucesso.", WS_ACCEPT);
    else:
        ?> 
        <form name="registrar" method="POST" class="form-inline form-group">
            <input type="hidden" name="fk_impressora" value="<?= $Link->getLocal()[3] ?>" />
            <input type="hidden" name="serial" value="<?= $impressora->impressora_serial; ?>" class="form-control"/>
            <input type="text" name="serial" disabled="true" value="<?= $impressora->impressora_serial; ?>" class="form-control"/>
            <input type="text" name="contadores_contador" placeholder="Impressões totais" class="form-control" value="<?= $data['contadores_contador']; ?>"/>
            <input type="submit" name="sendContador" value="Enviar" class="btn btn-success"/>
        </form>
    <?php
    endif;
endif;
?>

<div class="panel">
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Descrição</th>
                <th>Modelo</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($AdImpress->getResult() as $imp):
                extract((array) $imp);
                ?>
                <tr class="text-center">
                    <td>
                        <?= $impressora_serial; ?>
                    </td>
                    <td>
                        <?= $impressora_descricao; ?>
                    </td>
                    <td>
                        <?= $AdImpress->Modelo($fk_modelo); ?>
                    </td>

                    <?php if ($impressora_status): ?>
                        <td class="accept">
                            Ultimo: <?= "<b>" . $AdImpress->MinContador(0, $impressora_id)[0]->contadores_contador . "</b>"; ?>
                        </td>
                    <?php else: ?>
                        <td class="error">
                            <a href="<?= IMP_INCLUDE . "{$imp->fk_postos}/{$impressora_id}" ?>">PENDENTE</a>
                        </td>   
                    <?php
                    endif;
                    ?>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>