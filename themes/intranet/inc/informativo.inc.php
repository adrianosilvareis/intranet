<?php
if (empty($_SESSION['userlogin']['user_birthday'])):
    ?>
    <div class="modal fade" id="updateInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h1 class="alert alert-info modal-title text-center" id="myModalLabel">Atenção</h1>
                </div>

                <div class="modal-body">
                    <p class="lead">Olá,</p>
                    <p class="lead">Se você esta vendo esta mensagem, então preciso que você <strong>atualize</strong> suas informações na intranet.</p>
                    <p class="lead">É fácil, click abaixo e preencha o formulario.</p>
                    <a class="btn btn-success btn-lg" href="/intranet/profile">Click Aqui</a>
                </div>
                <div class="modal-footer">
                    <blockquote>
                        <p>Equipe de TI.</p>
                    </blockquote>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>

    <?php
 endif;