<?php

App::uses('AppController', 'Controller');

class DefaultController extends AppController {
	
	public function index() {
		
        self::commons_inc();

		define('INCLUDE_DEFAULT', true);
	}

    private function commons_inc()
    {
        $GLOBALS['ConfiguracaoAtividade']['res_atividades_option_all'] = $this->requestAction(array(
            'controller' => 'ConfiguracaoAtividade',
            'action' => 'optionAll'
        ));

        $GLOBALS['ConfiguracaoAtividade']['res_atividades_all'] = $this->requestAction(array(
            'controller' => 'ConfiguracaoAtividade',
            'action' => 'atividadeAll'
        ));


        $GLOBALS['BannerShopping']['res_managewidgets_footer_all'] = $this->requestAction(array(
            'controller' => 'BannerShopping',
            'action' => 'getBanner',
            'local_publicacao' => 'managewidgets-footer',
        ));

        $GLOBALS['BannerShopping']['res_managewidgets_left_all'] = $this->requestAction(array(
            'controller' => 'BannerShopping',
            'action' => 'getBanner',
            'local_publicacao' => 'managewidgets-left',
        ));

        /*
        $GLOBALS['BannerShopping']['res_sliderlayer_all'] = $this->requestAction(array(
            'controller' => 'BannerShopping',
            'action' => 'getBanner',
            'local_publicacao' => 'sliderlayer',
        ));*/

        $GLOBALS['BannerShopping']['res_sliderlayer_all'] = $this->requestAction(array(
            'controller' => 'BannerShopping',
            'action' => 'ul_slide',
            'local_publicacao' => 'sliderlayer',
        ));

        //ul_slide

    }

    public function error($value='')
    {
        
        self::commons_inc();
        define('INCLUDE_ERROR', true);

    }

	
}
