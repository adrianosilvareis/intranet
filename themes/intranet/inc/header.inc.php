<div class="section bg-sucesso">
    <div class="container">
        <header>

            <h1 class="notitle logo shadow-right"><?= SITENAME ?><a title="<?= SITENAME ?>" href="<?= HOME ?>"><img src="<?= HOME . '/themes/' . THEME ?>/images/header-trans-inverse.png" alt="<?= SITENAME ?>" class="img-responsive"></a></h1>

            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?= HOME ?>">
                            <h1 class="notitle">Menu <img alt="<?= SITENAME ?>" src="<?= HOME . '/themes/' . THEME ?>/images/icon/labo.png"></h1>
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <ul class="nav navbar-nav nav-pills"> <!-- primairo bloco -->
                            <li class="active"><a href="<?= HOME ?>">HOME</a></li>
                            <li><a href="<?= HOME ?>/membros/equipe-de-ti/">Equipe de TI</a></li>

                            <!-- dropdown -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categorias <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li class="active"><a>Grupo</a></li>
                                    <li><a href="<?= HOME ?>/grupo/convenios">Convênio</a></li>
                                    <li><a href="<?= HOME ?>/grupo/nota-fiscal">Nota Fiscal</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li class="active"><a>Links</a></li>
                                    <li><a href="http://helpdesktommasi.ddns.net:8778/ocomon/" target="_blank">HelpDesk</a></li>
                                    <li><a href="http://sdlaudos.portalglauco.com.br/LoginNovo.aspx?ReturnUrl=%2fSistema%2fAberturaNova.aspx">SDLaudos</a></li>
                                    <li><a href="http://187.72.199.27/shift/lis/tommasi/s00.iu.Login.cls" target="_blank">SHIFT LIS</a></li>
                                    <li><a href="http://cetan.tempsite.ws/coleta/adm/login.php" target="_blank">Coleta Domiciliar</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li class="active"><a>Aplicativos</a></li>
                                    <li><a href="/view/redirect/sft_redirect.html" target="_blank">SFT - Tommasi</a></li>
                                    <li><a href="/ftp">Qualidade</a></li>
                                    <li><a href="<?= HOME ?>/pages/aniversarios">Aniversariantes</a></li>
                                    <li class="active"><a>Plugins</a></li>
                                    <?php
                                    /**
                                     * Plugins
                                     */
                                    $lista = Plugins();
                                    foreach ($lista as $plugin):
                                        echo "<li><a class=\"text-capitalize\" href=\"{$plugin['url']}\">{$plugin['title']}</a></li>";
                                    endforeach;
                                    ?>
                                </ul>
                            </li>
                        </ul>

                        <?php
                        $search = filter_input(INPUT_POST, 's', FILTER_DEFAULT);
                        if (!empty($search)):
                            $search = strip_tags(trim(urlencode($search)));
                            header('Location: ' . HOME . '/pesquisa/' . $search);
                        endif;
                        ?>                
                        <form class="navbar-form navbar-left" name="search" action="" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Pesquisar" name="s">
                            </div>
                            <button type="submit" class="btn btn-default" name="sendsearch">Buscar</button>
                        </form>

                        <!-- modal -->
                        <button type="button" class="btn btn-primary navbar-btn navbar-right" data-toggle="modal" data-target=".modal-login">Login</button>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="https://webmail-seguro.com.br/tommasi.com.br/" target="_blank">WebMail</a></li>
                            <li><a href="<?= HOME ?>/pages/contato">Contato</a></li>
                        </ul>

                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>

            <!-- modal -->
            <div class="modal fade modal-login">
                <div class="modal-dialog">
                    <div class="modal-content col-md-9">
                        <div class="modal-body">
                            <h1 class="text-center text-primary">Administrar Site</h1>
                            <hr>
                            <?php
                            $login = new Login(3);

//                            if ($login->CheckLogin()):
//                                header('Location: admin/painel.php');
//                            endif;

                            $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                            if (!empty($dataLogin['AdminLogin'])):

                                $login->ExeLogin($dataLogin);
                                if (!$login->getResult()):
                                    WSErro($login->getError()[0], $login->getError()[1]);
                                else:
                                    header("Location: " . HOME . "/admin/painel.php");
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
                                        <input type="email" name="user" class="form-control" placeholder="Email"/>
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
            <!-- modal -->
        </header>
    </div>
</div>

