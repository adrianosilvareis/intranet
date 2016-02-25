<?php
$AppNiver = new AppNiver();
$data = date("Y-m-d");
$AppNiver->Execute()->FullRead("SELECT * FROM app_niver WHERE niver_data = '$data'");

if ($AppNiver->Execute()->getResult()):
    ?>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Parabéns aos colaboradores:</h4>
                </div>

                <div class="modal-body">
                    <div class="nivercard">
                        <div class="img"></div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th colspan="2">Colaboradores</th>
                                </tr>
                                <tr>
                                    <th>Nome</th>
                                    <th>Setor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($AppNiver->Execute()->getResult() as $niver):
                                    extract((array) $niver);
                                    $niver_nome = strtolower($niver_nome);
                                    $niver_setor = strtolower($niver_setor);
                                    ?>
                                    <tr>
                                        <td class="text-capitalize"><?= $niver_nome; ?></td>
                                        <td class="text-capitalize"><?= $niver_setor; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>