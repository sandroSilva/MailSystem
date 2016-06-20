
$(document).ready(function() {

    $("#btnEnviar").click(function() {
        validForm();
       return false;
    });

});


function validForm() {
	//Validação do formulário de contato.
	if ($('#txtNome').val() == "") {
		alert("Digite seu nome!");
		$('#txtNome').focus();
		return false;
	}

	if ($('#txtEmail').val() == "") {
		alert("Digite seu e-mail!");
		$('#txtEmail').focus();
		return false;
	}
		
	if ($('#txtAssunto').val() == "") {
		alert("Digite um assunto!");
		$('#txtAssunto').focus();
		return false;
	}

	if ($('#txtMensagem').val() == ""){
		alert("Digite uma mensagem!");
		$('#txtMensagem').focus();
		return false;
	}		

	var dataString = "nome="+$("#txtNome").val()+"&email="+$("#txtEmail").val()+"&assunto="+$("#txtAssunto").val()+"&mensagem="+$("#txtMensagem").val()+"&recaptcha_response_field="+$("#recaptcha_response_field").val()+"&recaptcha_challenge_field="+$("#recaptcha_challenge_field").val();
	sendPhp(dataString);
}

function sendPhp(sendPost) {
	//Envio dos dados de formulário para o SendMail em PHP.
	try {  
		$.ajax({
			type: "POST",
			url: "php/sendMail.php",
			data: sendPost,
			enctype: 'multipart/form-data',
			success: function(data, jqXHR, textStatus, errorThrown) {
				alert("E-mail enviado!");
				cleanForm();
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
       	return false;
    } catch (error) {
        alert("Erro ao enviar o e-mail!");
    }

}

function cleanForm() {
	//Limpeza do campos de formulário e atualização da imagem de desafio.
	$("#txtNome").val("");
	$("#txtEmail").val("");
	$("#txtAssunto").val("");
	$("#txtMensagem").val("");
	$("#recaptcha_response_field").val("");
	Recaptcha.reload();
}