<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class ProdutoController extends AppController {

	public $uses = array('ShopProduto', 'ShopProdutoImagem', 'ShopProdutoVisualizado', 'ShopProdutoHits');

	public $layout = 'default-store';
	public $html;
	private $id_produto;
	private $url_video_youtube;

	/**
	 * Visualização de dados de produto
	 * @access public
	 * @param String $slug
	 * @param Array $conditions
	 */
	public function visualizar() {


		if (isset($this->request->params['pass']['1'])) {

			self::getConfiguracoes();

			$this->id_produto =  intval( Tools::clean( $this->request->params['pass']['1'] ) );

			if (!is_numeric($this->id_produto)) {
				return $this->redirect( array('controller' => 'default', 'action' => 'index') );
			}

			/**
			*
			* verifica se é bot
			*
			**/
	        if (!Validate::isBot()) {

				/**
				*
				* Add id de produtos visualizados
				*
				**/
				self::add_produto_id();

			}

			/**
			 * Recupera dados dos produtos
			 */
           	self::getIdProduto();


			 /**
            *
            * Recupera as images do produto
            *
            **/
			$GLOBALS['html_images_produto'] = self::get_images_produto();

        }

		$this->set('title_for_layout', 'Produto xxx');

		define('PRODUTO_SHOP_LOJA', true);
		define('SHOW_CATEGORIAS_MAIN_NAV', true);


		$this->configCSRFGuard();

	}

	/**
	 * Start id de dominio Main
	 * Pega o ID do shop via dominio e armazena na Session id_shop_url
	 * @access private
	 * @param String $url
	 * @return string
	 */
	private function getConfiguracoes()
	{

		if (defined('VITRINE_SHOPPING_VIALOJA')) {

			$this->layout = 'default-vitrine-vialoja';

		} else {

			//define('HOME_SHOP_LOJA', true);
			$this->layout = 'default-store';

			$this->requestAction(
				array(
					'controller' => 'Configuracoes',
					'action' => 'init'
				)
			);

		}

	}

	/**
	 * Add id do produto em cookie para mostrar últimos visualizados
	 * @param int $id_produto Id do produto
	 */
	private function add_produto_id()
	{

		try {

			if (isset($this->id_produto)) {

				if (isset($_COOKIE['__vialoja'])) {

					if (!Validate::isSessionId($_COOKIE['__vialoja'])) {
						$session_id = $this->Session->id();
					} else {
						$session_id = $this->Session->id($_COOKIE['__vialoja']);
					}

				} else {
					$session_id = $this->Session->id();
				}

				$this->cookieViaLoja()->_setcookieLastProductView($this->id_produto, $session_id);

				$conditions = array(
					'conditions' => array(
						'ShopProdutoVisualizado.id_produto_default' => $this->id_produto,
						'ShopProdutoVisualizado.id_shop_default' => ID_SHOP_DEFAULT,
						'ShopProdutoVisualizado.session_id' => $session_id
					)
				);

				if ($this->ShopProdutoVisualizado->find('count', $conditions) <= 0) {

					$this->data = array(
						'id_produto_default' => $this->id_produto,
						'id_shop_default' => ID_SHOP_DEFAULT,
						//'id_cliente_default' => $id_cliente_default,
						'session_id' => $session_id,
					);

					$this->ShopProdutoVisualizado->save($this->data);

				}

				$this->ShopProdutoVisualizado->deleteAll(array(
					'DATE(ShopProdutoVisualizado.created) <= DATE_SUB(CURDATE(), INTERVAL 45 DAY)'
				));

				$conditions = array(
					'conditions' => array(
						'ShopProdutoHits.id_produto_default' => $this->id_produto,
						'ShopProdutoHits.id_shop_default' => ID_SHOP_DEFAULT,
					)
				);

				if ($this->ShopProdutoHits->find('count', $conditions) <= 0) {

					$this->data = array(
						'id_produto_default' => $this->id_produto,
						'id_shop_default' => ID_SHOP_DEFAULT,
					);

					$this->ShopProdutoHits->save($this->data);

				} else {

					$fields = array(
						'ShopProdutoHits.hits' => 'ShopProdutoHits.hits+1'
					);

					$conditions = array(
						'id_produto_default' => $this->id_produto,
					);

					$this->ShopProdutoHits->updateAll($fields, $conditions);

				}

			}

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

	private function getIdProduto()
	{
		try {

			$conditions = array(

                /*
                'fields' => array(
                    'ShopProduto.id_produto'
                ),
                */
                'conditions' => array(
                    'ShopProduto.parente_id'      => 0,
                    'ShopProduto.ativo'           => 'True',
                    'ShopProduto.id_produto'      => $this->id_produto,
                    'ShopProduto.id_shop_default' => ID_SHOP_DEFAULT
                )
            );

            if ($this->ShopProduto->find('count', $conditions) <=0 ) {

            	/*
                $this->Session->setFlash(__('Nenhum produto foi encontrado!'), 'alert-box', array(
                    'class' => 'note-msg'
                ));
                */

            }

            $dados = $this->ShopProduto->find('first', $conditions);

            $GLOBALS['ShopProduto']['produto_id']          = $this->id_produto;
            $GLOBALS['ShopProduto']['nome']                = $dados['ShopProduto']['nome'];
            $GLOBALS['ShopProduto']['descricao_completa']  = $dados['ShopProduto']['descricao_completa'];
            $GLOBALS['ShopProduto']['url_video_youtube']   = $dados['ShopProduto']['url_video_youtube'];
            $this->url_video_youtube                       = $dados['ShopProduto']['url_video_youtube'];
            $GLOBALS['ShopProduto']['situacao_em_estoque'] = $dados['ShopProduto']['situacao_em_estoque'];
            $GLOBALS['ShopProduto']['preco_promocional']   = $dados['ShopProduto']['preco_promocional'];
            $GLOBALS['ShopProduto']['preco_cheio']         = $dados['ShopProduto']['preco_cheio'];
            $GLOBALS['ShopProduto']['sku']                 = $dados['ShopProduto']['sku'];
            $GLOBALS['ShopProduto']['peso']                = $dados['ShopProduto']['peso'];
            $GLOBALS['ShopProduto']['altura']              = $dados['ShopProduto']['altura'];
            $GLOBALS['ShopProduto']['largura']             = $dados['ShopProduto']['largura'];
            $GLOBALS['ShopProduto']['comprimento']         = $dados['ShopProduto']['comprimento'];
            $GLOBALS['ShopProduto']['produto_key']         = $dados['ShopProduto']['produto_key'];

            $GLOBALS['marca'] = $this->requestAction(
				array(
					'controller' => 'ShopMarca',
					'action' => 'getIdMarca',
					'id' => $dados['ShopProduto']['id_marca']
				)
			);

		} catch (PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
        }

	}

	/**
	 * Recupera a images do produto
	 * @param  int $id_produto ID do produto
	 * @return string
	 */
	private function get_images_produto()
	{

		$nome_imagem = $this->ShopProdutoImagem->getImagemPrincipal( $this->id_produto );



		$url_img = CDN .'static/img/imagem-padrao/home/produto-sem-imagem.gif';
		$url_img_large = CDN .'static/img/imagem-padrao/home/produto-sem-imagem.gif';

		if (!empty($nome_imagem)) {

			$url_root = sprintf( '%s%d%sproduto%s%d%shome%s%s',
				CDN_ROOT_UPLOAD,
				ID_SHOP_DEFAULT,
				DS,
				DS,
				$this->id_produto,
				DS,
				DS,
				$nome_imagem
			);

			if (is_file($url_root)) {

				$url_img = sprintf( '%s%d/produto/%d/large/%s',
					CDN_UPLOAD,
					ID_SHOP_DEFAULT,
					$this->id_produto,
					$nome_imagem
				);

				$url_img_large = sprintf( '%s%d/produto/%d/thickbox/%s',
					CDN_UPLOAD,
					ID_SHOP_DEFAULT,
					$this->id_produto,
					$nome_imagem
				);

			}

		}

		$this->html = '<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 product-img-box">

	    <div class="image">
	        <span class="new-icon"><span>Novo</span></span>
	        <span class="onsale"><span>Oferta</span></span>
	        <a href="'. $url_img .'" title="Farlap Shirt - Ruby Wines" class="colorbox">
	        	<img id="image" src="'. $url_img_large .'" alt="Farlap Shirt - Ruby Wines" title="Farlap Shirt - Ruby Wines" data-zoom-image="'. $url_img_large .'" class="product-image-zoom"/>
	        </a>
	    </div>';

	    /*<div style="font-size:11px; color:#999">Imagem meramente ilustrativa</div>*/

	    $res_produto_imagem = $this->ShopProdutoImagem->getImagemAll($this->id_produto);

		if (Validate::isNotNUll($res_produto_imagem)) {

	    	$this->html .= '<div id="image-additional" class="image-additional slide carousel more-views">
	        <div class="carousel-inner" id="image-gallery-zoom">';

            $this->html .= '<div class="item row">';


        	$res_produto_imagem1 = array();
        	foreach ($res_produto_imagem as $key => $value) {

        		if ($key>0) {
        			# code...
        			array_push($res_produto_imagem1, $value);
        		}
        	}

        	$res_produto_imagem2 = array();
        	foreach ($res_produto_imagem as $key => $value) {

        		if ($key==0) {
        			# code...
        			array_push($res_produto_imagem2, $value);
        		}
        	}

        	$result_images = array_merge($res_produto_imagem1, $res_produto_imagem2);

            foreach ($res_produto_imagem as $key_img => $dados) {

            	$nome_imagem = $dados['ShopProdutoImagem']['nome_imagem'];
            	$url_img_small = CDN .'static/img/imagem-padrao/small/produto-sem-imagem.gif';
				$url_img_large = CDN .'static/img/imagem-padrao/home/produto-sem-imagem.gif';

				if (!empty($nome_imagem)) {

					$url_root = sprintf( '%s%d%sproduto%s%d%shome%s%s',
						CDN_ROOT_UPLOAD,
						ID_SHOP_DEFAULT,
						DS,
						DS,
						$this->id_produto,
						DS,
						DS,
						$nome_imagem
					);

					if (is_file($url_root)) {

						$url_img_small = sprintf( '%s%d/produto/%d/small/%s',
							CDN_UPLOAD,
							ID_SHOP_DEFAULT,
							$this->id_produto,
							$nome_imagem
						);

						$url_img_large = sprintf( '%s%d/produto/%d/thickbox/%s',
							CDN_UPLOAD,
							ID_SHOP_DEFAULT,
							$this->id_produto,
							$nome_imagem
						);

					}

				}

                if($key_img > 0 && $key_img%4 === 0){
                    $this->html .= '</div><div class="item row">';
                }

                $this->html .= '<a href="'. $url_img_large .'" title="" class="colorbox" data-zoom-image="'. $url_img_large .'" data-image="'. $url_img_large .'">
                    <img src="'. $url_img_small .'"  title="" alt="" data-zoom-image="'. $url_img_large .'" class="product-image-zoom" />
                </a>';

            }

            $this->html .= '</div>' . PHP_EOL;

			$this->html .= '</div>
		        <a class="carousel-control left" href="#image-additional" data-slide="prev">&lsaquo;</a>
		        <a class="carousel-control right" href="#image-additional" data-slide="next">&rsaquo;</a>
		    </div>

		    <script type="text/javascript">
		        jQuery(\'#image-additional .item:first\').addClass(\'active\');
		        jQuery(\'#image-additional\').carousel({interval:false})
		    </script>';

		}

		if (isset($this->url_video_youtube) && $this->url_video_youtube) {

			$this->html .= '<div class="item row">

				<div class="produto-video borda-alpha">
		            <div>
		              	<p>Clique no botão ao lado para assistir o video relacionado ao produto.</p>
		            </div>
		            <a href="#myModalVideo" role="button" data-toggle="modal" class="botao-video">
		              	<i class="fa fa-youtube-play cor-principal"></i>
		              	<span>Assistir Video</span>
		            </a>
	          	</div>

			</div>';

			$this->html .= '<!-- Modal -->
			<div class="modal fade" id="myModalVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Vídeo</h4>
			      </div>
			      <div class="modal-body">
			        <iframe src="http://youtube.com/embed/'. Tools::YoutubeID( $this->url_video_youtube ) .'" width="560" height="315" frameborder="0" id="playerVideo"></iframe>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			      </div>
			    </div>
			  </div>
			</div>
			<script type="text/javascript">
			      $("#myModalVideo").on(\'hidden\', function() {
			        var src = $(\'#playerVideo\').attr(\'src\');
			        $(\'#playerVideo\').attr(\'src\', \'\');
			        $(\'#playerVideo\').attr(\'src\', src);
			      });
			    </script>';

		}

		$this->html .= '<script type="text/javascript" src="/superstore/js/venustheme/ves_tempcp/jquery/elevatezoom/elevatezoom-min.js"></script>

		    <script type="text/javascript">
		        jQuery("#image").elevateZoom({
		                 gallery:\'image-gallery-zoom\',
		           cursor: \'pointer\',
		           lensShape : "basic",
		           lensSize    : 150,
		           galleryActiveClass: \'active\'});

		    </script>

		    <script type="text/javascript">
		        <!--
		        jQuery(document).ready(function() {
		          jQuery(\'.colorbox\').colorbox({
		            width: \'800\',
		            height: \'600\',
		            overlayClose: true,
		            opacity: 0.5,
		            rel: "colorbox"
		          });
		          jQuery(\'#image-gallery-zoom\').find("a").click(function(){
		            if(jQuery(".product-img-box .image a").length > 0) {
		              var image_link = jQuery(this).attr("href");
		              jQuery(".product-img-box .image a").attr("href", image_link);
		            }
		          })
		        });
		        //-->
		    </script>
		</div>';

		return $this->html;

	}

	/**
     * Configurações de Segurança
     */
    private function configCSRFGuard()
    {

        $GLOBALS['CSRFGuardName'] = null;
		$GLOBALS['CSRFGuardToken'] = null;

		$CSRFGuardName = null;
		$CSRFGuardToken = null;

        /**
         *
         * verifica se é bot
         *
         **/
        if (!Validate::isBot())
        {

            $CSRFGuard = new CSRFGuard();

            $CSRFGuardName = "CSRFGuard_".mt_rand(0,mt_getrandmax());
            $CSRFGuardToken = $CSRFGuard->csrfguard_generate_token($CSRFGuardName);

            $this->set(compact('CSRFGuardName'));
            $this->set(compact('CSRFGuardToken'));

            $GLOBALS['CSRFGuardName'] = $CSRFGuardName;
            $GLOBALS['CSRFGuardToken'] = $CSRFGuardToken;

        }

    }

}
