<?php

require '_app/Library/PHPMailer/class.phpmailer.php';
require '_app/Library/PHPMailer/class.smtp.php';

/**
 * Email.class.php [MODEL]
 * Modelo responsavel por confiugar a PHPMAILER e disparar e-mail do nosso sistema
 * 
 * @copyright (c) 2015, Adriano S. Reis Programador
 */
class Email {

    /** @var PHPMailer */
    private $Mail;

    /** EMAIL DATA */
    private $Data;

    /** CORPOD O E-MAIL */
    private $Assunto;
    private $Mensagem;

    /** REMETENTE */
    private $RemetenteNome;
    private $RemetenteEmail;

    /** DESTINO */
    private $DestinoNome;
    private $DestinoEmail;

    /** CONTROLE */
    private $Error;
    private $Result;

    function __construct() {
        $this->Mail = new PHPMailer;
        $this->Mail->Host = MAILHOST;
        $this->Mail->Port = MAILPORT;
        $this->Mail->Username = MAILUSER;
        $this->Mail->Password = MAILPASS;
        $this->Mail->CharSet = 'UTF-8';
    }

    public function Enviar(array $Data) {
        $this->Data = $Data;
        $this->Clear();

        $nome = $this->Data['RemetenteNome'];
        unset($this->Data['RemetenteNome']);
        
        if (in_array('', $this->Data)):
            $this->Error = ['Erro ao enviar mensagem: Para enviar esse e-mail. Preencha os campos requisitados!', WS_ALERT];
            $this->Result = false;
        elseif (!Check::Email($this->Data['RemetenteEmail'])):
            $this->Error = ['Erro ao enviar mensagem: O e-mail que você informou não tem um formato válido. Informe seu e-mail!!', WS_ALERT];
            $this->Result = false;
        else:
            $this->Data['RemetenteNome'] = $nome;
            $this->setMail();
            $this->Config();
            $this->sendMail();
        endif;
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    private function Clear() {
        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);
    }

    private function setMail() {
        $this->Assunto = $this->Data['Assunto'];
        $this->Mensagem = $this->Data['Mensagem'];
        $this->RemetenteNome = $this->Data['RemetenteNome'];
        $this->RemetenteEmail = $this->Data['RemetenteEmail'];
        $this->DestinoNome = $this->Data['DestinoNome'];
        $this->DestinoEmail = $this->Data['DestinoEmail'];
        $this->Data = NULL;
        $this->setMsg();
    }

    private function setMsg() {
        $this->Mensagem = "{$this->Mensagem} <hr><small>Recebida em " . date("d/m/Y H:m:s") . "</small>";
    }

    private function Config() {
        //SMTP AUTH
        $this->Mail->isSMTP();
        $this->Mail->SMTPAuth = true;
        $this->Mail->SMTPSecure = "tls";
        $this->Mail->isHTML();

        //REMETENTE E RETORNO
        $this->Mail->From = $this->DestinoEmail;
        $this->Mail->FromName = $this->RemetenteNome;
        $this->Mail->addReplyTo($this->RemetenteEmail, $this->RemetenteNome);

        //ASSUNTO, MENSAGEM E DESTINO
        $this->Mail->Subject = $this->Assunto;
        $this->Mail->Body = $this->Mensagem;
        $this->Mail->addAddress($this->DestinoEmail, $this->DestinoNome);
    }

    private function sendMail() {
        if ($this->Mail->send()):
            $this->Error = ['Obrigado por entrar em contato: Recebemos sua mensagem e estaremos respondendo em breve!', WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Erro ao enviar: Entre em contato com o admin. ( {$this->Mail->ErrorInfo} )", WS_ERROR];
            $this->Result = false;
        endif;
    }

}
