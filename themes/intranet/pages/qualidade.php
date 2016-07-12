<?php
$dir = filter_input(INPUT_GET, "ftp", FILTER_DEFAULT);
$file = filter_input(INPUT_GET, "file", FILTER_DEFAULT);
$style = filter_input(INPUT_GET, 'style', FILTER_DEFAULT);

$Ftp = new Ftp(HOME . "/pages/qualidade/", $style);

echo $Ftp->getBread($dir);
$Ftp->setConn(FTP_HOST);
$Ftp->setLogin(FTP_USER, FTP_PASS);

echo "<div class='row'>";
if (!empty($style) && $style == 'lista'):
    ?>
    <a href="<?= $Ftp->getPage() . "&ftp=" . $Ftp->getUrl(); ?>&style=bloco" class="btn btn-success" style="float: right; width: 100px;">Bloco</a>
<?php else: ?>
    <a href="<?= $Ftp->getPage() . "&ftp=" . $Ftp->getUrl(); ?>&style=lista" class="btn btn-primary" style="float: right; width: 100px;">Lista</a>
<?php
endif;
echo "</div>";
?>

<div class="well">
    <?php
    $lista = (!empty($dir) ? $Ftp->nlist($dir) : $Ftp->nlist('.'));

    if (empty($file)):
        $i = 0;

        $class = ($style == 'lista' ? 'list-group' : 'row');
        echo "<div class=\"$class\">";

        foreach ($lista as $url):

            $title = $Ftp->UrlToDir($url);

            if ($title != '.tmb' && $title != '.quarantine'):

                if (empty($style) || $style == "bloco"):
                    if ($i % 6 == 0):
                        echo "</div><div class=\"row\">";
                    endif;
                endif;

                if (empty($style) || $style == "bloco"):
                    if ($Ftp->ftp_is_dir($url)):
                        $Ftp->getIcon("&ftp=$url", $title, "pasta");
                    else:
                        $File = $Ftp->UrlToFile($url);
                        $Ftp->getIcon("&file=$url", $File['fileName'], $File['type'], true);
                    endif;
                    $i++;
                else:
                    if ($Ftp->ftp_is_dir($url)):
                        $Ftp->getList("&ftp=$url", $title, "pasta");
                    else:
                        $File = $Ftp->UrlToFile($url);
                        $Ftp->getList("&file=$url", $File['fileName'], $File['type'], true);
                    endif;
                    $i++;
                endif;

            endif;

        endforeach;
        echo "</div>";
    else:
        $title = $file;
        $arrayTitle = explode("/", $title);
        $fileName = array_pop($arrayTitle);

        $local_file = '/temp/' . Check::FileName($fileName);
        //verifica se o arquivo ja foi acessado. Se sim acessa a pasta temp do FTP
        if (file_exists(DOCUMENT_ROOT . NAME . DIRECTORY_SEPARATOR . "ftp" . $local_file)):
            header("Location: " . FTP_HOME . $local_file);
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