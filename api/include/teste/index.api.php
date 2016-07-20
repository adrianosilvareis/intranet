<?php

$dados = $_SESSION['testeDados'];

switch ($method) {
    case "GET":
        echo json_encode($dados);
        break;
    case "POST":

        echo json_encode("POST");
        break;
    case "DELETE":
        //deleta arquivo
        echo json_encode("DELETA");
        break;

    default:
        break;
}