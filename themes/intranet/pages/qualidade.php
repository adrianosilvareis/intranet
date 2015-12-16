<?php
$Ftp = new Ftp();
$Ftp->setInicio(HOME . "/{$Link->getLocal()[0]}/{$Link->getLocal()[1]}/&ftp=");

echo $Ftp->getNav();
?>

<div class="well">
    <?php
    if ($Ftp->checkDir()):
        $openDir = opendir($Ftp->getDir());
        $i = 0;
        echo "<div class='row'>\n";
        while ($File = readdir($openDir)):
            if ($File != "." && $File != ".."):
                echo ($i % 6 == 0 ? "</div>\n<div class='row'>\n" : '');
                if ($Ftp->checkDir(null, $File)):
                    $Ftp->getIcon($File, true, "pasta");
                else:
                    $Ftp->getIcon($File);
                endif;
                $i++;
            endif;
        endwhile;
        echo "</div>\n";
    endif;
    ?>
</div>