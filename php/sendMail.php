<?php
//Inclusão da biblioteca do Recaptcha.
include("recaptchalib.php");

//Coloque aqui as suas chaves privada do Recaptcha.
$privatekey = "insira aqui a sua chave privada Recaptcha";

$resp = null;
$error = null;
//Seta o endereço IP do usuário.
$ip = $_SERVER["REMOTE_ADDR"];

//chamada da função do Recaptcha com os dados da chave privada, IP, desafio e resposta do desafio.
$resp = recaptcha_check_answer ($privatekey, $ip, $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

//Se o desafio de capcha for válido, executará o código abaixo.
if ($resp->is_valid) {

	 //Importação da classe phpmailer disponibilizada pela Locaweb.
	require_once('class.phpmailer.php');	

	//Definição das variáveis vindas por post.
	$nome = $_POST['nome'];
	$assunto = $_POST['assunto'];
	$email = $_POST['email'];
	$mensagem = $_POST['mensagem'];	 

	//Configuração das variáveis do PHPMailer.
	$mailer = new PHPMailer();
	$mailer->IsSMTP();
	$mailer->SMTPDebug = 1;
	$mailer->Port = 587; 
	$mailer->Host = 'localhost'; 

	//Configuração do cabeçalho do e-mail.
	$subject = "Teste de Contato do Site";   
	$mailheaders = "From: \"$nome\" <$email> \n";
	$mailheaders .= "Reply-To: <$email>\n\n";

	//Definição da Mensagem que irá no corpo do e-mail.
	$msg = "Nome:   $nome\n";
	$msg .= "Assunto: $assunto\n";
	$msg .= "IP: $ip\n";
	$msg .= "Email: $email\n";
	$msg .= "Mensagem: $mensagem\n\n";

	//E-mail cujo qual será o de destino do formulário.
	$sendMail = "insira aqui um e-mail de destino do formulário";

	//Configuração da atutenticação do envio do e-mail por conta autenticada com login e senha.
	$mailer->SMTPAuth = true;
	$mailer->Username = 'insira aqui um e-mail que deverá autenticar o envio';
	$mailer->Password = 'insira aqui a senha do e-mail que deverá autenticar o envio';

	//Montagem do cabeçalho e corpo do e-mail.
	$mailer->FromName = $nome;
	$mailer->From = $email;
	$mailer->AddAddress($sendMail);
	$mailer->Subject = $subject;
	$mailer->Body = $msg;
	
	//Função para o envio do e-mail.
	if(!$mailer->Send()) {
		//Caso enviar o e-mail, cairá nesse bloco.
		echo ("enviou e-mail");
	}

} 
else {
	//Caso houver erro no capchat, informará aqui.
  	$error = $resp->error;
  	echo ($error);
}

?>          