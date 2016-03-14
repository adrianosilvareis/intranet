<article id="form">
    <?php
    include "include/contadores-de-impressao/_models/AdminContadores.class.php";
    include "include/contadores-de-impressao/_models/AdminImpressoras.class.php";

    $action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);
    $libera = filter_input(INPUT_GET, "libera", FILTER_DEFAULT);
    $AdminContadores = new AdminContadores();
    $AdminImpressoras = new AdminImpressoras();

    if (!empty($libera)):
        $AdminImpressoras->ExeUnlock();
        WSErro("Impressoras liberadas para registro de contador", WS_ACCEPT);
    endif;

    if (!empty($action)):

        $toaction = explode("/", $action);

        $contador = ($AdminContadores->FindId($toaction[1]) ? $AdminContadores->FindId($toaction[1])[0] : false);

        if (!empty($contador)):
            switch ($toaction[0]):

                case "active":
                    $AdminContadores->ExeStatus($toaction[1], 1);
                    WSErro("Contador da impressora <b>$contador->impressora_serial</b> ativo com sucesso!", WS_ACCEPT);
                    break;

                case "inative":
                    $AdminContadores->ExeStatus($toaction[1], 0);
                    WSErro("Contador da impressora <b>$contador->impressora_serial</b> desativado com sucesso!", WS_ACCEPT);
                    break;

                case "delete":
                    if ($AdminContadores->ExeDelete($toaction[1])):
                        WSErro("Contador da impressora <b>$contador->impressora_serial</b> deletado com sucesso!", WS_ACCEPT);
                    else:
                        WSErro("Erro ao deletar", WS_ERROR);
                    endif;
                    break;

                default :
                    WSErro("Opss! opção invalida.", WS_ERROR);
                    break;
            endswitch;
        else:
            WSErro("O contador informada não pode ser encontrado!", WS_INFOR);
        endif;
    endif;

    $search = filter_input(INPUT_POST, "search", FILTER_DEFAULT);
    $where = (!empty($search) ? "WHERE impressora_serial like \"%$search%\" " : "");

    $Read = new ImpContadores();

    $year = date("Y");
    $month = date("m") - 3;
    $day = 1;

    if (!empty($search)):
        $Read->Execute()->FullRead("SELECT i.*, c.* FROM imp_contadores c JOIN imp_impressora i ON(c.fk_impressora = i.impressora_id) WHERE impressora_serial like '%$search%'");
    else:
        $Read->Execute()->FullRead("SELECT i.*, c.* FROM imp_contadores c JOIN imp_impressora i ON(c.fk_impressora = i.impressora_id) WHERE c.contadores_data >= '$year-$month-$day' ORDER BY contadores_data DESC");
    endif;
    ?>

    <div class="row">
        <form name="search" method="post" class="form-inline col-md-8" >
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Entre com serial" name="search" value="<?= $search; ?>">
                    <span class="input-group-btn">
                        <input class="btn btn-success" type="submit" value="Go">
                    </span>
                </div>
            </div>
        </form>

        <div class="col-md-4">
            <a href="<?= IMP_INCLUDE ?>admin/&libera=true" class="btn btn-primary">Liberar Impressoras</a>
        </div>
    </div>

    <?php
    if (!$Read->Execute()->getResult()):
        WSErro("Desculpa, não encontramos nenhuma impressora!", WS_INFOR);
    else:
        ?>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="text-center">Serial</th>
                    <th class="text-center">Posto</th>
                    <th class="text-center">Modelo</th>
                    <th class="text-center">Contador</th>
                    <th class="text-center">Data</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($Read->Execute()->getResult() as $imp):
                    extract((array) $imp);
                    ?>
                    <tr style="font-size: 0.9em;">
                        <td><?= $impressora_serial; ?></td>
                        <td><?= $AdminImpressoras->Posto($fk_postos); ?></td>
                        <td><?= $AdminImpressoras->Modelo($fk_modelo); ?></td>
                        <td><?= $contadores_contador; ?></td>
                        <td><?= date("d-m-Y", strtotime($contadores_data)); ?></td>

                        <td>
                            <ul class="post_actions plugin">
                                <li><a class="act_edit" href="<?= IMP_INCLUDE ?>admin/&exe=contadores/update&contadorId=<?= $contadores_id; ?>" title="Editar">Editar</a></li>
                                <li><a class="act_delete" href="<?= IMP_INCLUDE ?>admin/&action=delete/<?= $contadores_id; ?>#form" title="Excluir">Deletar</a></li>
                            </ul>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
    <?php
    endif;
    ?>
</article>
