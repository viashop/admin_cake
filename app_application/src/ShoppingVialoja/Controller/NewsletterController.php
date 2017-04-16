<?php

App::uses('AppController', 'Controller');

class NewsletterController extends AppController {

	public $uses = array('Newsletter');
	public $layout = false;

	public function insert() {

		$this->render(false);

		if ($this->request->is('post')) {

			$datasource = $this->Newsletter->getDataSource();

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

				if (!Validate::isSha1(Tools::getValue('token'))) {

					throw new Exception(ERROR_PROCESS, E_USER_NOTICE);

				} else {

					if (!Validate::isEmail(Tools::getValue('email'))) {

						$msg = 'Endereço de e-mail inválido.';

						$session_news['status'] = '1';
						$session_news['msg'] = $msg ;
						$this->Session->write('session_news', $session_news);

						throw new Exception($msg , 1);

					}

					$conditions = array(
                        'conditions' => array(
                            'Newsletter.email' => Tools::getValue('email')
                        )
                    );

					if ($this->Newsletter->find('count', $conditions) > 0) {

						$msg = 'Endereço de e-mail já registrado.';

						$session_news['status'] = '2';
						$session_news['msg'] = $msg;
						$this->Session->write('session_news', $session_news);

						throw new Exception($msg, 1);

					} else {

						$msg = 'Inscrição efetuada com sucesso.';

						$session_news['status'] = '3';
						$session_news['msg'] = $msg;
						$this->Session->write('session_news', $session_news);

						$this->Session->setFlash(__($msg), 'alert-newsletter', array('class'=>'alert-success'));

						$this->data = array(
                            'email' => Tools::getValue('email')
                        );

                        $this->Newsletter->saveAll($this->data);

					}

				}

				$datasource->commit();

			} catch (PDOException $e) {

				$datasource->rollback();
				$this->Session->setFlash(__(ERROR_PROCESS), 'alert-newsletter', array('class'=>'alert-danger'));

			} catch (Exception $e) {

				$this->Session->setFlash(__($e->getMessage()), 'alert-newsletter', array('class'=>'alert-danger'));

			} finally {

				return $this->redirect( $this->request->referer() );

			}

		}

	}

}
