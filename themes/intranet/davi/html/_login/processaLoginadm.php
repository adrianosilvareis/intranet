<?php
// começar ou retomar uma sessão
session_start();
 
// se vier um pedido para login
if (!empty($_POST)) {
 
	// estabelecer ligação com a base de dados
	mysql_connect('localhost', 'root', 'usbw') or die(mysql_error());
	mysql_select_db('exams');
 
	// receber o pedido de login com segurança
	$username = mysql_real_escape_string($_POST['username']);
	$password = sha1($_POST['password']);
 
	// verificar o utilizador em questão (pretendemos obter uma única linha de registos)
	$login = mysql_query("SELECT userid, username FROM usersadm WHERE username = '$username' AND password = '$password'");
 
	if ($login && mysql_num_rows($login) == 1) {
 
		// o utilizador está correctamente validado
		// guardamos as suas informações numa sessão
		$_SESSION['id'] = mysql_result($login, 0, 0);
		$_SESSION['username'] = mysql_result($login, 0, 1);
		
		 $redirect = "../../php/adm.php";
		 header("location:$redirect");
	} else {
 
		// falhou o login
		// Redirecionamento de Pagina + Alert
		echo("<script type='text/javascript'> alert('Senha ou Usuario Errado'); location.href='../../indexadm.html';</script>");
		
	}
}
?>