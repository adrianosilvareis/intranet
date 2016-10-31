<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" title="HOME" href="<?= HOME ?>">
                <h1 class="notitle">Menu <img alt="<?= SITENAME ?>" src="<?= HOME . '/themes/' . THEME ?>/images/icon/labo.png"></h1>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav nav-pills"> <!-- primairo bloco -->
                <li class="active"><a href="<?= HOME ?>">HOME</a></li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" arial-haspopup="true" arial-expanded="false">Links úteis<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="active"><a>Links</a></li>
                        <li><a href="https://webmail-seguro.com.br/tommasi.com.br/" target="_blank">WebMail</a></li>
                        <li><a href="http://helpdesktommasi.ddns.net:8778/ocomon/" target="_blank">HelpDesk</a></li>
                        <li><a href="http://sdlaudos.portalglauco.com.br/LoginNovo.aspx?ReturnUrl=%2fSistema%2fAberturaNova.aspx">SDLaudos</a></li>
                        <li><a href="https://www.e-lis.com.br/shift/lis/tommasi/s00.iu.Login.cls" target="_blank">SHIFT LIS</a></li>
                        <li><a href="http://cetan.tempsite.ws/coleta/adm/login.php" target="_blank">Coleta Domiciliar</a></li>
                        <li><a href="http://metaframe.suncoke.com.br" target="_blank">SunCoke</a></li>
                        <li><a href="http://www.crmes.org.br/index.php?option=com_medicos" target="_blank">Buscar Médicos (CRM)</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" arial-haspopup="true" arial-expanded="false">Ferramentas<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="active"><a>Ferramentas</a></li>
                        <?php
                        foreach (Plugins() as $plugin):
                            echo "<li><a class=\"text-capitalize\" href=" . HOME . "/plugin/{$plugin['url']}>{$plugin['title']}</a></li>";
                        endforeach;
                        ?>
                    </ul>
                </li>
                <!-- dropdown -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categorias <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        if (Check::CatParentByName("grupo")):
                            echo "<li class = \"active\"><a>Grupo</a></li>";
                            foreach (Check::CatParentByName("grupo") as $cat):
                                echo "<li><a href=" . HOME . "/grupo/{$cat->category_name}>{$cat->category_title}</a></li>";
                            endforeach;
                        endif;
                        echo "<li class=\"divider\"></li>";
                        if (Check::CatParentByName("membros")):
                            echo "<li class = \"active\"><a>Membros</a></li>";
                            foreach (Check::CatParentByName("membros") as $cat):
                                echo "<li><a href=" . HOME . "/membros/{$cat->category_name}>{$cat->category_title}</a></li>";
                            endforeach;
                        endif;
                        ?>
                        <li class="divider"></li>
                        <li class="active"><a>Páginas</a></li>
                        <li><a href="<?= HOME ?>/pages/aniversarios" title="Aniversáriantes do mês">Aniversáriantes</a></li>
                        <li><a href="<?= HOME ?>/pages/institucional" title="Missão, Visão, Valores">Institucional</a></li>
                        <li><a href="<?= HOME ?>/pages/qualidade">Qualidade</a></li>
                        <li><a href="<?= HOME ?>/pages/contato" title="contato por email">Contato</a></li>
                        <li><a href="<?= HOME ?>/pages/sobre" title="Sobre a Intranet">Sobre</a></li>
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
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Pesquisar na intranet" name="s" title="Pequise algume coisa na intranet">
                    <span class="input-group-addon">
                        <button type="submit" class="glyphicon glyphicon-search" name="sendsearch" style="background: none; border: none; width: 100%;" title="Pequise algume coisa na intranet"></button>
                    </span>
                </div>
                <!--<button type="submit" class="btn btn-default" name="sendsearch">Buscar</button>-->
            </form>

            <!-- modal -->
            <!--<button type="button" class="btn btn-primary navbar-btn navbar-right" data-toggle="modal" data-target=".modal-login">Login</button>-->

            <ul class="nav navbar-nav navbar-right">
                <li><a href="https://webmail-seguro.com.br/tommasi.com.br/" target="_blank">WebMail</a></li>
                
                        <li><a href="<?= HOME ?>/pages/institucional" title="Institucional">Institucional</a></li>

            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>