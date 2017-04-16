<?php


class ContatoController extends AppController {

	public function ajaxContatoViaLoja() {

		sleep(2);

		$this->set("mensagem","Mensagem enviada com sucesso!");	

	}

}