<?php
if (file_exists('include/contadores-de-impressao/_models/AdminPostos.class.php')):
    include 'include/contadores-de-impressao/_models/AdminPostos.class.php';
endif;

$AdPostos = new AdminPostos();
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

if (!empty($Link->getLocal()[2])):
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
            $AdPostos->Lista();
            if (!$AdPostos->getResult()):
                WSErro("Não existem postos a ser exibido!", WS_INFOR);
            else:
                foreach ($AdPostos->getResult() as $imp):
                    extract((array) $imp);
                    ?>
                    <tr class="text-center">
                        <td>
                            <a href="<?= IMP_INCLUDE . $postos_id; ?>" class="text-capitalize"><?= strtolower($postos_nome); ?></a>
                        </td>
                        <td>
                            <?= $cont; ?>
                        </td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
</div>