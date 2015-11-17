<?php

// recebe as Variaveis
$nome     = $_POST["nome"];

// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
include("\biblioteca\class.phpmailer.php");
include("\biblioteca\class.smtp.php");

// Inicia a classe PHPMailer
$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPDebug  = 1;


// Define os dados do servidor e tipo de conexão
$mail->IsSMTP();
$mail->Host     = "mail.ita.locaweb.com.br";     // Endereço do servidor SMTP
$mail->SMTPAuth = true;                   // Usa autenticação SMTP? (opcional)
$mail->Username = 'cpd@tommasi.com.br';  // Usuário do servidor SMTP       
$mail->Password = 'F5t0mm@s1';               // Senha do servidor SMTP
$mail->Port =587;

// Define o remetente.
$mail->From     = "cpd@tommasi.com.br"; // Seu e-mail
$mail->FromName = "Davi";       // Seu nome

// Define os destinatário(s)
$mail->AddAddress($email, $nome);
$mail->AddCC('$email', 'Eu'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta

// Define os dados técnicos da Mensagem
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML

// Define a mensagem (Texto e Assunto)
$mail->Subject = "Foi aberta uma nova Solicitacao de Exame"; // Assunto da mensagem
$mail->Body    = "Alguem fez uma nova Solicitcao. Favor Verificar o FastExam";

// Envia o e-mail
$enviado = $mail->Send();

// Exibe uma mensagem de resultado
if ($enviado) {
	print "<script> alert('Solicitação Enviada ao CPD, verifique sua Copia em sua caixa de E-mail.'); </SCRIPT>\n";
} else {
 	print "<script> alert('A Solicitação não foi enviada, ouve algum problema .'); </SCRIPT>\n";
}

?>
