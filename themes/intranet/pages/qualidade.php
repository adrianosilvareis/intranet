<?php

$url = filter_input(INPUT_GET,"ftp", FILTER_DEFAULT);
$HOME = DOCUMENT_ROOT . DIRECTORY_SEPARATOR . THEME . DIRECTORY_SEPARATOR . 'ftp';
$dir = $HOME . DIRECTORY_SEPARATOR . $url;

if (Ftp::checkDir($dir)):
    $openDir = opendir($dir);
    while ($File = readdir($openDir)):
        if ($File != "." && $File != ".."):
            if (Ftp::checkDir($dir . "//" . $File)):
                echo "<a href='$link/$File'><img src='" . HOME . "icon/pasta.png' width='80px' alt='{$File}' title='$File'></a>";
            else:
                echo "<a href='$link/$File'><img src='" . HOME . "icon/pdf.jpg' width='80px' alt='{$File}' title='$File'></a>";
            endif;
        endif;
    endwhile;
endif;