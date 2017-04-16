$(document).ready(function() {
	
	$('#id_mostrar_parcelamento').change(function(event) {
		$('#parcelamento').stop().slideToggle();
		$('.control-group.maximo_parcelas, .control-group.parcelas_sem_juros').stop().slideToggle();
		$('#configuracao-parcelamento').stop().slideToggle();
		$('.alert-gateway').stop().slideToggle();
	});

	


	$('[data-toggle=popover]').popover({'trigger': 'hover'});


	var parcelas = [];
	for (i = 0; i < $('#id_maximo_parcelas option').length; i++) {
		parcelas[i] = parseInt($('#id_maximo_parcelas option')[i].value);
	}


	$('#id_maximo_parcelas').change( function (event) {
		var parcela_selecionada    = parseInt($('#id_maximo_parcelas').val());

		// Desativa parcelas do parcelas_sem_juros baseado no numero maximo de parcela.
		$('#id_parcelas_sem_juros option').removeAttr('disabled');
		for (i = 1; i <= parcelas.length; i++) {
			if (parcela_selecionada != 0 && parcela_selecionada != parseInt(parcelas[parcelas.length -1])) {
				$('#id_parcelas_sem_juros option')[0].setAttribute('disabled', 'disabled');
				$('#id_parcelas_sem_juros option[value="' + parcela_selecionada + '"]').attr('selected', 'true');
			}
			if (parcela_selecionada > 0 && parcela_selecionada < parcelas[i]) {
				$('#id_parcelas_sem_juros option')[i].setAttribute('disabled', 'disabled');
			}
		}

		renovar_simulacao('maximo');
	});


	$('#id_parcelas_sem_juros').change( function (event) {
		renovar_simulacao('sem_juros');
	});


	// Esconde ou mostra as parcelas no simulacao de parcelamento.
	function renovar_simulacao(quem_chama) {
		$('#parcelas .parcela, #parcelas .parcela-sem-juros').hide();

		var parcela_selecionada    = parseInt($('#id_maximo_parcelas').val()),
			parcela_sj_selecionada = parseInt($('#id_parcelas_sem_juros').val());

		for (i = 1; i <= parcelas.length; i++) {
			if (parcela_selecionada == 0) {
				if (quem_chama == 'maximo') {
					$('#parcelas .parcela-sem-juros').hide();
					$('#parcelas .parcela').show();
				} else {
					$('#parcelas .parcela').show();
					var tmp_length = $('#parcelas .parcela-sem-juros:visible').length;
					for (j = 1; j <= tmp_length; j++) {
						$('#parcelas .parcela.p-' + j).hide();
					}
				}
			}
			else if (parcela_selecionada >= parcelas[i]) {
				$('#parcelas .parcela.p-' + parcelas[i]).show();
				$('#parcelas .parcela-sem-juros.p-' + parcelas[i]).hide();
			}

			if (parcela_sj_selecionada == 0) {
				$('#parcelas .parcela-sem-juros').show();
				$('#parcelas .parcela').hide();
			}
			else if (parcela_sj_selecionada >= parcelas[i] ) {
				$('#parcelas .parcela.p-' + parcelas[i]).hide();
				$('#parcelas .parcela-sem-juros.p-' + parcelas[i]).show();
			}
		}
	}
	renovar_simulacao();

	/*
	$('#formPagamentoEditar').submit(function() {
		if($('#id_li_msg').length && !$('#id_li_msg').is(':checked') && $('#id_ativo').val() != 'False') {
			$('#modal-error .error-text').html('Você precisa confirmar que leu e seguiu os passos.');
			jQuery.removeLoader();
			$('#modal-error').modal('show');
			return false;
		}
		if($('#li_msg').length && !$('#li_msg').is(':checked')) {
			$('.aviso-li-msg').remove();
			$('#mainContent').prepend('<div class="alert alert-error aviso-li-msg"><a class="close" data-dismiss="alert">×</a> <h4>Você precisa confirmar a leitura dos passos.</h4></div>');
			return false;
		}

	});
	
	$('#id_ativo').change(function() {
		var self = $(this);
		if (self.val() == 'True') {
			$('#forma-pagamento-corpo').slideDown();
		} else {
			$('#forma-pagamento-corpo').slideUp();
		}
	}).change();
	*/
	
});