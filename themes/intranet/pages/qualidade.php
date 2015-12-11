<?php
$Ftp = new Ftp();
$Ftp->setLink(HOME . "/{$Link->getLocal()[0]}/{$Link->getLocal()[1]}");





$url = filter_input(INPUT_GET, "ftp", FILTER_DEFAULT);
$arquivo = HOME . '/ftp' . $url;

var_dump($Ftp);
$icon = "http://localhost:1989/intranet/themes/intranet/images/ftpIcons/pdf.png";
$pasta = "http://localhost:1989/intranet/themes/intranet/images/ftpIcons/pasta.png";

if ($Ftp->checkDir()):
    $openDir = opendir($Ftp->getDir());
    while ($File = readdir($openDir)):
        if ($File != "." && $File != ".."):
            if ($Ftp->checkDir(null, $File)):
                echo "<a href='{$Ftp->getLink()}/$File'><img src='$pasta' width='80px' alt='{$File}' title='$File'></a>";
            else:
                echo "<a href='$arquivo/$File' target='_blank'><img src='$icon' width='80px' alt='{$File}' title='$File'></a>";
            endif;
        endif;
    endwhile;
endif;
?>

<div style="float: left; width: 80px; max-height: 150px; overflow:hidden; text-align: center;">
    <img src="<?= HOME ?>/<?= REQUIRE_PATH ?>/images/ftpIcons/doc.png" width="80px" height="80px">    
    
</div>
