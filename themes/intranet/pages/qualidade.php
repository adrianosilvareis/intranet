<?php
$dir = filter_input(INPUT_GET, "ftp", FILTER_DEFAULT);
$file = filter_input(INPUT_GET, "file", FILTER_DEFAULT);

$Ftp = new Ftp(HOME . "/pages/qualidade/");

echo $Ftp->getNav($dir);
$Ftp->setConn(FTP_HOST);
$Ftp->setLogin(FTP_USER, FTP_PASS);
?>

<div class="well">
    <?php
    if (!empty($dir)):
        $lista = $Ftp->nlist($dir);
    else:
        $lista = $Ftp->nlist('.');
    endif;

    if (empty($file)):
        $i = 0;
        echo "<div class=\"row\">";
        foreach ($lista as $key):
            if ($i % 6 == 0):
                echo "</div><div class=\"row\">";
            endif;
            if ($Ftp->ftp_is_dir($key)):
                $title = explode("/", $key);
                $title = array_pop($title);
                $Ftp->getIcon("&ftp=$key", $title, "pasta");
            else:
                $title = explode("/", $key);
                $title = array_pop($title);
                $title = explode(".", $title);
                $type = array_pop($title);
                $title = implode(".", $title);
                $Ftp->getIcon("&file=$key", $title, $type, true);
            endif;
            $i++;
        endforeach;
        echo "</div>";
    else:
        $local_file = '/temp/' . str_replace("/", "_", $file);
    
        /**
         * Esta condição verifica que so arquivo já existe com este nome, porem se o mesmo for alterado não será baixado uma nova versão.
         * 
         * sendo necessario limpar a pasta ftp/temp quando um arquivo for modificado e não alterado o nome.
         */
        if (file_exists(DOCUMENT_ROOT . NAME . DIRECTORY_SEPARATOR . "ftp" . $local_file)):
            header("Location: " . FTP_HOME . "$local_file");
        else:
            if ($Ftp->Download($local_file, $file)):
                header("Location: " . FTP_HOME . "$local_file");
            else:
                echo "Erro ao baixar arquivo";
            endif;
        endif;

    endif;
    ?>
</div>