<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class ShopCategoriaController extends AppController
{

    public $uses = array('ShopCategoria');

	private $conditions;
	private $result;

    /*
     * Lista as categoria shop na Option
     * @access public
     * @param String id_shop
     * @param String $data
     */
    public function categoriaListaOption($categoria_parent_id = 0)
    {

        try {

            // Construir a nossa lista de categorias de uma só vez
            static $cats;

            if (!is_array($cats)) {

                /*
                 * Verifica se a página já existe
                 */
                $this->conditions = array(

                    'fields' => array(
                        'ShopCategoria.id_categoria',
                        'ShopCategoria.nome_categoria',
                        'ShopCategoria.categoria_parent_id',
                        'ShopCategoria.nleft'
                    ),
                    'conditions' => array(
                        'ShopCategoria.id_shop_default' => ID_SHOP_DEFAULT
                    ),
                    'order' => array(
                        'ShopCategoria.nome_categoria' => 'ASC'
                    )

                );

                $this->result = $this->ShopCategoria->find('all', $this->conditions);

                if (!Validate::isNotNull($this->result)) {
                    return false;
                }

                $cats = array();
                foreach ($this->result as $key => $cat) {
                    array_push($cats, $cat);
                }

            }


            // Preencher uma lista de matriz itens
            $lista_itens = array();

            foreach ($cats as $cat) {

                // if não do tipo inteiro, seguir em frente
                if (( int ) $cat['ShopCategoria']['categoria_parent_id'] !== ( int ) $categoria_parent_id) {
                    continue;
                }

                $selected='';
                if (isset($this->params['named']['id_categoria_default'])) {
                   // abra o item da lista
                    if (!(strcmp($this->params['named']['id_categoria_default'], $cat['ShopCategoria']['id_categoria']))) {
                        $selected ='selected="selected"';
                    }
                }

                if ($cat['ShopCategoria']['nleft'] ==0) {

                    $lista_itens[] = '<option '. $selected .' style="background-color:#F5F5F5;" value="' . $cat['ShopCategoria']['id_categoria'] . '">';

                } else {

                    $lista_itens[] = '<option '. $selected .' value="' . $cat['ShopCategoria']['id_categoria'] . '">';

                }

                $lista_itens[] = '';
                for ($i = 0; $i < $cat['ShopCategoria']['nleft']; $i++) {
                    $lista_itens[] = '&nbsp;&nbsp;&nbsp;';
                }

                // construir o link da categoria
                $lista_itens[] = $cat['ShopCategoria']['nome_categoria'];

                // fechar o item da lista
                $lista_itens[] = '</option>' . PHP_EOL;

                // recurse na lista de filhos
                $lista_itens[] = $this->categoriaListaOption($cat['ShopCategoria']['id_categoria']);

            }

            // converter para uma string
            $lista_itens = implode('', $lista_itens);

            // if vazio, sem os itens da lista!
            if ('' == trim($lista_itens)) {
                return '';
            }

            return $lista_itens;

        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    /*
     * Lista as categoria em menu MainNav
     * @access public
     * @param String id_shop
     */
    public function categoriaListaMainNav($categoria_parent_id = 0)
    {

        try {

            // Construir a nossa lista de categorias de uma só vez
            static $cats;

            if (!is_array($cats)) {

                /*
                 * Verifica se a página já existe
                 */
                $this->conditions = array(

                    'fields' => array(
                        'ShopCategoria.id_categoria',
                        'ShopCategoria.nome_categoria',
                        'ShopCategoria.url',
                        'ShopCategoria.ativa',
                        'ShopCategoria.categoria_parent_id',
                        'ShopCategoria.nleft'
                    ),
                    'conditions' => array(
                        'ShopCategoria.id_shop_default' => ID_SHOP_DEFAULT
                    ),
                    'order' => array(
                        'ShopCategoria.posicao' => 'ASC',
                        'ShopCategoria.nome_categoria' => 'ASC'
                    )

                );

                $this->result = $this->ShopCategoria->find('all', $this->conditions);

                if (!Validate::isNotNull($this->result)) {
                    return false;
                }

                $cats = array();
                foreach ($this->result as $key => $cat) {
                    array_push($cats, $cat);
                }

            }

            // Preencher uma lista de matriz itens
            $lista_itens = array();

            foreach ($cats as $cat) {

                // if não do tipo inteiro, seguir em frente
                if (( int ) $cat['ShopCategoria']['categoria_parent_id'] !== ( int ) $categoria_parent_id) {
                    continue;
                }

                // abra o item da lista
                if ($cat['ShopCategoria']['nleft'] <= 0) {

                    $lista_itens[] = '<li class="   " ><a href="'. sprintf('%s/c/%s/%d/', FULL_BASE_URL, Tools::slug( $cat['ShopCategoria']['nome_categoria'] ), $cat['ShopCategoria']['id_categoria'] ) .'" title="'. $cat['ShopCategoria']['nome_categoria'] .'"><span class="menu-title">'. $cat['ShopCategoria']['nome_categoria'] .'</span></a></li>' . PHP_EOL;

                } else {

                    $lista_itens[] = '<li class="   " ><a href="'. sprintf('%s/c/%s/%d/', FULL_BASE_URL, Tools::slug( $cat['ShopCategoria']['nome_categoria'] ), $cat['ShopCategoria']['id_categoria'] ) .'" title="'. $cat['ShopCategoria']['nome_categoria'] .'"><span class="menu-title">&nbsp;&nbsp;&nbsp;&nbsp;'. $cat['ShopCategoria']['nome_categoria'] .'</span></a></li>' . PHP_EOL;

                }

                $lista_itens[] = '<ul>';

                // recurse na lista de filhos
                $lista_itens[] = self::categoriaListaMainNav($cat['ShopCategoria']['id_categoria']);

                $lista_itens[] = '</ul>';

                $lista_itens[] = '</li>';


            }

            // converter para uma string
            $lista_itens = implode('', $lista_itens);

            // if vazio, sem os itens da lista!
            if ('' == trim($lista_itens)) {
                return '';
            }

            return $lista_itens;

        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    /*
     * Lista as categoria no painel admin
     * @access public
     * @param String id_shop
     * @param String $data
     */
    public function categoriaListarLeft($categoria_parent_id = 0)
    {

        try {

            // Construir a nossa lista de categorias de uma só vez
            static $cats;

            if (!is_array($cats)) {

                /*
                 * Verifica se a página já existe
                 */
                $this->conditions = array(

                    'fields' => array(
                        'ShopCategoria.id_categoria',
                        'ShopCategoria.nome_categoria',
                        'ShopCategoria.url',
                        'ShopCategoria.categoria_parent_id',
                        'ShopCategoria.nleft'
                    ),
                    'conditions' => array(
                        'ShopCategoria.id_shop_default' => ID_SHOP_DEFAULT,
                        'ShopCategoria.ativa' => 'True'
                    ),
                    'order' => array(
                        'ShopCategoria.posicao' => 'ASC',
                        'ShopCategoria.nome_categoria' => 'ASC'
                    )

                );

                $this->result = $this->ShopCategoria->find('all', $this->conditions);

                if (!Validate::isNotNull($this->result)) {
                    return false;
                }

                $cats = array();
                foreach ($this->result as $key => $cat) {
                    array_push($cats, $cat);
                }

            }


            // Preencher uma lista de matriz itens
            $lista_itens = array();

            foreach ($cats as $cat) {

                // if não do tipo inteiro, seguir em frente
                if (( int ) $cat['ShopCategoria']['categoria_parent_id'] !== ( int ) $categoria_parent_id) {
                    continue;
                }

                // abra o item da lista
                if (self::categoriaPai($cat['ShopCategoria']['id_categoria']) !== true) {

                    $lista_itens[] = '<li class="category_level_'. $cat['ShopCategoria']['nleft'] .'">' . PHP_EOL;
                    $lista_itens[] = '<a href="'. sprintf('%s/c/%s/%d/', FULL_BASE_URL, Tools::slug( $cat['ShopCategoria']['nome_categoria'] ), $cat['ShopCategoria']['id_categoria'] ) .'" title="'. $cat['ShopCategoria']['nome_categoria'] .'"><span class="menu-title">'. $cat['ShopCategoria']['nome_categoria'] .'</span></a>' . PHP_EOL;
                    $lista_itens[] = '</li>' . PHP_EOL;

                } else {

                    if ($cat['ShopCategoria']['nleft'] ==0) {

                        $lista_itens[] = '<li class="parent dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="'. sprintf('%s/c/%s/%d/', FULL_BASE_URL, Tools::slug( $cat['ShopCategoria']['nome_categoria'] ), $cat['ShopCategoria']['id_categoria'] ) .'" title="'. $cat['ShopCategoria']['nome_categoria'] .'"><span class="menu-title">'. $cat['ShopCategoria']['nome_categoria'] .'</span><b class="caret"></b></a></span>
                        <div class="dropdown-menu level'. $cat['ShopCategoria']['nleft'] .'">
                            <div class="dropdown-menu-inner">
                                <div class="row">
                                    <div class="mega-col col-sm-12"  data-colwidth="12"  data-type="menu" >
                                        <div class="mega-col-inner">';

                    }

                    $lista_itens[] = '<ul>';

                    $lista_itens[] = '<li class="category_level_'. $cat['ShopCategoria']['nleft'] .'">' . PHP_EOL;
                    $lista_itens[] = '<a href="'. sprintf('%s/c/%s/%d/', FULL_BASE_URL, Tools::slug( $cat['ShopCategoria']['nome_categoria'] ), $cat['ShopCategoria']['id_categoria'] ) .'" title="'. $cat['ShopCategoria']['nome_categoria'] .'"><span class="menu-title">'. $cat['ShopCategoria']['nome_categoria'] .'</span></a>' . PHP_EOL;
                    $lista_itens[] = '</li>' . PHP_EOL;

                    $lista_itens[] = self::categoriaListarLeft($cat['ShopCategoria']['id_categoria']);

                    $lista_itens[] = '</ul>';

                    if ($cat['ShopCategoria']['nleft'] ==0) {

                            $lista_itens[] = '</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>';

                    }

                }

            }

            // converter para uma string
            $lista_itens = implode('', $lista_itens);

            // if vazio, sem os itens da lista!
            if ('' == trim($lista_itens)) {
                return '';
            }

            return $lista_itens;

        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }


    /*
     * Verifica se a categoria é pai
     * @access public
     * @param String id_shop
     * @param String $data
     */
    private function categoriaPai($value = '')
    {
        try {

            /*
             * Verifica se exista uma categoria filha
             */
            $this->conditions = array(

                'fields' => array(
                    'ShopCategoria.categoria_parent_id'
                ),

                'conditions' => array(
                    'ShopCategoria.categoria_parent_id' => $value
                )

            );

            if ($this->ShopCategoria->find('count', $this->conditions) > 0) {
                return true;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }
    }

}
