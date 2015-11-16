<?php
session_start();
$nome = $_SESSION['username'];
$email = $_REQUEST['email'];
$setor = $_REQUEST['setor'];
$exame = $_REQUEST['exame'];
$sinonimia = $_REQUEST['sinonimia'];
$unidade = $_REQUEST['unidade'];
$valoref = $_REQUEST['valoref'];
$metodologia = $_REQUEST['metodologia'];
$prazo = $_REQUEST['prazo'];
$apoio = $_REQUEST['apoio'];
$material = $_REQUEST['material'];
$jejum = $_REQUEST['jejum'];
$valor = $_REQUEST['valor'];
$coleta = $_REQUEST['coleta'];
$encaminha = $_REQUEST['encaminha'];
$uso = $_REQUEST['uso'];
$zem = $_REQUEST['zem'];
$status = "Em Analise";
date_default_timezone_set('America/Sao_Paulo');
$data = date('d-m-Y');
$data .= ' às '.date('H:i');


include 'conn.php';

$sql = "insert into cadastroclientes(nome,email,setor,exame,sinonimia,unidade,valoref,metodologia,prazo,apoio,material,jejum,valor,coleta,encaminha,uso,zem,status,data) values('$nome','$email','$setor','$exame','$sinonimia','$unidade','$valoref','$metodologia','$prazo','$apoio','$material','$jejum','$valor','$coleta','$encaminha','$uso','$zem','$status','$data')";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao inserir dados.'));
}
?>