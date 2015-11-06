<?php
if (file_exists(PLUGIN_PATH . "\contadores-de-impressao\_models\AdminPostos.class.php")):
    include PLUGIN_PATH . "\contadores-de-impressao\_models\AdminPostos.class.php";
endif;

$AdPostos = new AdminPostos();

if (!empty($Link->getLocal()[2])):
    ($Link->getLocal()[2] == "ok" ? WSErro("Registro já concluido", WS_ACCEPT) : ($Link->getLocal()[2] == "erro" ? WSErro("Oppss! Este posto não existe.", WS_ERROR) : WSErro("Oppss! Opção inválida.", WS_ALERT)) );
endif;
?>
<div class="panel">
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>Unidades</th>
                <th>Pendente</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($AdPostos->getRestantes() as $imp) {
                ?>
                <tr class="text-center">
                    <td>
                        <a href="<?= HOME . "/plugin/contadores-de-impressao/" . $imp->postos_id; ?>"><?= $imp->postos_nome; ?></a>
                    </td>
                    <td>
                        <?= $imp->cont; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>