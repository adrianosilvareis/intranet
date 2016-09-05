<?php
$WsUsers = new WsUsers();
$Termos = "SELECT * FROM ws_users u "
        . "WHERE MONTH(u.user_birthday) = MOD(MONTH(CURDATE()), 12) "
        . "AND DAY(u.user_birthday) = DAY(CURDATE())";

$WsUsers->Execute()->FullRead($Termos);
if ($WsUsers->Execute()->getResult()):
    ?>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">

                    <div class="section">
                        <div class="container">

                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="text-center">Parabéns</h1>
                                    <p class="text-center">Feliz aniversário aos colaboradores.</p>
                                </div>
                            </div>

                            <div class="row">
                                <?php
                                foreach ($WsUsers->Execute()->getResult() as $user):
                                    extract((array) $user);
                                    ?>
                                    <div class="col-md-4">
                                        <?php if (!empty($user_cover)): ?>
                                            <img src="<?= HOME ?>/tim.php?src=<?= HOME ?>/uploads/<?= $user_cover; ?>&w=300&h=300"
                                                 class="center-block img-circle img-responsive">
                                             <?php else: ?>
                                            <img src="http://pingendo.github.io/pingendo-bootstrap/assets/user_placeholder.png"
                                                 class = "center-block img-circle img-responsive">
                                             <?php endif;
                                             ?>

                                        <h3 class="text-center"><?= ucfirst(strtolower(Check::Words($user_name . ' ' . $user_lastname, 3))); ?></h3>
                                        <p class="text-center"><?= Check::AreaById($area_id)->area_title; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>