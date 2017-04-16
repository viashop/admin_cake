<?php

if ($this->request->controller == 'catalogo') {

	define('ELEMENT_DIR_CATALOGO', 'admin/css-javascript/catalogo/');

	switch ($this->request->action) {

		case 'categoriaCriar':
			echo $this->element(ELEMENT_DIR_CATALOGO .'categoria-criar');
			break;
		case 'categoriaEditar':
			echo $this->element(ELEMENT_DIR_CATALOGO .'categoria-editar');
			break;
		case 'categoriaListar':
			echo $this->element(ELEMENT_DIR_CATALOGO .'categoria-listar');
			break;
		case 'produtoCriar':
			echo $this->element(ELEMENT_DIR_CATALOGO .'produto-criar');
			break;
		case 'produtoEditar':
			echo $this->element(ELEMENT_DIR_CATALOGO .'produto-editar');
			break;
		case 'produtoListar':
			echo $this->element(ELEMENT_DIR_CATALOGO .'produto-listar');
			break;
		case 'produtoLixeira':
			echo $this->element(ELEMENT_DIR_CATALOGO .'produto-lixeira');
			break;
	}

}
