<?php

use Lib\Tools;
use Lib\Validate;
use Respect\Validation\Validator as v;
use CSRF\CSRFGuard;
use WideImage\WideImage;


class RecursoController extends AppController
{

    public $uses = array(
        'ClienteNewsletterShop',
        'RecursoFreteGratis',
        'ShopFreteGratis',
        'ShopCode',
        'ShopCupomDesconto',
        'ShopPagina',
        'ShopUrlUso',
        'ShopArquivo',
        'ShopProduto',
        'Comparador',
        'ShopComparadorXml',
        'ShopComparadorProduto',
        'BannerLocal',
        'BannerPosicao',
        'ShopBanner',
        'ShopDominio'
    );

	public $components = array('Paginator');

    private $ok;
    private $total;
    private $error = false;
    private $data;
    private $diretorio;
    private $diretorio_cdn;
    private $arquivo;
    private $formato;
    private $output;
    private $date;
    private $filetime;
    private $file;
    private $handle;
    private $res_news;
    private $news;
    private $pastas, $pasta;
	private $file_name, $file_temp, $file_type, $file_error, $file_name_browser;
	private $posicao = 0;
	private $posicoes;
	private $dados;
	private $original;
	private $img_name, $img_temp, $path_extension, $novo_nome, $path;
	private $pagina_publicacao, $pagina_titulo;
	private $js, $css, $pdf;
	private $tipo;
	private $small;
	private $token;
	private $url;
    private $busca;
	private $errorException = false;

    private $descricao;
    private $conteudo;
    private $id_code;
	private $json;
    private $nome;
    private $id_produto;
    private $preco_cheio;
    private $preco_promocional;
    private $situacao_em_estoque;
    private $gerenciado;
    private $quantidade;
    private $atributo = false;
    private $datasource;

    public function index() {



        return $this->redirect(array(
            'controller' => $this->request->controller,
            'action' => 'cupom',
            'listar'
        ));
    }

    public function paginaListar()
    {

        try {

            $conditions = array(
                'fields' => array(
                    'ShopPagina.id_pagina',
                    'ShopPagina.titulo',
                    'ShopPagina.url'
                ),
                'conditions' => array(
                    'ShopPagina.id_shop_default' => $this->Session->read('id_shop')
                ),
                'order' => array(
                    'ShopPagina.posicao' => 'ASC'
                ),
                'limit' => 25,
				'paramType' => 'querystring'
            );

            $this->paginate = $conditions;

            // Roda a consulta, já trazendo os resultados paginados
            $result = $this->paginate('ShopPagina');
            $this->set('res_pagina', $result);

            if ($this->Session->read('pagina_titulo')) {
                $this->set('flash_pagina_titulo', $this->Session->read('pagina_titulo'));
                $this->Session->delete('pagina_titulo');
            }

        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\RuntimeException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);

		}

        $this->set('title_for_layout', 'Listar páginas');


        $this->configCSRFGuard();

    }

    public function paginaCriar()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopPagina->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    /*
                     * Checa se os dados para ver se foram eviados
                     */

                    $this->error = false;
                    if (Tools::getValue('titulo') == '' && Tools::getValue('conteudo') == '') {

                        $this->error = true;
                        $this->set('error_titulo', true);
                        $this->set('error_conteudo', true);
                        throw new \NotFoundException("Informe o título e a descrição da página.", E_USER_WARNING);

                    }

                    if (Tools::getValue('titulo') == '') {

                        $this->error = true;
                        $this->set('error_titulo', true);
                        throw new \NotFoundException("Informe o título da página.", E_USER_WARNING);

                    }

                    if (Tools::getValue('conteudo') == '') {

                        $this->error = true;
                        $this->set('error_conteudo', true);
                        throw new \NotFoundException("Informe a descrição da página.", E_USER_WARNING);

                    }

                    /*
                     * Cadastra se no db, se não houver erros
                     */
                    if ($this->error !== true) {

                        /*
                         * Verifica se a página já existe
                         */

                        $conditions = array(

                            'conditions' => array(
                                'ShopPagina.url' => Tools::getValue('url'),
                                'ShopPagina.id_shop_default' => $this->Session->read('id_shop')
                            )

                        );

                        if ($this->ShopPagina->find('count', $conditions) > 0) {
                            throw new \Exception\VialojaOverflowException('Esta página já existe.', E_USER_WARNING);
                        }
                        /*
                         * Verifica a posição da página
                         */

                        $conditions = array(

                            'fields' => array(
                                'ShopPagina.posicao'
                            ),
                            'conditions' => array(
                                'ShopPagina.id_shop_default' => $this->Session->read('id_shop')
                            )

                        );

                        $this->posicao = 0;
                        if ($this->ShopPagina->find('count', $conditions) > 0) {

                            $this->posicao = $this->ShopPagina->find('first', $conditions);
                            $this->posicao = $this->posicao['ShopPagina']['posicao'] + 1;

                        }

                        $this->data = array(
                            'id_shop_default' => $this->Session->read('id_shop'),
                            'ativo' => Tools::getValue('ativo'),
                            'titulo' => Tools::clean(Tools::getValue('titulo')),
                            'url' => Tools::clean(Tools::getValue('url')),
                            'posicao' => $this->posicao,
                            'conteudo' => Tools::htmlentitiesUTF8(Tools::getValue('conteudo'))
                        );

                        $this->ok = $this->ShopPagina->saveAll($this->data);

                        if (is_bool($this->ok) && $this->ok === true) {

                            $this->setMsgAlertSuccess('Página criada com sucesso!');
                            return $this->redirect(array(
                                'controller' => $this->request->controller,
                                'action' => 'pagina',
                                'listar'
                            ));

                        } else {
                            throw new \RuntimeException();
                        }

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\NotFoundException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\Exception\VialojaOverflowException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError(ERROR_PROCESS);

            }

        } /** End POST **/


        $this->set('url_shop', self::getDominio());

        $this->set('title_for_layout', 'Criar página');


        $this->configCSRFGuard();

    }

    /*
     * Listar páginas de conteúdo
     * @access public
     * @param String id_shop
     * @param String $data
     */

    /**
     * getDadosDominio
     * return String
     */
    private function getDominio()
    {
        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }
        return $this->ShopDominio->getDominioPrincipal($this->Shop);
    }

    /*
     * Cria páginas de conteúdo
     * @access public
     * @param String id_shop
     * @param String $data
     */

    public function paginaRemover()
    {

        $this->datasource = $this->ShopPagina->getDataSource();

        try {

            $this->datasource->begin();

            if (!$this->request->is('post')) {
                throw new \InvalidArgumentException();
            }

            if (isset($this->request->data['confirmacao'])) {

                $this->ok = $this->ShopPagina->deleteAll(array(
                    'ShopPagina.id_shop_default' => $this->Session->read('id_shop'),
                    'ShopPagina.id_pagina' => $this->request->data['paginas']
                ));

                if (is_bool($this->ok) && $this->ok === true) {

                    return $this->redirect(array(
                        'controller' => $this->request->controller,
                        'action' => 'pagina',
                        'listar'
                    ));

                } else {
                    throw new \RuntimeException();
                }

            }

            /**
             *
             * Verifica o token CSRFGuard
             *
             **/

            $CSRFGuard = new CSRFGuard();

            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

            } else {

                $conditions = array(
                    'fields' => array(
                        'ShopPagina.id_pagina',
                        'ShopPagina.titulo'
                    ),
                    'conditions' => array(
                        'ShopPagina.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopPagina.id_pagina' => $this->request->data['paginas']
                    ),
                    'order' => array(
                        'ShopPagina.posicao' => 'ASC'
                    )
                );

                $result = $this->ShopPagina->find('all', $conditions);
                $this->set('res_pagina', $result);

                $this->pagina_titulo = array();
                foreach ($result as $this->key => $this->dados) {
                    array_push($this->pagina_titulo, $this->dados['ShopPagina']['titulo']);
                }

                $this->Session->write('pagina_titulo', $this->pagina_titulo);

            }

            $this->datasource->commit();

            $this->configCSRFGuard();

            $this->set('title_for_layout', 'Removendo página');


        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->setMsgAlertError(ERROR_PROCESS);
            $this->errorException = true;
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            $this->errorException = true;

        } finally {

            if ($this->errorException !== false) {

                return $this->redirect(array(
                    'controller' => $this->request->controller,
                    'action' => 'pagina',
                    'listar'
                ));

            }

        }

    }

    /*
     * Remover páginas de conteúdo
     * @access public
     * @param String id_shop id do Shopping
     * @param String id_pagina
     * @param String $data
     */

    public function paginaEditar()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopPagina->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    /*
                     * Checa se os dados para ver se foram eviados
                     */
                    $this->error = false;
                    if (Tools::getValue('titulo') == '' && Tools::getValue('conteudo') == '') {

                        $this->error = true;
                        $this->set('error_titulo', true);
                        $this->set('error_conteudo', true);
                        throw new \NotFoundException("Informe o título e a descrição da página.", E_USER_WARNING);

                    }

                    if (Tools::getValue('titulo') == '') {

                        $this->error = true;
                        $this->set('error_titulo', true);
                        throw new \NotFoundException("Informe o título da página.", E_USER_WARNING);

                    }

                    if (Tools::getValue('conteudo') == '') {

                        $this->error = true;
                        $this->set('error_conteudo', true);
                        throw new \NotFoundException("Informe a descrição da página.", E_USER_WARNING);

                    }

                    /*
                     * Cadastra se no db, se não houver erros
                     */
                    if ($this->error !== true) {

                        /*
                         * Verifica se a página já existe
                         */

                        $conditions = array(

                            'conditions' => array(
                                'ShopPagina.url' => Tools::getValue('url'),
                                'ShopPagina.id_pagina !=' => $this->request->params['pass']['2'],
                                'ShopPagina.id_shop_default' => $this->Session->read('id_shop')
                            )

                        );

                        if ($this->ShopPagina->find('count', $conditions) > 0) {
                            throw new \Exception\VialojaOverflowException('Esta página já existe.', E_USER_WARNING);
                        }

                        $fields = array(

                            'ShopPagina.ativo' => sprintf("'%s'", Tools::getValue('ativo')),
                            'ShopPagina.titulo' => sprintf("'%s'", Tools::clean(Tools::getValue('titulo'))),
                            'ShopPagina.url' => sprintf("'%s'", Tools::clean(Tools::getValue('url'))),
                            'ShopPagina.conteudo' => sprintf("'%s'", Tools::htmlentitiesUTF8(Tools::getValue('conteudo')))
                        );

                        $conditions = array(
                            'ShopPagina.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopPagina.id_pagina' => $this->request->params['pass']['2']
                        );

                        $this->ok = $this->ShopPagina->updateAll($fields, $conditions);

                        if (is_bool($this->ok) && $this->ok === true) {

                            $this->setMsgAlertSuccess('Página editada com sucesso!');

                            return $this->redirect(array(
                                'controller' => $this->request->controller,
                                'action' => 'pagina',
                                'listar'
                            ));

                        } else {

                            throw new \RuntimeException();

                        }

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\NotFoundException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\Exception\VialojaOverflowException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError(ERROR_PROCESS);
            }

        }

        try {

            $conditions = array(
                /*
                'fields' => array(
                'ShopPagina.url'
                ),*/
                'conditions' => array(
                    'ShopPagina.id_pagina' => $this->request->params['pass']['2'],
                    'ShopPagina.id_shop_default' => $this->Session->read('id_shop')
                )

            );

            if ($this->ShopPagina->find('count', $conditions) <= 0) {
                throw new \Exception\VialojaOverflowException('Esta página já existe.', E_USER_WARNING);
            }

            $this->set('res_pagina', $this->ShopPagina->find('all', $conditions));

        }
        catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\Exception\VialojaOverflowException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);

		}


        $this->set('url_shop', self::getDominio());
        $this->set('title_for_layout', 'Editar página');


        $this->configCSRFGuard();

    }

    public function paginaOrdenar()
    {

        try {

            if ($this->request->is('post')) {

                if (!$this->request->is('ajax')) {
                    return false;
                }

                if (Tools::getValue('posicoes') == '') {
                    throw new \NotFoundException("Posições não enviadadas", E_USER_WARNING);
                }

                $this->posicoes = Tools::clean(Tools::getValue('posicoes'));
                $this->posicao  = explode(',', $this->posicoes);

                $conditions = array(

                    'fields' => array(
                        'ShopPagina.id_pagina'
                    ),
                    'conditions' => array(
                        'ShopPagina.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopPagina.id_pagina' => $this->posicao

                    ),
                    'order' => array(
                        'FIELD(ShopPagina.id_pagina, ' . $this->posicoes . ') ASC'
                    )

                );

                $result = $this->ShopPagina->find('all', $conditions);

                foreach ($result AS $this->key => $this->dados) {

                    $this->ShopPagina->id = $this->dados['ShopPagina']['id_pagina'];
                    $this->ShopPagina->saveField("posicao", $this->key);

                }

                $this->json['estado']   = "SUCESSO";
                $this->json['mensagem'] = "As páginas foram ordenadas.";
                header('Content-Type: application/json');
                echo json_encode($this->json);
                $this->layout = false;
                $this->render(false);

                exit();

            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
            return false;
        } catch (\NotFoundException $e) {
            //echo $e->getMessage();
            return false;
        } catch (\RuntimeException $e) {
			return false;
		}

    }

    /*
     * Ordena a posição de página
     * @access public
     * @param Array $login
     * @param String $data
     */

    public function parceiros()
    {

        $this->set('title_for_layout', 'Parceiros');

    }

    public function bannerListar()
    {

        try {

            /**
            *
            * Get All dados de localização dos banners
            *
            **/
            $this->set('res_banner_posicao', $this->BannerPosicao->getAll());

            if ($this->Session->read('banner_nome')) {
                $this->set('flash_banner_nome', $this->Session->read('banner_nome'));
                $this->Session->delete('banner_nome');
            }

        } catch (\PDOException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\RuntimeException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);

		}

        $this->set('title_for_layout', 'Listar banners');


        $this->configCSRFGuard();

    }

    public function bannerOrdenar() {

        $this->layout = false;
        $this->render(false);

        try {

            if ($this->request->is('post')) {

                if (!$this->request->is('ajax')) {
                    return false;
                }

                if (Tools::getValue('posicoes') != '') {

                    $this->posicoes = Tools::getValue('posicoes');
                    $this->posicao  = explode(',', $this->posicoes);

                    foreach ($this->posicao AS $this->key => $id) {

                        $fields = array(
                            'ShopBanner.posicao' => sprintf("'%s'", $this->key),
                        );

                        $conditions = array(
                            'ShopBanner.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopBanner.id_banner' => $id
                        );

                        $this->ok = $this->ShopBanner->updateAll($fields, $conditions);

                    }

                    if (is_bool($this->ok) && $this->ok===true) {
                        $this->json['estado']   = "SUCESSO";
                        $this->json['mensagem'] = "Os banners foram ordenados com sucesso.";
                    } else {
                        $this->json['estado']   = "ERROR";
                        $this->json['mensagem'] = "Não foi possivel ordenar os banners.";
                    }

                }

            }

        } catch (\PDOException $e) {

            $this->json['estado']   = "ERROR";
            $this->json['mensagem'] = ERROR_PROCESS;
            \Exception\VialojaDatabaseException::errorHandler($e);

        } finally {

            header('Content-Type: application/json');
            echo stripslashes(json_encode($this->json));
            exit();

        }

    }

    public function bannerCriar()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopBanner->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    $this->error=false;
                    if (Tools::getValue('nome') == '') {
                        $this->error=true;
                        $this->set('error_nome', true);
                    }

                    $this->arquivo = isset($_FILES['caminho']) ? $_FILES['caminho'] : false;

                    if (empty($this->arquivo['name']) || empty($this->arquivo['tmp_name'])) {
                        $this->error=true;
                        $this->set('error_caminho', true);
                    }

                    if (!Validate::isMaxSize($this->arquivo['size'], 1)) {
                        $this->error=true;
                        $this->setMsgAlertError('Erro: O tamanho máximo do arquivo permito: 1 MB');
                    }

                    if (!Validate::isImage($this->arquivo)) {
                        $this->error=true;
                        $this->setMsgAlertError('Atenção!: Envie uma imagem válida. O arquivo enviado não é uma imagem ou está corrompido.');
                    }

                    if ($this->error !== true) {

                        $this->diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'banner' . DS;
                        /**
                         *
                         * Verifica se o diretorio existe or cria
                         *
                         **/
                        Tools::createFolder($this->diretorio);

                        $this->img_name = $this->arquivo['name'];
                        $this->img_temp = $this->arquivo['tmp_name'];

                        $this->path_extension = pathinfo($this->img_name, PATHINFO_EXTENSION);
                        $this->novo_nome      = explode('.' . $this->path_extension, $this->img_name);
                        $this->path = Validate::checkNameFile($this->img_name, $this->diretorio);

                        move_uploaded_file($this->img_temp, $this->diretorio . $this->path);

                        $conditions = array(

                            'fields' => array(
                                'MAX(ShopBanner.posicao) as max_posicao'
                            ),
                            'conditions' => array(
                                'local_publicacao' => Tools::clean(Tools::getValue('local_publicacao')),
                                'id_shop_default' => $this->Session->read('id_shop')
                            )

                        );

                        $this->posicao = 0;
                        if ($this->ShopBanner->find('count', $conditions) > 0) {
                            $this->posicao = $this->ShopBanner->find('first', $conditions);
                            $this->posicao = $this->posicao['0']['max_posicao'] + 1;
                        }

                        $this->data = array(

                            'id_shop_default' => $this->Session->read('id_shop'),
                            'ativo' => Tools::clean(Tools::getValue('ativo')),
                            'nome' => Tools::clean(Tools::getValue('nome')),
                            'caminho' => $this->path,
                            'local_publicacao' => Tools::clean(Tools::getValue('local_publicacao')),
                            'pagina_publicacao' => Tools::clean(Tools::getValue('pagina_publicacao')),
                            'link' => Tools::clean(Tools::getValue('link')),
                            'target' => Tools::clean(Tools::getValue('target')),
                            'titulo' => Tools::clean(Tools::getValue('titulo')),
                            'mapa_imagem' => Tools::htmlentitiesUTF8(Tools::getValue('mapa_imagem')),
                            'posicao' => $this->posicao
                        );

                        $this->ok = $this->ShopBanner->saveAll($this->data);

                        if (is_bool($this->ok) && $this->ok === true) {

                            $this->setMsgAlertSuccess('Banner criado com sucesso!');
                            return $this->redirect(array('controller' => $this->request->controller, 'action' => 'banner', 'listar'));

                        } else {

                            Tools::deleteFile($this->diretorio . $this->path);
                            throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);

                        }

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();

                if ( strpos($e->getMessage(), "banner_Unique") !==false ) {

                    $this->setMsgAlertError('Erro: O nome do banner está duplicado, tente outra vez.');
                    # code...
                } else {
                    $this->setMsgAlertError($e->getMessage());
                }

                $this->errorException = true;

			} catch (\InvalidArgumentException $e) {

				$this->setMsgAlertError($e->getMessage());
                $this->errorException = true;

			} catch (\RuntimeException $e) {

				$this->setMsgAlertError(ERROR_PROCESS);
                $this->errorException = true;

            } finally {

                if ($this->errorException !== false) {

				    return $this->redirect(array('controller' => $this->request->controller, 'action' => 'banner', 'listar'));

                }

            }

        }


		/**
		*
		* Get All dados de localização dos banners
		*
		**/
		$this->set('res_banner_local', $this->BannerLocal->getAll() );

		/**
		*
		* Get All dados de posição do banner
		*
		**/
		$res_banner_posicao = $this->BannerPosicao->getLocalPublicacao( $this->request->params['pass']['2'] );
		$this->set( compact('res_banner_posicao') );


        $this->set('title_for_layout', 'Criando banner');


        $this->configCSRFGuard();

    }

    public function bannerEditar()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopBanner->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    $this->error=false;
                    if (Tools::getValue('nome') == '') {
                        $this->error=true;
                        $this->set('error_nome', true);
                    }

                    $this->arquivo = isset($_FILES['caminho']) ? $_FILES['caminho'] : false;

                    if (!empty($this->arquivo['name']) || !empty($this->arquivo['tmp_name'])) {

                        if (!Validate::isMaxSize($this->arquivo['size'], 1)) {
                            $this->error=true;
                            $this->setMsgAlertError('Erro: O tamanho máximo do arquivo permito: 1 MB');
                        }

                        if (!Validate::isImage($this->arquivo)) {
                            $this->error=true;
                            $this->setMsgAlertError('Atenção!: Envie uma imagem válida. O arquivo enviado não é uma imagem ou está corrompido.');
                        }

                    }

                    if ($this->error !== true) {

                        if (!empty($this->arquivo['name']) || !empty($this->arquivo['tmp_name'])) {

                            /**
                            *
                            * GetId dados banner shop
                            *
                            **/
                            $result = $this->requestAction(array(
                                'controller' => 'ShopBanner',
                                'action' => 'getIdBanner',
                                'id' => $this->request->params['pass']['3']
                            ));

                            if (is_bool($result) && $result !== true ) {
                                $this->setMsgAlertError('Banner não encontrado.');
                                return $this->redirect(array('controller' => $this->request->controller, 'action' => 'banner', 'listar'));
                            }

                            $this->diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'banner' . DS;
                            /**
                             *
                             * Verifica se o diretorio existe or cria
                             *
                             **/
                            Tools::createFolder($this->diretorio);

                            $this->img_name = $this->arquivo['name'];
                            $this->img_temp = $this->arquivo['tmp_name'];

                            $this->path_extension = pathinfo($this->img_name, PATHINFO_EXTENSION);
                            $this->novo_nome      = explode('.' . $this->path_extension, $this->img_name);
                            $this->path = Validate::checkNameFile($this->img_name, $this->diretorio);

                            if (move_uploaded_file($this->img_temp, $this->diretorio . $this->path)) {

                                foreach ($result as $this->key => $this->dados) {
                                    Tools::deleteFile($this->diretorio . $this->dados['ShopBanner']['caminho']);
                                }

                            }

                            $fields = array(

                                'ShopBanner.ativo' => sprintf("'%s'", Tools::clean(Tools::getValue('ativo'))),
                                'ShopBanner.nome' => sprintf("'%s'", Tools::clean(Tools::getValue('nome'))),
                                'ShopBanner.caminho' => sprintf("'%s'", $this->path),
                                'ShopBanner.local_publicacao' => sprintf("'%s'", Tools::clean(Tools::getValue('local_publicacao'))),
                                'ShopBanner.pagina_publicacao' => sprintf("'%s'", Tools::clean(Tools::getValue('pagina_publicacao'))),
                                'ShopBanner.link' => sprintf("'%s'", Tools::clean(Tools::getValue('link'))),
                                'ShopBanner.target' => sprintf("'%s'", Tools::clean(Tools::getValue('target'))),
                                'ShopBanner.titulo' => sprintf("'%s'", Tools::clean(Tools::getValue('titulo'))),
                                'ShopBanner.mapa_imagem' => sprintf("'%s'", Tools::htmlentitiesUTF8(Tools::getValue('mapa_imagem'))),

                            );


                        } else {

                            $fields = array(

                                'ShopBanner.ativo' => sprintf("'%s'", Tools::clean(Tools::getValue('ativo'))),
                                'ShopBanner.nome' => sprintf("'%s'", Tools::clean(Tools::getValue('nome'))),
                                'ShopBanner.local_publicacao' => sprintf("'%s'", Tools::clean(Tools::getValue('local_publicacao'))),
                                'ShopBanner.pagina_publicacao' => sprintf("'%s'", Tools::clean(Tools::getValue('pagina_publicacao'))),
                                'ShopBanner.link' => sprintf("'%s'", Tools::clean(Tools::getValue('link'))),
                                'ShopBanner.target' => sprintf("'%s'", Tools::clean(Tools::getValue('target'))),
                                'ShopBanner.titulo' => sprintf("'%s'", Tools::clean(Tools::getValue('titulo'))),
                                'ShopBanner.mapa_imagem' => sprintf("'%s'", Tools::htmlentitiesUTF8(Tools::getValue('mapa_imagem'))),

                            );

                        }

                        $conditions = array(
                            'ShopBanner.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopBanner.id_banner' => $this->request->params['pass']['3']
                        );


                        $this->ok = $this->ShopBanner->updateAll($fields, $conditions);

                        if (is_bool($this->ok) && $this->ok === true) {

                            $this->setMsgAlertSuccess('Banner editado com sucesso!');
                            return $this->redirect(array('controller' => $this->request->controller, 'action' => 'banner', 'listar'));

                        } else {

                            Tools::deleteFile($this->diretorio . $this->path);
                            throw new \RuntimeException();

                        }

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();

                $this->setMsgAlertError($e->getMessage());
                $this->errorException = true;

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());
                $this->errorException = true;

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError(ERROR_PROCESS);
                $this->errorException = true;

            } finally {

                if ($this->errorException !== false) {

                    return $this->redirect(array('controller' => $this->request->controller, 'action' => 'banner', 'listar'));

                }

            }

        }

		/**
		*
		* Get All dados de localização dos banners
		*
		**/
		$this->set('res_banner_local', $this->BannerLocal->getAll() );

		/**
		*
		* Get All dados de posição do banner
		*
		**/

		$res_banner_posicao = $this->BannerPosicao->getLocalPublicacao( $this->request->params['pass']['2'] );
		$this->set( compact('res_banner_posicao') );

		/**
		*
		* GetId dados banner shop
		*
		**/
		$result = $this->requestAction(array(
			'controller' => 'ShopBanner',
			'action' => 'getIdBanner',
			'id' => $this->request->params['pass']['3']
		));

		if (is_bool($result) && $result !== true ) {

			$this->setMsgAlertError('Banner não encontrado.');
			return $this->redirect(array('controller' => $this->request->controller, 'action' => 'banner', 'listar'));

		}

		$this->set('res_banner_shop', $result);


        $this->set('title_for_layout', 'Editando banner');


        $this->configCSRFGuard();

    }

    public function bannerRemover()
    {

        if (!$this->request->is('post')) {

            $this->setMsgAlertError(ERROR_PROCESS);

            return $this->redirect(array(
                'controller' => $this->request->controller,
                'action' => 'banner',
                'listar'
            ));

        }

        $this->datasource = $this->ShopBanner->getDataSource();

		try {

            $this->datasource->begin();

			/**
			 *
			 * Verifica o token CSRFGuard
			 *
			 **/

			$CSRFGuard = new CSRFGuard();

            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

				throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

			} else {

				if (!isset($this->request->data['banners']) || empty($this->request->data['banners'])) {
					throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
				}

				$conditions = array(
					'fields' => array(
						'ShopBanner.id_banner',
						'ShopBanner.nome'
					),
					'conditions' => array(
						'ShopBanner.id_shop_default' => $this->Session->read('id_shop'),
						'ShopBanner.id_banner' => $this->request->data['banners']
					),
					'order' => array(
						'ShopBanner.nome' => 'ASC'
					)
				);

				$res_banner = $this->ShopBanner->find('all', $conditions);

				$this->set('res_banner', $res_banner);

				if (isset($this->request->data['confirmacao'])) {

					$banners = array();
					foreach ($res_banner as $this->key => $banner) {
						array_push($banners, $banner['ShopBanner']['nome']);
					}

					$this->Session->write('banner_nome', $banners);

				}

			}

            $this->datasource->commit();

		} catch (\PDOException $e) {

            $this->datasource->rollback();

			$this->setMsgAlertError(ERROR_PROCESS);
            $this->errorException = true;

		} catch (\NotFoundException $e) {

			$this->setMsgAlertError($e->getMessage());
            $this->errorException = true;

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError($e->getMessage());
            $this->errorException = true;

		} catch (\RuntimeException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);
            $this->errorException = true;

		} finally {

            if ($this->errorException !== false) {

                return $this->redirect(array(
                    'controller' => $this->request->controller,
                    'action' => 'banner',
                    'listar'
                ));

            }

        }

		if (isset($this->request->data['confirmacao'])) {

			$this->diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'banner' . DS;

			$conditions = array(
				'conditions' => array(
					'ShopBanner.id_shop_default' => $this->Session->read('id_shop'),
					'ShopBanner.id_banner' => $this->request->data['banners']
				)
			);

			$del_banner = $this->ShopBanner->find('all', $conditions);
			foreach ($del_banner as $this->key => $banner) {
                Tools::deleteFile($this->diretorio . $banner['ShopBanner']['caminho']);
			}

			$this->ok = $this->ShopBanner->deleteAll(array(
				'ShopBanner.id_shop_default' => $this->Session->read('id_shop'),
				'ShopBanner.id_banner' => $this->request->data['banners']
			));

			if (is_bool($this->ok) && $this->ok === true) {
				// code...
				return $this->redirect(array(
					'controller' => $this->request->controller,
					'action' => 'banner',
					'listar'
				));

			} else {

				$this->setMsgAlertError(ERROR_PROCESS);

				return $this->redirect(array(
					'controller' => $this->request->controller,
					'action' => 'banner',
					'listar'
				));

			}

		}


        $this->configCSRFGuard();

		$this->set('title_for_layout', 'Remover banner');

    }

    public function freteGratis()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopFreteGratis->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    $arrayRegion = array();

                    if (isset($this->request->data['regiao_sul'])) {

                        $erro = Validate::isPricePositive($this->request->data['sul_valor']);
                        $arrayRegion[] = array(
                            'regiao_name' => $this->request->data['regiao_sul'],
                            'regiao_valor' => $this->request->data['sul_valor'],
                            'error' => $erro
                        );
                    }

                    if (isset($this->request->data['regiao_sudeste'])) {

                        $erro = Validate::isPricePositive($this->request->data['sudeste_valor']);
                        $arrayRegion[] = array(
                            'regiao_name' => $this->request->data['regiao_sudeste'],
                            'regiao_valor' => $this->request->data['sudeste_valor'],
                            'error' => $erro
                        );
                    }

                    if (isset($this->request->data['regiao_centro_oeste'])) {

                        $erro = Validate::isPricePositive($this->request->data['centro_oeste_valor']);
                        $arrayRegion[] = array(
                            'regiao_name' => $this->request->data['regiao_centro_oeste'],
                            'regiao_valor' => $this->request->data['centro_oeste_valor'],
                            'error' => $erro
                        );
                    }

                    if (isset($this->request->data['regiao_nordeste'])) {

                        $erro = Validate::isPricePositive($this->request->data['nordeste_valor']);
                        $arrayRegion[] = array(
                            'regiao_name' => $this->request->data['regiao_nordeste'],
                            'regiao_valor' => $this->request->data['nordeste_valor'],
                            'error' => $erro
                        );
                    }

                    if (isset($this->request->data['regiao_norte'])) {

                        $erro = Validate::isPricePositive($this->request->data['norte_valor']);
                        $arrayRegion[] = array(
                            'regiao_name' => $this->request->data['regiao_norte'],
                            'regiao_valor' => $this->request->data['norte_valor'],
                            'error' => $erro
                        );
                    }


                    /**
                     *
                     * Deleta os frete se existir
                     *
                     **/
                    $conditions = array(
                        'ShopFreteGratis.id_shop_default' => $this->Session->read('id_shop')
                    );

                    $this->ShopFreteGratis->deleteAll($conditions);

                    foreach ($arrayRegion as $this->key => $value) {

                        $this->data = array(
                            'id_shop_default' => $this->Session->read('id_shop'),
                            'regiao_name' => $value['regiao_name'],
                            'regiao_valor' => Tools::convertToDecimal($value['regiao_valor'])
                        );

                        if ($value['error'] !== false) {
                            $this->ok = $this->ShopFreteGratis->saveAll($this->data);
                        }

                    }

                    $this->setMsgAlertSuccess('As configurações de frete grátis foram definidas com sucesso.');

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

				$this->setMsgAlertError(ERROR_PROCESS);

			}

        }

        try {
            $this->set('frete_gratis', $this->RecursoFreteGratis->find('all'));
        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

        $this->set('title_for_layout', 'Configurações Frete Grátis');


        $this->configCSRFGuard();

    }

    public function cupomListar()
    {

        try {

            $conditions = array(
                'fields' => array(
                    'ShopCupomDesconto.id_cupom',
                    'ShopCupomDesconto.codigo',
                    'ShopCupomDesconto.descricao',
                    'ShopCupomDesconto.quantidade',
                    'ShopCupomDesconto.validade',
                    'ShopCupomDesconto.utilizados',
                    'ShopCupomDesconto.ativo'
                ),
                'conditions' => array(
                    'ShopCupomDesconto.id_shop_default' => $this->Session->read('id_shop')
                ),
                'order' => array(
                    'ShopCupomDesconto.ativo' => 'DESC',
                    'ShopCupomDesconto.id_cupom' => 'DESC'
                ),
                'limit' => 5,
				'paramType' => 'querystring'
            );

            /**
             *
             * Paginação cupons
             *
             **/
            $this->paginate = $conditions;

            // Roda a consulta, já trazendo os resultados paginados
            $res_cupom = $this->paginate('ShopCupomDesconto');
            $this->set('res_cupom', $res_cupom);


            if ($this->Session->read('cupom_codigo')) {
                $this->set('flash_cupom_codigo', $this->Session->read('cupom_codigo'));
                $this->Session->delete('cupom_codigo');
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

        $this->set('title_for_layout', 'Listar cupons');


        $this->configCSRFGuard();

    }

    public function cupomRemover()
    {

        if (!$this->request->is('post')) {

			$this->setMsgAlertError(ERROR_PROCESS);

            return $this->redirect(array(
                'controller' => $this->request->controller,
                'action' => 'cupom',
                'listar'
            ));

		}

        $this->datasource = $this->ShopCupomDesconto->getDataSource();

		if (isset($this->request->data['confirmacao'])) {

			$this->ok = $this->ShopCupomDesconto->deleteAll(array(
				'ShopCupomDesconto.id_shop_default' => $this->Session->read('id_shop'),
				'ShopCupomDesconto.id_cupom' => $this->request->data['cupons']
			));

			if (is_bool($this->ok) && $this->ok === true) {
				// code...
				return $this->redirect(array(
					'controller' => $this->request->controller,
					'action' => 'cupom',
					'listar'
				));

			} else {

				$this->setMsgAlertError(ERROR_PROCESS);

				return $this->redirect(array(
					'controller' => $this->request->controller,
					'action' => 'cupom',
					'listar'
				));

			}

		}

		try {


            $this->datasource->begin();

			/**
			 *
			 * Verifica o token CSRFGuard
			 *
			 **/

			$CSRFGuard = new CSRFGuard();

            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

				throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

			} else {

				$conditions = array(
					'fields' => array(
						'ShopCupomDesconto.id_cupom',
						'ShopCupomDesconto.codigo',
						'ShopCupomDesconto.descricao'
					),
					'conditions' => array(
						'ShopCupomDesconto.id_shop_default' => $this->Session->read('id_shop'),
						'ShopCupomDesconto.id_cupom' => $this->request->data['cupons']
					),
					'order' => array(
						'ShopCupomDesconto.created' => 'DESC'
					)
				);

				$res_cupom = $this->ShopCupomDesconto->find('all', $conditions);

				$this->set('res_cupom', $res_cupom);

				$cupom_codigo = array();
				foreach ($res_cupom as $this->key => $cupom) {
					array_push($cupom_codigo, $cupom['ShopCupomDesconto']['codigo']);
				}

				$this->Session->write('cupom_codigo', $cupom_codigo);

			}

            $this->datasource->commit();

		} catch (\PDOException $e) {

            $this->datasource->rollback();

			$this->setMsgAlertError(ERROR_PROCESS);
            $this->errorException = true;

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);
            $this->errorException = true;

		} catch (\RuntimeException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);
            $this->errorException = true;

		} finally {

            if ($this->errorException !== false ) {

                return $this->redirect(array(
                    'controller' => $this->request->controller,
                    'action' => 'cupom',
                    'listar'
                ));

            }

        }


        $this->configCSRFGuard();

		$this->set('title_for_layout', 'Removendo cupom');

    }

    /**
     * Cria cupon de desconto
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function cupomCriar()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopCupomDesconto->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    $this->error = false;
                    if (Tools::getValue('tipo') != "frete_gratis" && Tools::getValue('valor') == '') {
                        $this->set('error_valor', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('tipo') != "frete_gratis" && !v::numeric()->notBlank()->validate(intval(Tools::getValue('valor')))) {
                        $this->set('error_valor', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('valor_minimo') !== '' && !v::numeric()->notBlank()->validate(intval(Tools::getValue('valor_minimo')))) {
                        $this->set('error_valor_minimo', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('descricao') == '') {
                        $this->set('error_descricao', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('descricao') != '') {
                        if (strlen(Tools::getValue('descricao')) > 128) {
                            $this->set('error_descricao', true);
                            $this->set('error_descricao_comp', strlen(Tools::getValue('descricao')));
                            $this->error = true;
                        }
                    }

                    if (Tools::getValue('codigo') == '') {
                        $this->set('error_codigo', true);
                        $this->error = true;
                    }

                    if (!v::numeric()->notBlank()->validate(Tools::getValue('quantidade'))) {
                        $this->set('error_quantidade', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('validade') != "" && !Validate::isDate(Tools::getValue('validade'), 'd/m/Y')) {
                        $this->set('error_validade', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('validade') != "" && !Validate::isDateFuture(Tools::getValue('validade'))) {
                        $this->set('error_validade', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('validade') != "" && !Validate::isDateFuture(Tools::getValue('validade'))) {
                        $this->set('error_validade', true);
                        $this->error = true;
                    }

                    if (!v::numeric()->notBlank()->validate(intval(Tools::getValue('quantidade')))) {
                        $this->set('error_quantidade', true);
                        $this->error = true;

                    }

                    if (!v::numeric()->notBlank()->validate(intval(Tools::getValue('quantidade_por_cliente')))) {
                        $this->set('error_quantidade_por_cliente', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('tipo') != "frete_gratis" && Tools::getValue('valor') == '') {
                        throw new \InvalidArgumentException("O valor do desconto não pode ser maior que 100%.", E_USER_WARNING);
                    }

                    if (Tools::getValue('tipo') != "frete_gratis" && !v::numeric()->notBlank()->validate(intval(Tools::getValue('valor')))) {
                        throw new \InvalidArgumentException("O valor do desconto não pode ser maior que 100%.", E_USER_WARNING);
                    }

                    if (!v::alnum()->notEmpty()->validate(Tools::getValue('descricao'))) {
                        throw new \InvalidArgumentException("Informe a descrição do cupom.", E_USER_WARNING);
                    }

                    if (Tools::getValue('codigo') == '') {
                        throw new \NotFoundException("Informe o código do cupom.", E_USER_WARNING);
                    }

                    if (!v::numeric()->notBlank()->validate(Tools::getValue('quantidade'))) {
                        throw new \InvalidArgumentException("Informe a quantidade de cupons.", E_USER_WARNING);
                    }

                    if (Tools::getValue('validade') != "" && !Validate::isDate(Tools::getValue('validade'), 'd/m/Y')) {
                        throw new \InvalidArgumentException("Data de validade é inválida.", E_USER_WARNING);
                    }

                    if (Tools::getValue('validade') != "" && !Validate::isDateFuture(Tools::getValue('validade'))) {
                        throw new \InvalidArgumentException("Data do cupom inválida, a data precisa estar no futuro.", E_USER_WARNING);
                    }

                    if ($this->error !== true) {

                        $conditions = array(
                            'conditions' => array(
                                'ShopCupomDesconto.id_shop_default' => $this->Session->read('id_shop'),
                                'ShopCupomDesconto.codigo' => Tools::getValue('codigo')
                            )
                        );

                        if ($this->ShopCupomDesconto->find('count', $conditions)) {
                            $this->set('error_codigo', true);
                            throw new \Exception\VialojaOverflowException("Este código já está em uso.", E_USER_WARNING);
                        }

                        // code...

                        $data_vencimento = Tools::formatToDateDB(Tools::getValue('validade'));
                        if (empty($data_vencimento)) {
                            $data_vencimento = '0000-00-00';
                        }

                        $this->data = array(

                            'id_shop_default' => $this->Session->read('id_shop'),
                            'ativo' => Tools::clean(Tools::getValue('ativo')),
                            'codigo' => Tools::clean(Tools::getValue('codigo')),
                            'descricao' => Tools::clean(Tools::getValue('descricao')),
                            'tipo' => Tools::clean(Tools::getValue('tipo')),
                            'valor' => Tools::convertToDecimal(Tools::getValue('valor')),
                            'valor_minimo' => Tools::convertToDecimal(Tools::getValue('valor_minimo')),
                            'quantidade' => Tools::clean(Tools::getValue('quantidade')),
                            'cumulativo' => Tools::clean(Tools::getValue('cumulativo')),
                            'quantidade_por_cliente' => Tools::clean(Tools::getValue('quantidade_por_cliente')),
                            'validade' => $data_vencimento,
                            'aplicar_no_total' => Tools::clean(Tools::getValue('aplicar_no_total'))
                        );


                        if ($this->ShopCupomDesconto->saveAll($this->data)) {

                            $this->setMsgAlertSuccess('Cupom criado com sucesso.');

                            return $this->redirect(array(
                                'controller' => $this->request->controller,
                                'action' => 'cupom',
                                'listar'
                            ));

                        } else {
							throw new \RuntimeException();
						}

                    } else {

                        $this->setMsgAlertError('Verifique o(s) erro(s) encontrado(s).');

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\NotFoundException $e) {

				$this->setMsgAlertError($e->getMessage());

			} catch (\InvalidArgumentException $e) {

				$this->setMsgAlertError($e->getMessage());

			} catch (\Exception\VialojaOverflowException $e) {

				$this->setMsgAlertError($e->getMessage());

			} catch (\RuntimeException $e) {

				$this->setMsgAlertError(ERROR_PROCESS);

			}

        }


        $this->configCSRFGuard();

        $this->set('title_for_layout', 'Criar cupom');

    }

    public function cupomEditar()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopCupomDesconto->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    $this->error = false;
                    if (Tools::getValue('tipo') != "frete_gratis" && Tools::getValue('valor') == '') {
                        $this->set('error_valor', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('tipo') != "frete_gratis" && !v::numeric()->notBlank()->validate(intval(Tools::getValue('valor')))) {
                        $this->set('error_valor', true);
                        $this->error = true;
                    }

                    if (!v::numeric()->notBlank()->validate(intval(Tools::getValue('valor_minimo')))) {
                        $this->set('error_valor_minimo', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('descricao') == '') {
                        $this->set('error_descricao', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('descricao') !== '') {
                        if (strlen(Tools::getValue('descricao')) > 128) {
                            $this->set('error_descricao', true);
                            $this->set('error_descricao_comp', strlen(Tools::getValue('descricao')));
                            $this->error = true;
                        }
                    }

                    if (Tools::getValue('codigo') == '') {
                        $this->set('error_codigo', true);
                        $this->error = true;
                    }

                    if (!v::numeric()->notBlank()->validate(Tools::getValue('quantidade'))) {
                        $this->set('error_quantidade', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('validade') != "" && !Validate::isDate(Tools::getValue('validade'), 'd/m/Y')) {
                        $this->set('error_validade', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('validade') != "" && !Validate::isDateFuture(Tools::getValue('validade'))) {
                        $this->set('error_validade', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('validade') != "" && !Validate::isDateFuture(Tools::getValue('validade'))) {
                        $this->set('error_validade', true);
                        $this->error = true;
                    }

                    if (!v::numeric()->notBlank()->validate(intval(Tools::getValue('quantidade')))) {
                        $this->set('error_quantidade', true);
                        $this->error = true;

                    }

                    if (!v::numeric()->notBlank()->validate(intval(Tools::getValue('quantidade_por_cliente')))) {
                        $this->set('error_quantidade_por_cliente', true);
                        $this->error = true;
                    }

                    if (Tools::getValue('tipo') != "frete_gratis" && Tools::getValue('valor') == '') {
                        throw new \InvalidArgumentException("O valor do desconto não pode ser maior que 100%.", E_USER_WARNING);
                    }

                    if (Tools::getValue('tipo') != "frete_gratis" && !v::numeric()->notBlank()->validate(intval(Tools::getValue('valor')))) {
                        throw new \InvalidArgumentException("O valor do desconto não pode ser maior que 100%.", E_USER_WARNING);
                    }

                    if (!v::alnum()->notEmpty()->validate(Tools::getValue('descricao'))) {
                        throw new \InvalidArgumentException("Informe a descrição do cupom.", E_USER_WARNING);
                    }

                    if (Tools::getValue('codigo') == '') {
                        throw new \NotFoundException("Informe o código do cupom.", E_USER_WARNING);
                    }

                    if (!v::numeric()->notBlank()->validate(Tools::getValue('quantidade'))) {
                        throw new \InvalidArgumentException("Informe a quantidade de cupons.", E_USER_WARNING);
                    }

                    if (Tools::getValue('validade') != "" && !Validate::isDate(Tools::getValue('validade'), 'd/m/Y')) {
                        throw new \InvalidArgumentException("Data de validade é inválida.", E_USER_WARNING);
                    }

                    if (Tools::getValue('validade') != "" && !Validate::isDateFuture(Tools::getValue('validade'))) {
                        throw new \InvalidArgumentException("Data do cupom inválida, a data precisa estar no futuro.", E_USER_WARNING);
                    }

                    if ($this->error !== true) {

                        $conditions = array(
                            'conditions' => array(
                                'ShopCupomDesconto.id_shop_default' => $this->Session->read('id_shop'),
                                'ShopCupomDesconto.codigo' => Tools::getValue('codigo'),
                                'ShopCupomDesconto.id_cupom !=' => $this->request->params['pass']['2']
                            )
                        );

                        if ($this->ShopCupomDesconto->find('count', $conditions)) {
                            $this->set('error_codigo', true);
                            throw new \Exception\VialojaOverflowException("Este código já está em uso.", E_USER_WARNING);
                        }
                        // code...

                        $data_vencimento = Tools::formatToDateDB(Tools::getValue('validade'));
                        if (empty($data_vencimento)) {
                            $data_vencimento = '0000-00-00';
                        }

                        $fields = array(

                            'ShopCupomDesconto.ativo' => sprintf("'%s'", Tools::clean(Tools::getValue('ativo'))),
                            'ShopCupomDesconto.codigo' => sprintf("'%s'", Tools::clean(Tools::getValue('codigo'))),
                            'ShopCupomDesconto.descricao' => sprintf("'%s'", Tools::clean(Tools::getValue('descricao'))),
                            'ShopCupomDesconto.tipo' => sprintf("'%s'", Tools::clean(Tools::getValue('tipo'))),
                            'ShopCupomDesconto.valor' => sprintf("'%s'", Tools::clean(Tools::getValue('valor'))),
                            'ShopCupomDesconto.valor_minimo' => sprintf("'%s'", Tools::clean(Tools::getValue('valor_minimo'))),
                            'ShopCupomDesconto.quantidade' => sprintf("'%s'", Tools::clean(Tools::getValue('quantidade'))),
                            'ShopCupomDesconto.cumulativo' => sprintf("'%s'", Tools::clean(Tools::getValue('cumulativo'))),
                            'ShopCupomDesconto.quantidade_por_cliente' => sprintf("'%s'", Tools::clean(Tools::getValue('quantidade_por_cliente'))),
                            'ShopCupomDesconto.validade' => sprintf("'%s'", $data_vencimento),
                            'ShopCupomDesconto.aplicar_no_total' => sprintf("'%s'", Tools::clean(Tools::getValue('aplicar_no_total')))
                        );

                        $conditions = array(
                            'ShopCupomDesconto.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopCupomDesconto.id_cupom' => $this->request->params['pass']['2']
                        );


                        $this->ok = $this->ShopCupomDesconto->updateAll($fields, $conditions);

                        if (is_bool($this->ok) && $this->ok === true) {

                            $this->setMsgAlertSuccess('Cupom editado com sucesso.');

                            return $this->redirect(array(
                                'controller' => $this->request->controller,
                                'action' => 'cupom',
                                'listar'
                            ));

                        } else {
                            throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                        }

                    } else {

                        $this->setMsgAlertError('Verifique o(s) erro(s) encontrado(s).');

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\NotFoundException $e) {

				$this->setMsgAlertError($e->getMessage());

			} catch (\InvalidArgumentException $e) {

				$this->setMsgAlertError($e->getMessage());

			} catch (\RuntimeException $e) {

				$this->setMsgAlertError(ERROR_PROCESS);

			}

        }


        try {

            $conditions = array(
                'fields' => array(
                    'ShopCupomDesconto.ativo',
                    'ShopCupomDesconto.codigo',
                    'ShopCupomDesconto.descricao',
                    'ShopCupomDesconto.tipo',
                    'ShopCupomDesconto.valor',
                    'ShopCupomDesconto.valor_minimo',
                    'ShopCupomDesconto.quantidade',
                    'ShopCupomDesconto.validade',
                    'ShopCupomDesconto.cumulativo',
                    'ShopCupomDesconto.quantidade_por_cliente',
                    'ShopCupomDesconto.aplicar_no_total'
                ),
                'conditions' => array(
                    'ShopCupomDesconto.id_shop_default' => $this->Session->read('id_shop'),
                    'ShopCupomDesconto.id_cupom' => $this->request->params['pass']['2']
                ),
                'limit' => 1
            );

            if ($this->ShopCupomDesconto->find('count', $conditions) <= 0) {
                throw new \NotFoundException("Cupom não encontrado.", E_USER_WARNING);
            }

            // Roda a consulta, já trazendo os resultados paginados
            $res_cupom = $this->ShopCupomDesconto->find('all', $conditions);
            $this->set('res_cupom', $res_cupom);

        }
        catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);
            return $this->redirect(array(
                'controller' => $this->request->controller,
                'action' => 'cupom',
                'listar'
            ));

        } catch (\NotFoundException $e) {

			$this->setMsgAlertError($e->getMessage());

		} catch (\RuntimeException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);

		}

        $this->set('title_for_layout', 'Editando cupom');


        $this->configCSRFGuard();


    }

    public function xmlListar()
    {

		$result = $this->Comparador->getAll();
		$this->set( compact('result') );
        $this->set('title_for_layout', 'Listar comparadores');

    }

    public function xmlEditar()
    {

        try {

            if (!isset($this->request->params['pass']['2'])) {
				throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
			}

            if (!v::numeric()->notBlank()->validate($this->request->params['pass']['2'])) {
				throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
			}

			$conditions = array(
				'conditions' => array(
                    'Comparador.id' => $this->request->params['pass']['2'],
					'Comparador.ativo' => 'True',
				)
			);

			if ($this->Comparador->find('count', $conditions) <= 0) {
				throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
			}

			$this->dados = $this->Comparador->find('first', $conditions);

			$this->set('nome', $this->dados['Comparador']['nome']);
			$this->set('id', $this->request->params['pass']['2']);

			$conditions = array(
				'conditions' => array(
					'ShopComparadorXml.id_comparador_default' => $this->request->params['pass']['2'],
					'ShopComparadorXml.id_shop_default' => $this->Session->read('id_shop')
				)
			);

			$this->total = $this->ShopComparadorXml->find('count', $conditions);
			$this->set('total_xml', $this->total);

			if ( $this->total > 0 ) {

				$this->dados = $this->ShopComparadorXml->find('first', $conditions);
				$this->set('url_xml', $this->dados['ShopComparadorXml']['url']);
				$this->set('todos_os_produtos', $this->dados['ShopComparadorXml']['todos_os_produtos']);

			}


			/**
			*
			* Produto vinculados
			*
			**/

			$conditions = array(
				'fields' => array('ShopComparadorProduto.id_produto_default'),
				'conditions' => array(
					'ShopComparadorProduto.id_comparador_default' => $this->request->params['pass']['2'],
					'ShopComparadorProduto.id_shop_default' =>  $this->Session->read('id_shop')
				)
			);

			$result = $this->ShopComparadorProduto->find('all', $conditions);

			$arr_id_vinculados = array();
			foreach ($result as $this->key => $this->dados) {
                array_push($arr_id_vinculados, $this->dados['ShopComparadorProduto']['id_produto_default']);
			}

            $id_vinculados = implode(',', $arr_id_vinculados);
			$this->set(compact('id_vinculados'));

        } catch (\PDOException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);
            $this->errorException = true;
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\NotFoundException $e) {

			$this->setMsgAlertError($e->getMessage());
            $this->errorException = true;

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError($e->getMessage());
            $this->errorException = true;

		} catch (\RuntimeException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);
            $this->errorException = true;

		} finally {

            if ($this->errorException !== false ) {

                return $this->redirect(array(
                    'controller' => $this->request->controller,
                    'action' => 'xml',
                    'listar'
                ));

            }

        }



        $this->set('title_for_layout', 'Editar comparador');

    }

    public function xmlUrlAlterar() {

        $this->layout = false;
        $this->render(false);

        try {

            if (!isset($this->request->params['pass']['3'])) {
				throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
			}

            if (!v::numeric()->notBlank()->validate($this->request->params['pass']['3'])) {
				throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
			}

			$conditions = array(
				'conditions' => array(
					'Comparador.id' => $this->request->params['pass']['3']
				)
			);

			$this->dados = $this->Comparador->find('first', $conditions);

            $this->token = Tools::slug(Tools::tokenGen(6));
            $this->url = sprintf('http://%s/xml/%s/%s.xml', self::getDominio(), $this->token, Tools::slug($this->dados['Comparador']['nome']));

			$fields = array(
				'ShopComparadorXml.token' => sprintf("'%s'", $this->token),
                'ShopComparadorXml.nome' => sprintf("'%s'", Tools::slug($this->dados['Comparador']['nome'])),
				'ShopComparadorXml.url' => sprintf("'%s'", $this->url)
			);

			$conditions = array(
				'ShopComparadorXml.id_shop_default' => $this->Session->read('id_shop'),
				'ShopComparadorXml.id_comparador_default' => $this->request->params['pass']['3']
			);

			$this->ok = $this->ShopComparadorXml->updateAll($fields, $conditions);

			if (is_bool($this->ok) && $this->ok === true) {

				$this->setMsgAlertSuccess('Nova URL gerada com sucesso.');

				return $this->redirect($this->referer());

			} else {

				return $this->redirect($this->referer());

			}

		} catch (\PDOException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);
            return $this->redirect($this->referer());

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError($e->getMessage());
            return $this->redirect($this->referer());

		} catch (\RuntimeException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);
            return $this->redirect($this->referer());

		}

    }

    public function xmlEditarJson() {

        $this->layout = false;
        $this->render(false);

        if (!$this->request->is('post')) {
			return false;
		}

		if (!$this->request->is('ajax')) {
			return false;
		}

        $this->datasource = $this->ShopComparadorXml->getDataSource();

        try {

            $this->datasource->begin();

            if (!isset($this->request->params['pass']['3'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS);
            }

            if (!is_numeric($this->request->params['pass']['3'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS);
            }


            $id_comparador_default = $this->request->params['pass']['3'];

            if (Tools::getValue('ativo') == 'False') {

				$conditions = array(
					"ShopComparadorXml.id_comparador_default" => $id_comparador_default,
					"ShopComparadorXml.id_shop_default" => $this->Session->read('id_shop')
				);

				if ($this->ShopComparadorXml->deleteAll($conditions)) {
					$this->json['resposta']['estado'] = 'SUCESSO';
				} else {
					$this->json['resposta']['mensagem'] = 'Houve um erro no processamento do pedido.';
				}

			} else {

                if (Tools::getValue('todos_os_produtos') === 'false') {

                    if ( !isset( $this->request->data['produtos'] ) ) {
                        throw new \InvalidArgumentException('Nenhum produto foi selecionado.', E_USER_WARNING);
                    }

                }

                $reToken = $this->ShopComparadorXml->getToken($this->Session->read('id_shop'), $id_comparador_default);

                if ($reToken !== false) {
                    $this->token = $reToken['ShopComparadorXml']['token'];
                } else {
                    $this->token = Tools::slug(Tools::tokenGen(6));
                }

				$conditions = array(
					"ShopComparadorXml.id_comparador_default" => $id_comparador_default,
					"ShopComparadorXml.id_shop_default" => $this->Session->read('id_shop')
				);

				$this->ShopComparadorXml->deleteAll($conditions);

				$conditions = array(
					'conditions' => array(
						'Comparador.id' => $id_comparador_default
					)
				);

				$this->dados = $this->Comparador->find('first', $conditions);

                $this->url = sprintf('http://%s/xml/%s/%s.xml', self::getDominio(), $this->token, Tools::slug($this->dados['Comparador']['nome']));

				$this->data = array(
					'id_shop_default' => $this->Session->read('id_shop'),
					'id_comparador_default' => $id_comparador_default,
                    'todos_os_produtos' => Tools::getValue('todos_os_produtos'),
                    'token' => $this->token,
                    'nome' => Tools::slug($this->dados['Comparador']['nome']),
					'url' => $this->url
				);

				$this->ok = $this->ShopComparadorXml->saveAll($this->data);

				if (is_bool($this->ok) && $this->ok === true) {

                    if (Tools::getValue('todos_os_produtos') === 'false') {

						foreach ( $this->request->data['produtos'] as $id_produto_default) {

							$id_produto_default = trim( $id_produto_default );

							if (is_numeric($id_produto_default)) {

								$this->data = array(
									'id_shop_default' => $this->Session->read('id_shop'),
									'id_produto_default' => $id_produto_default,
									'id_comparador_default' => $id_comparador_default
								);

								$this->ok = $this->ShopComparadorProduto->saveAll($this->data);

							} else {

                                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                            }

						}

					}

				}

                if (is_bool($this->ok) && $this->ok === true) {

                    $this->json['resposta']['estado'] = 'SUCESSO';

                } else {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                }

			}

            $this->datasource->commit();

		} catch (\PDOException $e) {

            $this->datasource->rollback();
			$this->json['resposta']['mensagem'] = ERROR_PROCESS;
            \Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\InvalidArgumentException $e) {

            header('Content-Type: application/json');
            $this->json['resposta']['mensagem'] = $e->getMessage();

        } finally {

            header('Content-Type: application/json');
            echo json_encode($this->json);

        }

    }

    /**
     * Produto listar Json
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function produtoListar() {


		$this->layout = false;
		$this->render(false);
		header('Content-Type: application/json');

        if ($this->request->is('ajax')) {

            try {

                $iDisplayStart =0;
                if (Tools::getValue('iDisplayStart') != '') {
                    $iDisplayStart = Tools::getValue('iDisplayStart');
                }

                $iDisplayLength =10;
                if (Tools::getValue('iDisplayLength') != '') {
                    $iDisplayLength = Tools::getValue('iDisplayLength');
                }

                //$iDisplayStart = $iDisplayStart * $iDisplayLength;

                /**
                 *
                 * Total de produto Ativo
                 *
                 **/
                $conditions = array(

                    'conditions' => array(
                        'ShopProduto.ativo' => 'True',
                        'ShopProduto.lixo' => 'False',
                        'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                    ),

                    'group' => array('ShopProduto.nome', 'ShopProduto.parente_id'),

                );

                $iTotal = $this->ShopProduto->find('count', $conditions);

                $order_by = 'ORDER BY `ShopProduto`.';

                if (Tools::getValue('iSortCol_0') > 0) {

                    if (Tools::getValue('iSortCol_0') == '3') {

                        $order_by .= '`quantidade` ';

                    } elseif (Tools::getValue('iSortCol_0') == '2') {

                        $order_by .= '`preco_cheio` ';

                    } elseif (Tools::getValue('iSortCol_0') == '1') {

                        $order_by .= '`nome` ';

                    }

                } else {

                    $order_by .= '`id_produto` ';

                }

                $order_by .= Tools::getValue('sSortDir_0');

                $fields = $search = '';
                if (Tools::getValue('sSearch') != '') {

                    $this->busca = Tools::sanitizeFullText(Tools::getValue('sSearch'));
                    $this->busca = str_replace('%', "-1", $this->busca );

                    if (Tools::strlen($this->busca) <= 3) {

                        $search = "`ShopProduto`.`nome` LIKE '%". $this->busca . "%' AND";

                    } else {

                        $fields = ", MATCH (`nome`) AGAINST ('". $this->busca ."' IN BOOLEAN MODE) AS score";
                        $search = "MATCH (`nome`) AGAINST ('". $this->busca ."' IN BOOLEAN MODE) AND";

                        $order_by = 'ORDER BY score DESC';

                    }

                }

                $db = $this->ShopProduto->getDataSource();
                $produtos = $db->fetchAll(
                    "SELECT `ShopProduto`.`id_produto`, `ShopProduto`.`nome`, `ShopProduto`.`preco_cheio`, `ShopProduto`.`preco_promocional`, `ShopProduto`.`quantidade`, `ShopProduto`.`gerenciado`, `ShopProduto`.`situacao_em_estoque`, `ShopProduto`.`parente_id` {$fields} FROM `sh_shop_produto` AS `ShopProduto` WHERE $search `ShopProduto`.`id_shop_default` = ? GROUP BY `ShopProduto`.`parente_id`, `ShopProduto`.`nome`  $order_by, `ShopProduto`.`parente_id` DESC  LIMIT $iDisplayStart, $iDisplayLength",
                    array($this->Session->read('id_shop') )
                );

                /**
                 * Migrar para o código abaixo
                 */
                
                /*
                $inputArray = array();

                foreach ($produtos as $this->key => $this->dados) {

                    if ($this->atributo !== true) {

                        $this->nome = $this->dados['ShopProduto']['nome'];
                        $this->preco_cheio = $this->dados['ShopProduto']['preco_cheio'];
                        $this->preco_promocional = $this->dados['ShopProduto']['preco_promocional'];
                        $this->situacao_em_estoque = $this->dados['ShopProduto']['situacao_em_estoque'];
                        $this->gerenciado = $this->dados['ShopProduto']['gerenciado'];
                        $this->quantidade = $this->dados['ShopProduto']['quantidade'];
                        $this->id_produto = $this->dados['ShopProduto']['id_produto'];

                    }

                    if ($this->dados['ShopProduto']['parente_id'] > 0) {

                        $this->nome = $this->dados['ShopProduto']['nome'];
                        $this->preco_cheio = $this->dados['ShopProduto']['preco_cheio'];
                        $this->preco_promocional = $this->dados['ShopProduto']['preco_promocional'];
                        $this->situacao_em_estoque = $this->dados['ShopProduto']['situacao_em_estoque'];
                        $this->gerenciado = $this->dados['ShopProduto']['gerenciado'];
                        $this->quantidade = $this->dados['ShopProduto']['quantidade'];
                        $this->id_produto = $this->dados['ShopProduto']['parente_id'];
                        $this->atributo = true;

                    }

                    if ($this->dados['ShopProduto']['parente_id'] <= 0) {


                        $inputArray[] = '<input class=\"produto_id\" type=\"checkbox\" name=\"produtos[]\" value=\"'. $this->id_produto .'\" />';

                        if (!empty($this->nome)) {
                            $inputArray[] = $this->nome;
                        } else {
                            $inputArray[] = "-";
                        }

                        if (!Validate::isValueBigger($this->preco_cheio, $this->preco_promocional)) {
                            $inputArray[] = "R$ " . Tools::convertToDecimalBR($this->preco_cheio);
                        } else {
                            $inputArray[] = "R$ " . Tools::convertToDecimalBR($this->preco_promocional);
                        }

                        $inputArray[] = intval($this->quantidade);

                    }

                    if ($this->dados['ShopProduto']['parente_id'] <= 0) {

                        $this->nome = null;
                        $this->id_produto = null;
                        $this->preco_cheio = null;
                        $this->preco_promocional = null;
                        $this->situacao_em_estoque = null;
                        $this->gerenciado = null;
                        $this->quantidade = null;
                        $this->atributo = null;

                    }

                }

                $arrayDataTables = array(

                   'sEcho' => Tools::getValue('sEcho'),
                   'iTotalRecords' => (int) $iTotal,
                   'iTotalDisplayRecords' => (int) $iTotal,
                   'aaData' => array( $inputArray )

                );

                header('Content-Type: application/json');
                echo stripslashes(json_encode($arrayDataTables));
                $this->layout = false;
                $this->render(false);
                exit();

                */


                $iFilteredTotal = $iTotal;

                $this->output = '{';
                $this->output .= '"sEcho": ' . Tools::getValue('sEcho') . ', ';
                $this->output .= '"iTotalRecords": '. $iTotal .', ';
                $this->output .= '"iTotalDisplayRecords": '. $iFilteredTotal .', ';
                $this->output .= '"aaData": [ ';

                foreach ($produtos as $this->key => $this->dados) {

                    if ($this->atributo !== true) {

                        $this->nome = $this->dados['ShopProduto']['nome'];
                        $this->preco_cheio = $this->dados['ShopProduto']['preco_cheio'];
                        $this->preco_promocional = $this->dados['ShopProduto']['preco_promocional'];
                        $this->situacao_em_estoque = $this->dados['ShopProduto']['situacao_em_estoque'];
                        $this->gerenciado = $this->dados['ShopProduto']['gerenciado'];
                        $this->quantidade = $this->dados['ShopProduto']['quantidade'];
                        $this->id_produto = $this->dados['ShopProduto']['id_produto'];

                    }

                    if ($this->dados['ShopProduto']['parente_id'] > 0) {

                        $this->nome = $this->dados['ShopProduto']['nome'];
                        $this->preco_cheio = $this->dados['ShopProduto']['preco_cheio'];
                        $this->preco_promocional = $this->dados['ShopProduto']['preco_promocional'];
                        $this->situacao_em_estoque = $this->dados['ShopProduto']['situacao_em_estoque'];
                        $this->gerenciado = $this->dados['ShopProduto']['gerenciado'];
                        $this->quantidade = $this->dados['ShopProduto']['quantidade'];
                        $this->id_produto = $this->dados['ShopProduto']['parente_id'];
                        $this->atributo = true;

                    }

                    if ($this->dados['ShopProduto']['parente_id'] <= 0) {


                        $this->output .= "[";

                        $this->output .= '"<input class=\"produto_id\" type=\"checkbox\" name=\"produtos[]\" value=\"'. $this->id_produto .'\" />",';

                        if (!empty($this->nome)) {
                            $this->output .= '"'. $this->nome .'",';
                        } else {
                            $this->output .= '"-",';
                        }

                        if (!Validate::isValueBigger($this->preco_cheio, $this->preco_promocional)) {
                            $this->output .= '"R$ ' . Tools::convertToDecimalBR($this->preco_cheio) . '",';
                        } else {
                            $this->output .= '"R$ ' . Tools::convertToDecimalBR($this->preco_promocional) . '",';
                        }

                        $this->output .= intval($this->quantidade);
                        $this->output .= "],";

                    }

                    if ($this->dados['ShopProduto']['parente_id'] <= 0) {

                        $this->nome = null;
                        $this->id_produto = null;
                        $this->preco_cheio = null;
                        $this->preco_promocional = null;
                        $this->situacao_em_estoque = null;
                        $this->gerenciado = null;
                        $this->quantidade = null;
                        $this->atributo = null;

                    }

                }

                $this->output = substr_replace( $this->output, "", -1 );
                $this->output .= '] }';

                echo $this->output;

                exit();

            } catch (\PDOException $e) {

                \Exception\VialojaDatabaseException::errorHandler($e);

            }

        }

        exit();

    }

    public function htmlListar()
    {

        try {
            $conditions = array(
                'fields' => array(
                    'ShopCode.id_code',
                    'ShopCode.descricao',
                    'ShopCode.local_publicacao',
                    'ShopCode.tipo',
                    'ShopCode.pagina_publicacao',
                    'ShopCode.reprovado',
                    'ShopCode.time'
                ),
                'conditions' => array(
                    'ShopCode.id_shop_default' => $this->Session->read('id_shop')
                ),
                'order' => array(
                    'ShopCode.time' => 'DESC'
                )
            );

            $result = $this->ShopCode->find('all', $conditions);

            $this->set('result_code', $result);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        $this->set('title_for_layout', 'Códigos HTML');


    }

    public function htmlCriar()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopCode->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    $this->descricao = Tools::clean(Tools::getValue('descricao'));
                    $this->pagina_publicacao = Tools::clean(Tools::getValue('pagina_publicacao'));
                    $this->conteudo = Tools::getValue('conteudo');

                    if (empty($this->descricao)) {
                        throw new \NotFoundException("Atenção: Informe a descrição do código.", E_USER_WARNING);
                    }

                    if (empty($this->pagina_publicacao)) {
                        throw new \NotFoundException("Atenção: A página onde sera publicado o código.", E_USER_WARNING);
                    }

                    if (empty($this->request->data['conteudo'])) {
                        throw new \NotFoundException("Atenção: Informe o código no campo conteúdo.", E_USER_WARNING);
                    }

                    if (Tools::strlen($this->conteudo) > 6000) {
                        throw new LengthException("Atenção: Não ultrapasse o limite máximo de 6000 caracteres.", E_USER_WARNING);
                    }

                    $this->data = array(

                        'id_shop_default' => $this->Session->read('id_shop'),
                        'descricao' => $this->descricao,
                        'local_publicacao' => $this->request->data['local_publicacao'],
                        'tipo' => $this->request->data['tipo'],
                        'pagina_publicacao' => $this->pagina_publicacao,
                        'conteudo' => Tools::htmlentitiesUTF8($this->conteudo),
                        'time' => time()

                    );

                    if ($this->ShopCode->saveAll($this->data)) {

                        $this->setMsgAlertSuccess('Código HTML criado com sucesso.');

                        self::redirecionaHTMLListar();

                    } else {

						throw new \RuntimeException();

					}

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\NotFoundException $e) {

				$this->setMsgAlertError($e->getMessage());

            } catch (LengthException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\InvalidArgumentException $e) {

				$this->setMsgAlertError($e->getMessage());

			} catch (\RuntimeException $e) {

				$this->setMsgAlertError(ERROR_PROCESS);

			} finally {

                $this->set('descricao', $this->descricao);
                $this->set('pagina_publicacao', $this->pagina_publicacao);
                $this->set('conteudo', $this->conteudo);

            }

        }

        $this->set('title_for_layout', 'Criar código HTML');


        $this->configCSRFGuard();

    }

    public function redirecionaHTMLListar()
    {
        return $this->redirect(array(
            'controller' => $this->request->controller,
            'action' => 'html',
            'listar'
        ));
    }

    public function htmlEditar()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopCode->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    if (empty($this->request->params['pass']['2'])) {
                        throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
                    }

                    $this->descricao = Tools::clean(Tools::getValue('descricao'));
                    $this->pagina_publicacao = Tools::clean(Tools::getValue('pagina_publicacao'));
                    $this->conteudo = Tools::getValue('conteudo');

                    if (empty($this->descricao)) {
                        throw new \NotFoundException("Atenção: Informe a descrição do código.", E_USER_WARNING);
                    }

                    if (empty($this->pagina_publicacao)) {
                        throw new \NotFoundException("Atenção: A página onde sera publicado o código.", E_USER_WARNING);
                    }

                    if (empty($this->request->data['conteudo'])) {
                        throw new \NotFoundException("Atenção: Informe o código no campo conteúdo.", E_USER_WARNING);
                    }

                    if (Tools::strlen($this->conteudo) > 6000) {
                        throw new LengthException("Atenção: Não ultrapasse o limite máximo de 6000 caracteres.", E_USER_WARNING);
                    }

                    if (empty($this->request->data['id_code'])) {
                        throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
                    }

                    $this->ok = $this->ShopCode->updateAll(array(

                        'ShopCode.descricao' => sprintf("'%s'", $this->descricao),
                        'ShopCode.local_publicacao' => sprintf("'%s'", $this->request->data['local_publicacao']),
                        'ShopCode.tipo' => sprintf("'%s'", $this->request->data['tipo']),
                        'ShopCode.pagina_publicacao' => sprintf("'%s'", $this->pagina_publicacao),
                        'ShopCode.conteudo' => sprintf("'%s'", Tools::htmlentitiesUTF8($this->conteudo)),
                        'ShopCode.time' => sprintf("'%s'", time())
                    ), array(
                        'ShopCode.id_code' => $this->request->data['id_code'],
                        'ShopCode.id_shop_default' => $this->Session->read('id_shop')
                    ));

                    if ($this->ok === true) {

                        $this->setMsgAlertSuccess('Código HTML alterado com sucesso.');

                        self::redirecionaHTMLListar();

                    } else {

                        throw new \RuntimeException();

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                \Exception\VialojaDatabaseException::errorHandler($e);
                self::redirecionaHTMLListar();

            } catch (\NotFoundException $e) {

				$this->setMsgAlertError($e->getMessage());

			} catch (\InvalidArgumentException $e) {

				$this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError($e->getMessage());

			} catch (LengthException $e) {

				$this->setMsgAlertError($e->getMessage());

			} finally {

                $this->set('descricao', $this->descricao);
                $this->set('pagina_publicacao', $this->pagina_publicacao);
                $this->set('conteudo', $this->conteudo);

            }

        }

        try {

            if (!isset($this->request->params['pass']['2'])) {
				throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
			}

            if (!v::numeric()->notBlank()->validate($this->request->params['pass']['2'])) {
				throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
			}

            $conditions = array(
                'fields' => array(
                    'ShopCode.id_code',
                    'ShopCode.descricao',
                    'ShopCode.local_publicacao',
                    'ShopCode.tipo',
                    'ShopCode.pagina_publicacao',
                    'ShopCode.conteudo',
                    'ShopCode.reprovado',
                    'ShopCode.time'
                ),
                'conditions' => array(
                    'ShopCode.id_shop_default' => $this->Session->read('id_shop'),
                    'ShopCode.id_code' => $this->request->params['pass']['2']
                )
            );

            $this->ShopCode->id = intval($this->request->params['pass']['2']);

            if ($this->ShopCode->exists()) {

                $result = $this->ShopCode->find('all', $conditions);

                if (!v::notEmpty()->validate($result)) {
                    throw new \NotFoundException(ERROR_NOT_FOUND, 1);
                }

                $this->set('result_code', $result);

            } else {

                throw new \NotFoundException(ERROR_NOT_FOUND, 1);

            }


        }
        catch (\PDOException $e) {

            $this->setMsgAlertError($e->getMessage());
            $this->errorException = true;
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\NotFoundException $e) {

			$this->setMsgAlertError($e->getMessage());
            $this->errorException = true;

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError($e->getMessage());
            $this->errorException = true;

		} catch (\RuntimeException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);
            $this->errorException = true;

		} finally {

            if ($this->errorException === true) {
    			self::redirecionaHTMLListar();
            }

		}

        $this->set('title_for_layout', 'Editar código HTML');


        $this->configCSRFGuard();

    }

    public function htmlEditarBasico()
    {

        if ($this->request->is('post')) {

            try {

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    self::htmlBasicoCabecalho();
                    self::htmlBasicoRodape();
                    $this->setMsgAlertSuccess('HTML da loja editado com sucesso.');

                }

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());
                //return $this->redirect(array('controller' => $this->request->controller, 'action' => 'html', 'listar'));

            }

        }

        try {

            $conditions = array(
                'fields' => array(
                    'ShopCode.conteudo'
                ),
                'conditions' => array(

                    'ShopCode.edit_basico' => 'cabecalho',
                    'ShopCode.id_shop_default' => $this->Session->read('id_shop')

                )
            );

            $this->dados = $this->ShopCode->find('first', $conditions);

            if (v::notEmpty()->validate($this->dados)) {
                $this->set('html_cabecalho', $this->dados['ShopCode']['conteudo']);
            }

            $conditions = array(
                'fields' => array(
                    'ShopCode.conteudo'
                ),

                'conditions' => array(

                    'ShopCode.edit_basico' => 'rodape',
                    'ShopCode.id_shop_default' => $this->Session->read('id_shop')

                )
            );

            $this->dados = $this->ShopCode->find('first', $conditions);

            if (v::notEmpty()->validate($this->dados)) {
                $this->set('html_rodape', $this->dados['ShopCode']['conteudo']);
            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        $this->configCSRFGuard();

    }

    private function htmlBasicoCabecalho()
    {

        $this->datasource = $this->ShopCode->getDataSource();

        try {

            $this->datasource->begin();

            /**
             *
             * array filtro
             *
             **/
            $conditions = array(

                "ShopCode.edit_basico = 'cabecalho'",
                "ShopCode.id_shop_default" => $this->Session->read('id_shop')

            );

            $this->ShopCode->deleteAll($conditions);

            if (isset($this->request->data['html_cabecalho']) && v::notEmpty()->validate($this->request->data['html_cabecalho'])) {

                $this->data = array(

                    'id_shop_default' => $this->Session->read('id_shop'),
                    'descricao' => 'Código do cabeçalho',
                    'local_publicacao' => 'cabecalho',
                    'tipo' => 'html',
                    'pagina_publicacao' => 'todas',
                    'conteudo' => Tools::htmlentitiesUTF8($this->request->data['html_cabecalho']),
                    'edit_basico' => 'cabecalho',
                    'time' => time()

                );

                $this->ShopCode->saveAll($this->data);

            }

            $this->datasource->commit();

        }
        catch (\PDOException $e) {

            $this->datasource->rollback();
            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

    private function htmlBasicoRodape()
    {

        $this->datasource = $this->ShopCode->getDataSource();

        try {

            $this->datasource->begin();

            /**
             *
             * array filtro
             *
             **/
            $conditions = array(

                "ShopCode.edit_basico = 'rodape'",
                "ShopCode.id_shop_default" => $this->Session->read('id_shop')

            );

            $this->ShopCode->deleteAll($conditions);


            if (isset($this->request->data['html_rodape']) && v::notEmpty()->validate($this->request->data['html_rodape'])) {

                $this->data = array(

                    'id_shop_default' => $this->Session->read('id_shop'),
                    'descricao' => 'Código do rodapé',
                    'local_publicacao' => 'rodape',
                    'tipo' => 'html',
                    'pagina_publicacao' => 'todas',
                    'conteudo' => Tools::htmlentitiesUTF8($this->request->data['html_rodape']),
                    'edit_basico' => 'rodape',
                    'time' => time()

                );

                $this->ShopCode->saveAll($this->data);

            }

            $this->datasource->commit();

        }
        catch (\PDOException $e) {

            $this->datasource->rollback();
            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

    public function htmlRemover()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopCode->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    if ($this->request->data['confirmacao'] == 'confirmacao') {

                        $this->id_code = intval(Tools::getValue('id_code'));

                        $conditions = array(
                            'conditions' => array(
                                'ShopCode.id_shop_default' => $this->Session->read('id_shop'),
                                'ShopCode.id_code' =>  $this->id_code
                            )
                        );

                        if ($this->ShopCode->find('count', $conditions) > 0) {

                            $this->ShopCode->id =  $this->id_code;
                            if ($this->ShopCode->delete()) {
                                $this->setMsgAlertSuccess('Código removido com sucesso');
                                self::redirecionaHTMLListar();
                            }

                        } else {

                            throw new \RuntimeException();

                        }

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                \Exception\VialojaDatabaseException::errorHandler($e);
                self::redirecionaHTMLListar();

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

                self::redirecionaHTMLListar();

            } catch (\RuntimeException $e) {

				$this->setMsgAlertError(ERROR_PROCESS);
				self::redirecionaHTMLListar();

			}

        }

        try {

            if (empty($this->request->params['pass']['2'])) {
                throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
            }

            if (!v::numeric()->notBlank()->validate($this->request->params['pass']['2'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            $conditions = array(
                'fields' => array(
                    'ShopCode.id_code',
                    'ShopCode.descricao'
                ),
                'conditions' => array(
                    'ShopCode.id_shop_default' => $this->Session->read('id_shop'),
                    'ShopCode.id_code' => $this->request->params['pass']['2']
                )
            );

            $this->ShopCode->id = $this->request->params['pass']['2'];

            if ($this->ShopCode->exists()) {

                $result = $this->ShopCode->find('all', $conditions);

                if (!v::notEmpty()->validate($result)) {
                    throw new \NotFoundException(ERROR_NOT_FOUND, 1);
                }

                $this->set('result_code', $result);

            } else {
                throw new \NotFoundException(ERROR_NOT_FOUND, 1);
            }

        } catch (\PDOException $e) {

            $this->setMsgAlertError($e->getMessage());
            $this->errorException = true;
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\NotFoundException $e) {

            $this->setMsgAlertError($e->getMessage());
            $this->errorException = true;

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());
            $this->errorException = true;

        } finally {

            if ($this->errorException !== false ) {

                self::redirecionaHTMLListar();

            }

        }

        $this->set('title_for_layout', 'Remover código?');


        $this->configCSRFGuard();

    }

    public function importarModelo_xls()
    {

        $this->layout = false;

        try {

            $this->set('modelo', $this->ModeloProdutoImportar->obterModeloImportar());

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

    /*
    public function facebook()
    {

        $this->set('title_for_layout', 'Loja no Facebook');

    }


    public function facebookDesinstalar()
    {

        $this->set('title_for_layout', 'Remover aplicativo?');

    }

    public function facebookInstalar()
    {

    }

     */

    /*

    public function mercadolivre()
    {

        $this->set('title_for_layout', 'Seu MercadoLivre');

    }

    public function mercadolivreIntegrada()
    {

        $this->set('title_for_layout', 'Seu MercadoLivre');

    }

    public function mercadolivreInstalar()
    {

        $this->set('title_for_layout', 'Seu MercadoLivre');

    }

    public function mercadolivreConfiguracoes()
    {

        $this->set('title_for_layout', 'Seu MercadoLivre');

    }

    public function mercadolivreProdutosListar()
    {

        $this->set('title_for_layout', 'Resumo da integração');

    }

    public function mercadolivreProdutosIntegrar()
    {

        $this->set('title_for_layout', 'Integração de produtos');

    }

    public function mercadolivrePerguntasListar()
    {

        $this->set('title_for_layout', 'Perguntas Mercado livre');

    }

    */

    public function atualizarArquivo_xls() {

		$this->layout = false;

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }

		$this->set('produtos', $this->requestAction(
			array(
				'controller' => 'ShopProduto',
				'action' => 'getProdutoImportar'
			)
		));

        $result = $this->ShopDominio->virtualUri($this->Sshop);

        $this->set('nome_arquivo', Tools::slug($result['ShopDominio']['virtual_uri']));

    }

    /**
     * Validar url
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function urlValidar()
    {

        try {

            if (!$this->request->is('post')) {
                throw new \InvalidArgumentException();
            }

            if (!$this->request->is('ajax')) {
                throw new \InvalidArgumentException();
            }

            $this->json['sucesso'] = true;

            if (!Validate::isDomainName(Tools::getValue('url'))) {
                $this->json['url_valida'] = false;
            }

            $base_url = 'root';
            if ($this->Session->read('validar_base_url') =='produto'){
                $base_url = 'produto';
            }

            $conditions = array(
                'conditions' => array(
                    'ShopUrlUso.base_url' => $base_url,
                    'ShopUrlUso.url' => Tools::getValue('url')
                )
            );

            /**
             *
             * verifico se a url existe
             *
             **/
            if ($this->ShopUrlUso->find('count', $conditions) > 0) {
                $this->json['url_valida'] = false;
            } else {
                $this->json['url_valida'] = true;
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\InvalidArgumentException $e) {
            return false;
        } finally {
            header('Content-Type: application/json');
            echo stripslashes(json_encode($this->json));
            $this->layout = false;
            $this->render(false);
            exit();
        }



    }

    /**
     * Arquivo da loja no area de cadastro produto
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function arquivoGaleria() {

        $this->layout = false;

        try {

            $this->diretorio_cdn = sprintf('%s%s/%s/',
                        CDN_UPLOAD,
                        $this->Session->read('id_shop'),
                        'arquivos'
            );

            $this->set('arquivo', $this->diretorio_cdn);

            $conditions = array(
                'fields' => array(
                    'ShopArquivo.tipo',
                    'ShopArquivo.nome',
                    'ShopArquivo.id_arquivo'
                ),

                'conditions' => array(
                    'ShopArquivo.tipo' => 'img',
                    'ShopArquivo.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            $this->set('result', $this->ShopArquivo->find('all', $conditions));



        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

    /**
     * Faz Upload de Arquivo da loja
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function galeriaUpload() {

        $this->set('title_for_layout', 'Enviar arquivo');

        $this->datasource = $this->ShopArquivo->getDataSource();

        try {

            $this->datasource->begin();

            if ($this->request->is('post')) {

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    $this->arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : false;

                    $this->file_name  = $this->arquivo['name'];
                    $this->file_temp  = $this->arquivo['tmp_name'];
                    $this->file_type  = $this->arquivo['type'];
                    $this->file_error = $this->arquivo['error'];

                    if (v::notEmpty()->validate($this->file_name) && v::notEmpty()->validate($this->file_temp)) {

                        if (!Validate::isFileGalery($this->arquivo)) {
                            throw new \InvalidArgumentException("O arquivo enviado é inválido, tipos de arquivo permitidos: JPG, PNG, GIF, CSS, JS e PDF.", E_USER_WARNING);
                        }

                        if (!Validate::isMaxSize($this->arquivo['size'], 1)) {
                            throw new \InvalidArgumentException("O arquivo enviado é muito grande, envie arquivos de no máximo 1Mb.", E_USER_WARNING);
                        }

                        /**
                        *
                        * Cria as pastas
                        *
                        **/

                        $this->diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'arquivos' . DS;

                        Tools::createFolder($this->diretorio);

                        //Aplica slug ao arquivo
                        $this->file_name_browser = $this->file_name;

                        $this->file_name = Tools::slugFile($this->file_name);

                        if (file_exists($this->diretorio . $this->file_name)) {
                            throw new \Exception\VialojaOverflowException("Atenção! Já existe um Arquivo com este nome: {$this->file_name_browser}", E_USER_WARNING);
                        }

                        if (!Validate::isTypeImage($this->file_type)) {

                            if (!Validate::isFileValidAuthorized($this->arquivo)) {
    							throw new \InvalidArgumentException(ERROR_FILE_INVALID, E_USER_WARNING);
    						}

                            $this->js = array(
                                'application/x-javascript',
                                'application/javascript',
                                'application/ecmascript',
                                'text/javascript',
                                'text/ecmascript'
                            );

                            $this->css = array(
                                'application/x-pointplus',
                                'text/css'
                            );

                            $this->pdf = array(
                                'application/pdf',
                                'application/x-pdf'
                            );

                            if( in_array($this->file_type, $this->js) ) {
                                $this->tipo = 'js' ;
                            } elseif( in_array($this->file_type, $this->css) ) {
                                $this->tipo = 'css' ;
                            } elseif( in_array($this->file_type, $this->pdf) ) {
                                $this->tipo = 'pdf' ;
                            }

                            move_uploaded_file($this->file_temp, $this->diretorio . $this->file_name);

                        } else {

                            if (!Validate::isImage($this->arquivo)) {
                                throw new \InvalidArgumentException("Atenção! Há um erro nesta imagem \"{$this->file_name}\" e o processo de envio foi cancelado.", E_USER_WARNING);
                            }

                            $this->tipo = 'img';

                            $thickbox = $this->diretorio . 'thickbox' . DS;
                            Tools::createFolder($thickbox);

                            $this->small = $this->diretorio . 'small' . DS;
                            Tools::createFolder($this->small);

                            //Move o original
                            move_uploaded_file($this->file_temp, $this->diretorio . $this->file_name);

                            $this->original = WideImage::load($this->diretorio . $this->file_name);

                            // thickbox Tamanho 800 x 800
                            move_uploaded_file($this->file_temp, $thickbox . $this->file_name);
                            $this->original->resize(800, 800, 'inside')->saveToFile($thickbox . $this->file_name);

                            // small Tamanho 98 x 98
                            move_uploaded_file($this->file_temp, $this->small . $this->file_name);
                            $this->original->resize(98, 98, 'inside')->saveToFile($this->small . $this->file_name);
                            $this->original->destroy();

                        }

                        $this->data = array(
                            'id_shop_default' => $this->Session->read('id_shop'),
                            'nome' => $this->file_name,
                            'tipo' => $this->tipo
                        );

                        if ($this->ShopArquivo->saveAll($this->data)) {

                            $this->setMsgAlertSuccess('Arquivo enviado com sucesso!');

                            return $this->redirect(array(
                                'controller' => $this->request->controller,
                                'action' => 'galeria',
                                'listar'
                            ));

                        } else {

                            /**
                            *
                            * Remove em caso de erro os arquivos
                            *
                            **/

                            $this->pastas = array(
                                'small',
                                'thickbox'
                            );

                            foreach ($this->pastas as $this->key => $this->pasta) {
                                Tools::deleteFile($this->diretorio . DS . $this->pasta . DS . $this->file_name);
                            }

                            Tools::deleteFile($this->diretorio . DS . $this->file_name);

                            throw new \RuntimeException('Houve um erro na tentativa de salvar o arquivo. <br />Por favor, tente novamente!');

                        }

                    }

                }

                $this->datasource->commit();

            }

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\NotFoundException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\Exception\VialojaOverflowException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError($e->getMessage());

            return $this->redirect(array(
                'controller' => $this->request->controller,
                'action' => 'galeria',
                'listar'
            ));

        }


        $this->configCSRFGuard();

    }

    /**
     * Lista os Arquivo da loja
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function galeriaListar() {

        $this->set('title_for_layout', 'Listar Arquivos');

        try {

            $this->diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'arquivos' . DS;
            $this->set('diretorio', $this->diretorio);

            $this->diretorio_cdn = sprintf('%s%s/%s/',
                        CDN_UPLOAD,
                        $this->Session->read('id_shop'),
                        'arquivos'
            );

            $this->set('arquivo', $this->diretorio_cdn);

            $limite = 15;
            $this->set('limite', $limite);

            $conditions = array(
                'fields' => array(
                    'ShopArquivo.tipo',
                    'ShopArquivo.nome',
                    'ShopArquivo.id_arquivo'
                ),
                'conditions' => array(
                    'ShopArquivo.id_shop_default' => $this->Session->read('id_shop')
                ),
                'limit' => $limite,
				'paramType' => 'querystring'
            );

            $this->paginate = $conditions;

            // Roda a consulta, já trazendo os resultados paginados
            $result = $this->paginate('ShopArquivo');
            $this->set('result', $result);

        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        }



    }

    /**
     * Remove Arquivo da loja
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function galeriaRemover() {

        $this->set('title_for_layout', 'Remover arquivo');

        $this->datasource = $this->ShopArquivo->getDataSource();

        try {

            $this->datasource->begin();

            if (empty($this->request->params['pass']['2'])) {
                throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
            }

            if (!v::numeric()->notBlank()->validate($this->request->params['pass']['2'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            $conditions = array(
                'fields' => array(
                    'ShopArquivo.nome'
                ),

                'conditions' => array(
                    'ShopArquivo.id_arquivo' => $this->request->params['pass']['2'],
                    'ShopArquivo.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ShopArquivo->find('count', $conditions) <= 0 ) {
                throw new \NotFoundException('Arquivo não encontrado!', E_USER_WARNING);
            }

            $this->dados = $this->ShopArquivo->find('first', $conditions);

            //Recebe o Post
            self::postGaleriaRemover();

            $this->set('result', $this->dados);

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

            return $this->redirect(array(
                'controller' => $this->request->controller,
                'action' => 'galeria',
                'listar'
            ));

        } catch (\NotFoundException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);

            return $this->redirect(array(
                'controller' => $this->request->controller,
                'action' => 'galeria',
                'listar'
            ));

        }


        $this->configCSRFGuard();

    }

    private function postGaleriaRemover()
    {

        if ($this->request->is('post')) {

            /**
             *
             * Verifica o token CSRFGuard
             *
             **/

            $CSRFGuard = new CSRFGuard();

            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

            } else {

                $this->ShopArquivo->id = $this->request->params['pass']['2'];

                if ($this->ShopArquivo->exists()) {

                    if ($this->ShopArquivo->delete()) {

                        $this->diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'arquivos' . DS;

                        $this->pastas = array(
                            'small',
                            'thickbox'
                        );

                        foreach ($this->pastas as $this->key => $this->pasta) {
                            Tools::deleteFile($this->diretorio . DS . $this->pasta . DS . $this->dados['ShopArquivo']['nome']);
                        }

                        Tools::deleteFile($this->diretorio . DS . $this->dados['ShopArquivo']['nome']);
                        $this->setMsgAlertSuccess('Arquivo excluído com sucesso!');

                        return $this->redirect(array(
                            'controller' => $this->request->controller,
                            'action' => 'galeria',
                            'listar'
                        ));

                    } else {

                        throw new \RuntimeException();

                    }

                }

            }

        }

    }

    /**
     * Lista de email
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function newsletterAssinatura() {

        $this->set('title_for_layout', 'Email Marketing');

        try {

            $this->set('url_shop', self::getDominio());

            $conditions = array(
                'conditions' => array(
                    'ClienteNewsletterShop.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            $this->set('total', $this->ClienteNewsletterShop->find('count', $conditions) );

        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        }



    }

    /**
     * Exporta os email
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function newsletterExportar() {

        $this->layout = false;
        $this->render(false);

        try {

            ignore_user_abort(true);
            set_time_limit(0);

            if (!isset($this->request->params['ext'])) {

                throw new \InvalidArgumentException();
            }

            $this->diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'exportados'. DS .'newsletter' . DS;

            /**
            *
            * Deleta registros antigos
            *
            **/
            $this->date = strtotime('-4 hours', time());
            foreach(glob($this->diretorio .'*.txt') as $this->file)
            {
                $this->filetime = filemtime($this->file);

                if ($this->date > $this->filetime) {
                    //Deleta Arquivo antigo se existir
                    Tools::deleteFile($this->file);
                }

            }

            $this->output = true;

            switch ($this->request->params['ext']) {

                 case 'txt':

                    $this->formato = 'email_marketing_txt.txt';
                    $this->file = $this->diretorio . $this->formato;

                    if( file_exists( $this->file ) ) {
                        $this->filetime = filemtime($this->file);
                        if ($this->date <= $this->filetime) {
                            $this->output = false;
                        }
                    }

                    break;

                default:

                    $this->formato = 'email_marketing_csv.txt';
                    $this->file = $this->diretorio . $this->formato;

                    if( file_exists( $this->file ) ) {
                        $this->filetime = filemtime($this->file);
                        if ($this->date <= $this->filetime) {
                            $this->output =false;
                        }
                    }

                    break;

            }

            //Libera a criaçao de novo arquivo apos 24 horas
            if ($this->output !== false) {

                $conditions = array(

                    'fields' => array(

                        'Cliente.nome',
                        'Cliente.email',
                        'ClienteNewsletterShop.id',
                        'ClienteNewsletterShop.id_cliente_default',
                        'ClienteNewsletterShop.id_shop_default'

                    ),
                    'conditions' => array(
                        'ClienteNewsletterShop.id_shop_default' => $this->Session->read('id_shop')
                    ),

                    'group' => array('ClienteNewsletterShop.id_cliente_default'), //fields to GROUP BY

                    'joins' => array(
                        array('table' => 'cliente',
                            'alias' => 'Cliente',
                            'type' => 'INNER',
                            'conditions' => array(
                                'ClienteNewsletterShop.id_cliente_default = Cliente.id_cliente',
                            )
                        )

                    )

                );

                switch ($this->request->params['ext']) {

                    case 'txt':

                        $this->res_news = $this->ClienteNewsletterShop->find('all', $conditions );
                        $this->handle = fopen($this->file, 'w');

                        foreach ($this->res_news as $this->news) {

                            if(filter_var($this->news['Cliente']['email'], FILTER_VALIDATE_EMAIL)){
                                fwrite($this->handle, sprintf("%s %s\n", $this->news['Cliente']['email'], Tools::firstName($this->news['Cliente']['nome'])));
                            }

                        }

                        fclose($this->handle);
                        break;

                    default:

                        $this->res_news = $this->ClienteNewsletterShop->find('all', $conditions );
                        $this->handle = fopen($this->file, 'w');

                        foreach ($this->res_news as $this->news) {

                            if(filter_var($this->news['Cliente']['email'], FILTER_VALIDATE_EMAIL)){
                                fwrite($this->handle, sprintf("%s, %s\n", $this->news['Cliente']['email'], Tools::firstName($this->news['Cliente']['nome'])));
                            }

                        }

                        fclose($this->handle);
                        break;

                }

            }

            if ($this->request->params['ext'] == 'txt') {
                $this->output = sprintf('email_marketing_%s.txt', date('d-m-Y'));
            } else {
                $this->output = sprintf('email_marketing_%s.csv', date('d-m-Y'));
            }

            //output
            $this->response->file($this->diretorio.$this->formato, array(
                'download' => true,
                'name' =>  $this->output
            ));

            return $this->response;

        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);
            return $this->redirect($this->referer());

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            return $this->redirect($this->referer());

        } catch (\RuntimeException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);
            return $this->redirect($this->referer());

		}

    }

}
