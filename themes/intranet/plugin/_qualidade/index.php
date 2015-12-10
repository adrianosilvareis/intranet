<!DOCTYPE html>
<html>
    <head>
        <title>FTP - Tommasi</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="theme/estilo.css">
    </head>
    <body>
        <div class="page">
            <div class="topo">
                <div class="titulo">
                    <img src="img/Titulo.png" width="300" height="100">
                </div>
                <div class="back">
                    <a href="JavaScript: window.history.back();">
                        <img src="img/back.png" width="100" height="100">

                    </a>
                </div>
            </div>

            <div class="corpo">
                <hr>
                <?php
                require_once 'class/ftp.php';
                ?>
            </div>
        </div>
        <footer>
            &copy Todos os direitos reservados <strong>Adriano Reis</strong>
        </footer>
    </body>
</html>