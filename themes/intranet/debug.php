<?php

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($Dados)):
    var_dump($Dados);

    if ($_FILES['file']) {
        var_dump($_FILES);
    }
endif;
?>

<form action="" enctype="multipart/form-data" method="post">
    <input type="file" name="file" />
    <input type="submit" name="enviar" />
</form>