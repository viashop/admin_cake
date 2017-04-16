<?php

class PedidoController extends AppController {

	public function index() {

	}

	public function listar() {

	}

	public function detalhar() {

	}

	public function imprimir() {

		$this->set('title_for_layout', 'Impressão pedido #1 Vialoja');
		$this->layout = 'print_pedido';

	}

}
