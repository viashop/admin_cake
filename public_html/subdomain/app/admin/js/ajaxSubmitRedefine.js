$(document).ready(function() {

	$('#password').pstrength();

	$('form #response').hide();

	/*
	setTimeout(function() {
		$('.alert').fadeOut('fast');}, 5000);
	*/

	$('#invitation').submit(function(e) {

		// prevent forms default action until
		// error check has been performed
		e.preventDefault();


		// grab form field values
		var valid      = '';
		var required   = ' é necessário.';
		var password   = $('#password').val();
		var confirme   = $('#confirme').val();
		var token      = $('#token').val();
		var honeypot   = $('#honeypot').val();
		var humancheck = $('#humancheck').val();

		// perform error checking
		if( password.length < 6){
			valid += '<p>Sua senha' + required + '</p>';
		}

		if ( password.search( /\s/g ) != -1 ) {
			valid += '<p>Não é permitido espaço em branco na senha.</p>';
		}

		if( password != confirme) {
			valid += '<p>As senhas não são iguais.</p>';

		}

		if ( honeypot != 'http://') {
			valid += '<p>Spambots não são permitidos.</p>';
		}

		if ( humancheck != '') {
			valid += '<p>Um usuário humano' + required + '</p>';
		}

		// let the user know if there are erros with the form
		if (valid != '') {

			$('#response').removeClass().addClass('error')
				.html('<strong>Por favor, corrija os erros abaixo.</strong>' +valid).fadeIn('fast');
		}
		// let the user know something is happening behind the scenes
		// serialize the form data and send to our ajax function
		else {

			$('#response').removeClass().addClass('processing').html('Processando...').fadeIn('fast');

			var formData = $('form').serialize();
			submitForm(formData);
		}

	});
});

// make our ajax request to the server
function submitForm(formData) {

	$.ajax({
		type: 'POST',
		url: '../includes/ajax/sendRedefinePassword.php',
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
				$('#confirme').val('');
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