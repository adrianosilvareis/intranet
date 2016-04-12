<?php

include '../../_app/Config.inc.php';

if (!empty($_FILES)):

    $Upload = new Upload(DOCUMENT_ROOT . NAME . '/uploads/temp/');
    $Upload->File($_FILES['file'], Check::Name($_FILES['file']['name']), NULL, 25);

    echo json_encode($Upload->getResult());
endif;