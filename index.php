<?
    //Coloque aqui as suas chaves pública do Recaptcha.
    $publickey = "insira aqui a sua chave pública Recaptcha";
?> 
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>

    <script language="JavaScript">
    //Configurações para a custumização do Recaptcha.
        var RecaptchaOptions = {
            theme: 'custom',
            lang: 'pt',
            custom_theme_widget: 'recaptcha_widget'
        };
    </script>

    <body>

		    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        	<div class="container">
          		<div class="navbar-header"><a class="navbar-brand" href="#">Send Mail</a></div>
        	</div>
      	</nav>

      	<div class="container formContainer">
      
        	<form>
          		<div class="form-group">
            		<label for="txtNome">Nome</label>
            		<input type="text" class="form-control" id="txtNome" placeholder="Nome">
          		</div>
          		<div class="form-group">
            		<label for="txtEmail">E-mail</label>
            		<input type="email" class="form-control" id="txtEmail" placeholder="E-mail">
          		</div>
          		<div class="form-group">
            		<label for="txtAssunto">Assunto</label>
            		<input type="text" class="form-control" id="txtAssunto" placeholder="Assunto">
          		</div>
          		<div class="form-group">
            		<label for="txtMensagem">Mensagem</label>
            		<textarea class="form-control" rows="3" id="txtMensagem" placeholder="Mensagem"></textarea>
          		</div>
        

              <!-- Bloco de informações do formulário do Recaptcha. -->
				      <div id="recaptcha_widget"  class="form-group">
                  <!-- Onde será o load da imagem do desafio. -->
                  <div id="recaptcha_image"></div>
                  <!-- Label e campo de input para enviar a resosta do desafio de captcha. -->
                  <label for="recaptcha_response_field">Digite a imagem acima:</label>
                  <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
                  <!-- Chama a função de dar um load na imagem do desafio. -->
                  <a href="javascript:Recaptcha.reload()">Trocar imagem</a>
                  <!-- Chamada da API do Recaptcha com a chave pública. -->
					        <script type="text/javascript" src="http://api.recaptcha.net/challenge?k=<?= $publickey ?>&lang=pt"></script>						
				      </div>    

          		<button type="submit" class="btn btn-default" id="btnEnviar">Enviar</button>
        	</form>
      </div>
 
      <script src="js/vendor/jquery-1.11.2.min.js"></script>
      <script src="js/vendor/bootstrap.min.js"></script>
      <script src="js/main.js"></script>

    </body>
</html>
