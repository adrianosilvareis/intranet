<!-- modal -->
<div class="modal fade modal-login">
    <div class="modal-dialog">
        <div class="modal-content col-md-9">
            <div class="modal-body">
                <h1 class="text-center text-primary">Administrar Site</h1>
                <hr>
                <?php
                $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (!empty($dataLogin['AdminLogin'])):

                    $Login->ExeLogin($dataLogin);
                    if (!$Login->getResult()):
                        var_dump($Login);
                        $_SESSION['login_report'] = $Login->getError();
                        header("Location: " . HOME);
                    else:
                        header("Location: " . HOME);
                    endif;

                endif;

                $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
                if (!empty($get)):
                    if ($get == 'restrito'):
                        WSErro('<b>Oppsss:</b> Acesso negado. Favor efetue login para acessar o painel!', WS_INFOR);
                    elseif ($get == 'logoff'):
                        WSErro('<b>Sucesso ao deslogar:</b> Sua sessão foi finalizada. Volte sempre!', WS_ACCEPT);
                    endif;
                endif;
                ?>

                <form class="form-horizontal" name="AdminLoginForm" action="" method="post">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label">Email</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" name="user" class="form-control" placeholder="Usuario ou Email"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="inputPassword3" class="control-label">Password</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="password" name="pass" class="form-control" placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">Remember me</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" name="AdminLogin" value="Entrar" class="btn btn-block btn-info" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>