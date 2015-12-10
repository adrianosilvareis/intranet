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
                    <h4 class="modal-title" id="myModalLabel">Hoje é o dia de</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?= HOME . "/" . REQUIRE_PATH ?>/images/cabecalhos/parabens.png" title="parabéns" alt="parabéns" class="img img-responsive">                       
                        </div>
                        <div class="col-md-6">
                            <h1>Colaboradores</h1>
                            <?php
                            foreach ($AppNiver->Execute()->getResult() as $niver):
                                extract((array) $niver);
                                $niver_nome = strtolower($niver_nome);
                                $niver_setor = strtolower($niver_setor);
                                echo "<p class=\"text-capitalize\">$niver_nome, <mark>$niver_setor</mark></p>";
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>