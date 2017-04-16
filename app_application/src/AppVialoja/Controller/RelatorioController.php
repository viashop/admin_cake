<?php

class RelatorioController extends AppController {


	public function relatorio() {

		$this->set('title_for_layout', 'Relatório disponíveis');

	}

	public function vendasPor_data() {

		$this->set('title_for_layout', 'Relatório por data');
		$this->layout = 'relatorio';

	}

	public function vendasPor_produto() {

		$this->set('title_for_layout', 'Relatório por produto');
		$this->layout = 'relatorio';

	}

}
