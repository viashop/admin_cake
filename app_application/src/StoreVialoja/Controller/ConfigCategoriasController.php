<?php

App::uses('AppController', 'Controller');

class ConfigCategoriasController extends AppController {

	public function actions()
	{

		$GLOBALS['option_categoria'] = $this->requestAction(array(
            'controller' => 'ShopCategoria',
            'action' => 'categoriaListaOption'
        ));

		$GLOBALS['lista_categorias_main_nav'] = $this->requestAction(array(
            'controller' => 'ShopCategoria',
            'action' => 'categoriaListaMainNav'
        ));

        $GLOBALS['lista_categorias_left'] = $this->requestAction(array(
            'controller' => 'ShopCategoria',
            'action' => 'categoriaListarLeft'
        ));

	}

}
