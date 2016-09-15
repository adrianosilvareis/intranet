<?php
ob_start();
session_start();
require('_app/Config.inc.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Site Login</title>

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?= HOME ?>/admin/css/reset.css" />
        <link rel="stylesheet" href="<?= HOME ?>/admin/css/admin.css" />
        <link rel="stylesheet" href="<?= HOME ?>/css/default.css" />
    </head>
    <body class="login">

        <div id="login">
            <div class="boxin">
                <h1>Intranet Tommasi</h1>

                <?php
                $login = new Login(5);

                $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (!empty($dataLogin['AdminLogin'])):

                    $login->ExeLogin($dataLogin);
                    if (!$login->getResult()):
                        WSErro($login->getError()[0], $login->getError()[1]);
                    else:
                        header('Location: ' . HOME);
                    endif;

                endif;

                $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
                if (!empty($get)):
                    if ($get == 'restrito'):
                        WSErro('<b>Oppsss:</b> Acesso negado. Favor efetue login para acessar o painel!', WS_ALERT);
                    elseif ($get == 'logoff'):
                        WSErro('<b>Sucesso ao deslogar:</b> Sua sessão foi finalizada. Volte sempre!', WS_ACCEPT);
                    endif;
                endif;
                ?>
                <form name="AdminLoginForm" action="" method="post">
                    <label>
                        <span>E-mail:</span>
                        <input type="text" name="user" placeholder="Email ou User"/>
                    </label>

                    <label>
                        <span>Senha:</span>
                        <input type="password" name="pass" placeholder="Senha"/>
                    </label>  

                    <input type="submit" name="AdminLogin" value="Logar" class="btn blue" />

                </form>
                <small style="font-size: 0.6em; float: right; color: #666"><?= SISS_VERSION ?></small>
            </div>
        </div>

    </body>
</html>
<?php
ob_end_flush();
