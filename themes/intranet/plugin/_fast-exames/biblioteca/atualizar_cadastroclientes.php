<?php
session_start();
include 'conn.php';

$id = intval($_REQUEST['id']);
$nome = $_REQUEST['nome'];
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
$valor= $_REQUEST['valor'];
$coleta = $_REQUEST['coleta'];
$encaminha = $_REQUEST['encaminha'];
$uso = $_REQUEST['uso'];
$zem = $_REQUEST['zem'];
if(empty($_REQUEST['ospt'])) {
   $status = "Em Analise";
} else {
  $ospt=$_REQUEST['ospt'];
  $status = "Concluido";
}
$assinado = $_SESSION['username'];
date_default_timezone_set('America/Sao_Paulo');
$dataf = date('d-m-Y');
$dataf .= ' às '.date('H:i');



$sql = "update cadastroclientes set nome='$nome',email='$email',setor='$setor',exame='$exame',sinonimia='$sinonimia',unidade='$unidade',valoref='$valoref',metodologia='$metodologia',prazo='$prazo',apoio='$apoio', material='$material',jejum='$jejum',valor='$valor',coleta='$coleta',encaminha='$encaminha',uso='$uso',zem='$zem',status='$status' ,ospt='$ospt', assinado='$assinado', dataf='$dataf' where id=$id";
$result = @mysql_query($sql);

if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Erro ao atualizar dados.'));
}
?>