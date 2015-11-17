<?php

$username = $_REQUEST['username'];


include 'conn.php';

$sql = "insert into users(username) values('$username')";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao inserir dados.'));
}
?>