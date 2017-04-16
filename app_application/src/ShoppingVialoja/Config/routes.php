<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	//Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	
	/*
	Router::connect(
		'/', array('controller' => 'default', 'action' => 'index')
	);
*/

	Router::parseExtensions();

	App::uses('Tools','Lib');

	Router::connect(
		'/', array('controller' => 'default', 'action' => 'index')
	);

	$params = RouterUri::getUri();
	$controller = isset($params[1] ) ? trim( $params[1] ) : null;


	if (Validate::isGoogleVerification($controller)) {
		define('GOOGLE_SITE_VERIFICATION', 1);
	}

	if (defined('GOOGLE_SITE_VERIFICATION')) {

		Router::connect('/*',
			array(
				'controller' => 'google',
				'action'     => 'siteVerification'
			)
		);

	} elseif( isset( $controller ) && (bool)preg_match('#mapa-do-site#', $controller) === true ) {
		
		Router::connect('/'. $controller .'/*',
			array(
				'controller' => 'mapa_site',
				'action'     => 'index'
			)
		);

	} elseif( isset( $controller ) && (bool)preg_match('#nossas-lojas#', $controller) === true ) {

		Router::connect('/'. $controller .'/*',
			array(
				'controller' => 'nossas_lojas',
				'action'     => 'index'
			)
		);

	} elseif( isset( $controller ) && (bool)preg_match('#fale-conosco#', $controller) === true ) {	

		Router::connect('/'. $controller .'/*',
			array(
				'controller' => 'fale_conosco',
				'action'     => 'index'
			)
		);

	} elseif( isset( $controller ) && (bool)preg_match('#confirmar-email#', $controller) === true ) {

		Router::connect('/'. $controller .'/*',
			array(
				'controller' => 'confirmar_email',
				'action'     => 'index'
			)
		);

	} elseif( isset( $controller ) && (bool)preg_match('#minha-conta#', $controller) === true ) {

		if (!isset($params[2])) {
			$action = 'index';
		} else {
			$action = $params[2];
		}

		Router::connect('/minha-conta/*', array('controller' => 'minha_conta', 'action' => $action));

	} elseif( isset( $controller ) && $controller == 's' ) {

		Router::connect('/s/*', array('controller' => 'search', 'action' => 'index'));

	} elseif( isset( $controller ) && $controller == 'c' ) {

		Router::connect('/c/*', array('controller' => 'categoria', 'action' => 'index'));

	} elseif( isset( $controller ) && $controller == 'p' ) {

		Router::connect('/p/*', array('controller' => 'produto', 'action' => 'visualizar'));

	} elseif( isset( $controller ) && $controller == 'cliente' ) {

		define('CUSTOMER_SHOP_LOJA', true);
		
		if (isset($params[3])) {					
			
			Router::connect('/'. $controller .'/*',
				array(
					'controller' => $controller,
					'action'     => str_replace("-", "_", $params[3] )
				)
			);

		} else {

			Router::connect('/'. $controller .'/*',
				array(
						'controller' => $controller,
						'action'     => str_replace("-", "_", $params[2] )
				)
			);

		}

	} elseif( isset( $controller ) && $controller == 'produto_frame' ) {

		Router::connect('/produto_frame/*', array('controller' => 'produto_frame', 'action' => 'index'));

	} elseif( isset( $controller ) && $controller == '404-loja-nao-encontrada' ) {

		Router::connect('/404-loja-nao-encontrada/*', array('controller' => 'loja_nao_encontrada_404', 'action' => 'index'));

	} 

	
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';