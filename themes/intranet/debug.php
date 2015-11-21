<?php

$lista = Plugins();

foreach ($lista as $plugin):
    echo "<a href='{$plugin['url']}'>{$plugin['title']}</a><br>";
endforeach;
?>