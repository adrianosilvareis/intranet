<?php

include_once '../../_app/Config.inc.php';

$Session = new Session;

$user = $_SESSION['userlogin'];

echo json_encode($user);