<?php
$dir = filter_input(INPUT_GET, "ftp", FILTER_DEFAULT);
$file = filter_input(INPUT_GET, "file", FILTER_DEFAULT);

$Ftp = new Ftp(HOME . "/pages/qualidade/");

echo $Ftp->getBread($dir);
$Ftp->setConn(FTP_HOST);
$Ftp->setLogin(FTP_USER, FTP_PASS);
?>

<div class="well">
    <?php
    $lista = (!empty($dir) ? $Ftp->nlist($dir) : $Ftp->nlist('.'));

    if (empty($file)):
        $i = 0;
        echo "<div class=\"row\">";
        
        foreach ($lista as $url):

            $title = $Ftp->UrlToDir($url);

            if ($title != '.tmb' && $title != '.quarantine'):
                if ($i % 6 == 0):
                    echo "</div><div class=\"row\">";
                endif;

                if ($Ftp->ftp_is_dir($url)):
                    $Ftp->getIcon("&ftp=$url", $title, "pasta");
                else:
                    $File = $Ftp->UrlToFile($url);
                    $Ftp->getIcon("&file=$url", $File['fileName'], $File['type'], true);
                endif;
                $i++;
            endif;

        endforeach;
        echo "</div>";
    else:
        $local_file = '/temp/' . Check::FileName($file);
        //verifica se o arquivo ja foi acessado. Se sim acessa a pasta temp do FTP
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