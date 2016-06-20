<?php
//Inclus�o da biblioteca do Recaptcha.
include("recaptchalib.php");

//Coloque aqui as suas chaves privada do Recaptcha.
$privatekey = "insira aqui a sua chave privada Recaptcha";

$resp = null;
$error = null;
//Seta o endere�o IP do usu�rio.
$ip = $_SERVER["REMOTE_ADDR"];

//chamada da fun��o do Recaptcha com os dados da chave privada, IP, desafio e resposta do desafio.
$resp = recaptcha_check_answer ($privatekey, $ip, $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

//Se o desafio de capcha for v�lido, executar� o c�digo abaixo.
if ($resp->is_valid) {

	 //Importa��o da classe phpmailer disponibilizada pela Locaweb.
	require_once('class.phpmailer.php');	

	//Defini��o das vari�veis vindas por post.
	$nome = $_POST['nome'];
	$assunto = $_POST['assunto'];
	$email = $_POST['email'];
	$mensagem = $_POST['mensagem'];	 

	//Configura��o das vari�veis do PHPMailer.
	$mailer = new PHPMailer();
	$mailer->IsSMTP();
	$mailer->SMTPDebug = 1;
	$mailer->Port = 587; 
	$mailer->Host = 'localhost'; 

	//Configura��o do cabe�alho do e-mail.
	$subject = "Teste de Contato do Site";   
	$mailheaders = "From: \"$nome\" <$email> \n";
	$mailheaders .= "Reply-To: <$email>\n\n";

	//Defini��o da Mensagem que ir� no corpo do e-mail.
	$msg = "Nome:   $nome\n";
	$msg .= "Assunto: $assunto\n";
	$msg .= "IP: $ip\n";
	$msg .= "Email: $email\n";
	$msg .= "Mensagem: $mensagem\n\n";

	//E-mail cujo qual ser� o de destino do formul�rio.
	$sendMail = "insira aqui um e-mail de destino do formul�rio";

	//Configura��o da atutentica��o do envio do e-mail por conta autenticada com login e senha.
	$mailer->SMTPAuth = true;
	$mailer->Username = 'insira aqui um e-mail que dever� autenticar o envio';
	$mailer->Password = 'insira aqui a senha do e-mail que dever� autenticar o envio';

	//Montagem do cabe�alho e corpo do e-mail.
	$mailer->FromName = $nome;
	$mailer->From = $email;
	$mailer->AddAddress($sendMail);
	$mailer->Subject = $subject;
	$mailer->Body = $msg;
	
	//Fun��o para o envio do e-mail.
	if(!$mailer->Send()) {
		//Caso enviar o e-mail, cair� nesse bloco.
		echo ("enviou e-mail");
	}

} 
else {
	//Caso houver erro no capchat, informar� aqui.
  	$error = $resp->error;
  	echo ($error);
}

?>          