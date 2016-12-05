<?php
$WsUsers = new WsUsers();
$Termos = "SELECT u.user_id, u.user_nickname, u.user_name, u.user_lastname, u.area_id, u.user_birthday, u.user_cover "
        . "FROM ws_users u "
        . "WHERE MONTH(u.user_birthday) = MONTH(CURDATE()) AND u.user_status = 1 ORDER By DAY(u.user_birthday)";

$WsUsers->Execute()->FullRead($Termos);

$export = filter_input(INPUT_GET, "export");
if (!empty($export)):
    $file = $WsUsers->Execute()->getResult();

    $dados = [];
    $header = array_keys((array) $file[0]);
    $dados[] = implode(';', $header);
    foreach ($file as $row):
        $array = (array) $row;
        $dados[] = implode(";", $array);
    endforeach;
    $texto = implode('\n', $dados);
    ?>
    <script>
        var uri = 'data:text/csv;charset=utf-8,' + escape("<?= $texto; ?>");

        var downloadLink = document.createElement("a");
        downloadLink.href = uri;
        downloadLink.download = "data.csv";


        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    </script>
    <?php
endif;

if (!$WsUsers->Execute()->getResult()):
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Ops,</h1>
                <p>parece que ninguém esta fazendo aniversário este mês.</p>
            </div>
        </div>
    </div>
    <?php
else:
    ?>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Parabéns</h1>
                    <p class="text-center">Estes são os aniversáriantes deste mês.</p>
                    <a class="btn btn-success" href="<?= HOME ?>/pages/aniversarios&export=true">Exportar para excel</a>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Setor</th>
                        <th>Dia</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($WsUsers->Execute()->getResult() as $niver):
                        extract((array) $niver);
                        ?>

                        <?php if (!empty($user_cover)): ?>
                        <div id="<?= $user_id; ?>" class="modal fade bs-example-modal-sm">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <img id="btn-<?= $user_id; ?>" src="<?= HOME ?>/tim.php?src=<?= HOME ?>/uploads/<?= $user_cover; ?>&w=600&h=600"
                                         class="cool center-block img-responsive">
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <tr>
                        <td><?= ucfirst(strtolower(Check::Words($user_name . ' ' . $user_lastname, 3))); ?></td>
                        <td><?= Check::AreaById($area_id)->area_title; ?></td>
                        <td><?= date('d', strtotime($user_birthday)); ?></td>
                        <td>
                            <?php if (!empty($user_cover)): ?>
                                <img id="btn-<?= $user_id; ?>" src="<?= HOME ?>/tim.php?src=<?= HOME ?>/uploads/<?= $user_cover; ?>&w=50&h=50"
                                     class="cool center-block img-responsive">
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>