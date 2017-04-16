$(document).ready(function() {

	$('form #response').hide();

	$('#login').submit(function(e) {

		// prevent forms default action until
		// error check has been performed
		e.preventDefault();

		// grab form field values
		var valid = '';
		var required = ' é necessário.';
		var email = $('#email').val();
		var password = $('#password').val();
		var remember = $('#rememberMe').val();
		var honeypot = $('#honeypot').val();
		var humancheck = $('#humancheck').val();
		var urlReturn = $('#urlReturn').val();


		if ( !email.match(/^([a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,4}$)/i)) {
			valid += '<p>Seu email' + required +'</p>';
		}

		if( password == '' ){
			valid += '<p>Sua senha' + required + '</p>';
		}

		if( password.length < 6) {
			valid += '<p>A senha deve conter no miníno 6 caracteres.</p>';
		}

		if ( password.search( /\s/g ) != -1 ) {
			valid += '<p>Não é permitido espaço em branco na senha.</p>';
		}

		if ( honeypot != 'http://') {
			valid += '<p>Spambots não são permitidos.</p>';
		}

		if ( humancheck != '') {
			valid += '<p>Um usuário humano' + required + '</p>';
		}

		// let the user know if there are erros with the form
		if ( valid != '' ) {

			$('#response').removeClass().addClass('error')
				.html('<strong>Por favor, corrija os erros abaixo.</strong>' +valid).fadeIn('fast');
		}
		// let the user know something is happening behind the scenes
		// serialize the form data and send to our ajax function
		else {

			$('#response').removeClass().addClass('processing').html('Verificando aguarde...').fadeIn('fast');

			var formData = $('form').serialize();

			submitForm(formData);
		}

	});
});

// make our ajax request to the server
function submitForm(formData) {

	$.ajax({
		type: 'POST',
		url: '../includes/ajax/sendLogin.php',
		data: formData,
		dataType: 'json',
		cache: false,
		timeout: 7000,
		success: function(data) {

			$('#response').removeClass().addClass((data.error === true) ? 'error' : 'success')
						.html(data.msg).fadeIn('fast');

			if ($('#response').hasClass('success')) {

				setTimeout("$('#response').fadeOut('fast')", 5000);
			}

			if (data.error !== true) {
				window.location=data.url;
			} else {
				$('#password').val('');
			}

		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {

			$('#response').removeClass().addClass('error')
						.html('<p>Houve<strong> ' + errorThrown +
							  '</strong> erro devido a um<strong> ' + textStatus +
							  '</strong> condição.</p>').fadeIn('fast');
		},
		complete: function(XMLHttpRequest, status) {
			if (data.error !== true) {
				$('form')[0].reset();
			}
		}
	});
};