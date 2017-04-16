<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class NewsletterController extends AppController {

	public $uses = array('Newsletter');
	public $layout = false;

	private $conditions;
	private $datasource;
	private $data;
	private $msg;
	private $session_news = array();

	public function insert() {

		$this->render(false);

		if ($this->request->is('post')) {

			$this->datasource = $this->Newsletter->getDataSource();

			try {

				/**
				 * Anti Spam Boot
				 * Enviado via class hidden
				 */

				if (Tools::getValue('url_default') !='') {
					throw new Exception(ERROR_PROCESS, E_USER_NOTICE);
				}

				if (Tools::getValue('name') !='') {
					throw new Exception(ERROR_PROCESS, E_USER_NOTICE);
				}

				if (Tools::getValue('check') !='') {
					throw new Exception(ERROR_PROCESS, E_USER_NOTICE);
				}

				if (!Validate::isEmail(Tools::getValue('email'))) {

					throw new Exception(ERROR_PROCESS, E_USER_NOTICE);

				} else {

					if (!Validate::isEmail(Tools::getValue('email'))) {

						$this->msg = 'Endereço de e-mail inválido.';

						$this->session_news['status'] = '1';
						$this->session_news['msg'] = $this->msg;
						$this->Session->write('session_news', $this->session_news);

						throw new Exception($this->msg , 1);

					}

					$this->conditions = array(
                        'conditions' => array(
                            'Newsletter.email' => Tools::getValue('email'),
                            'Newsletter.id_shop_default' => Tools::getValue('id_shop_default')
                        )
                    );

					if ($this->Newsletter->find('count', $this->conditions) > 0) {

						$this->msg = 'Endereço de e-mail já registrado.';

						$this->session_news['status'] = '2';
						$this->session_news['msg'] = $this->msg;
						$this->Session->write('session_news', $this->session_news);

						throw new Exception($this->msg, 1);

					} else {

						$this->msg = 'Inscrição efetuada com sucesso.';

						$this->session_news['status'] = '3';
						$this->session_news['msg'] = $this->msg;
						$this->Session->write('session_news', $this->session_news);

						$this->Session->setFlash(__($this->msg), 'alert-box', array('class'=>'success-msg'));

						$this->data = array(
                            'email' => Tools::getValue('email'),
                            'id_shop_default' => Tools::getValue('id_shop_default')
                        );

                        $this->Newsletter->save($this->data);

						return $this->redirect( $this->request->referer() );

					}

				}

				$this->datasource->commit();

			} catch (PDOException $e) {

				$this->datasource->rollback();
				$this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array('class'=>'error-msg'));
				\Exception\VialojaDatabaseException::errorHandler($e);

	        } catch (Exception $e) {

				$this->Session->setFlash(__($e->getMessage()), 'alert-box', array('class'=>'error-msg'));

			} finally{

				return $this->redirect( $this->request->referer() );

			}

		}

	}

	public function unsubscribe() {

	}

}
