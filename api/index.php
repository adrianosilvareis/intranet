<?php

session_start();
include_once '../_app/Config.inc.php';

//Verifica se o usuario esta logado
$Login = new Login(5);
if (!$Login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: ' . HOME . '/login.php?exe=restrito');
endif;

$userlogin = $_SESSION['userlogin'];
$request = json_decode(file_get_contents("php://input"));
$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$query = filter_input(INPUT_GET, "query", FILTER_DEFAULT);
$fileUrl = filter_input(INPUT_GET, "file", FILTER_DEFAULT);

$Link = new Link();

require(__DIR__ . '/' . $Link->getAPI());
