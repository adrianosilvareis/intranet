<?php
include_once '../../_app/Config.inc.php';
$Session = new Session();
$Read = new WsUsers();

$request = json_decode(file_get_contents("php://input"));

if (!empty($request) && !empty($request->userOnline)):
    echo json_encode($_SESSION['userlogin']);
else:
    $Read->Execute()->findAll();
    echo json_encode($Read->Execute()->getResult());
endif;

