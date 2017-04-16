<?php


/**
 * Class ShopCategoriaController
 */
class ShopCategoriaController extends AppController
{

    /**
     * @var array Model ShopCategoria
     */
    public $uses = array('ShopCategoria');

    /**
     * Lista as categoria shop na Option
     * @param int $categoria_parent_id
     * @return array|string
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
                $conditions = array(

                    'fields' => array(
                        'ShopCategoria.id_categoria',
                        'ShopCategoria.nome_categoria',
                        'ShopCategoria.categoria_parent_id',
                        'ShopCategoria.nleft'
                    ),
                    'conditions' => array(
                        'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                    ),
                    'order' => array(
                        'ShopCategoria.nome_categoria' => 'ASC'
                    )

                );

                if ($this->ShopCategoria->find('count', $conditions) <= 0) {
                    return false;
                }

                $dados = $this->ShopCategoria->find('all', $conditions);

                $cats = array();
                foreach ($dados as $key => $cat) {
                    array_push($cats, $cat);
                }

            }


            // Preencher uma lista de matriz itens
            $lista_itens = array();

            foreach ($cats as $cat) {

                // if não do tipo inteiro, seguir em frente
                if (( int )$cat['ShopCategoria']['categoria_parent_id'] !== ( int )$categoria_parent_id) {
                    continue;
                }

                $selected = '';
                if (isset($this->params['named']['id_categoria_default'])) {
                    // abra o item da lista
                    if (!(strcmp($this->params['named']['id_categoria_default'], $cat['ShopCategoria']['id_categoria']))) {
                        $selected = 'selected="selected"';
                    }
                }

                if ($cat['ShopCategoria']['nleft'] == 0) {

                    $lista_itens[] = '<option ' . $selected . ' style="background-color:#E8EDF2;" value="' . $cat['ShopCategoria']['id_categoria'] . '">';

                } else {

                    $lista_itens[] = '<option ' . $selected . ' value="' . $cat['ShopCategoria']['id_categoria'] . '">';

                }

                $lista_itens[] = '|-- ';
                for ($i = 0; $i < $cat['ShopCategoria']['nleft']; $i++) {
                    $lista_itens[] = '-- ';
                }

                // construir o link da categoria
                $lista_itens[] = $cat['ShopCategoria']['nome_categoria'];

                // fechar o item da lista
                $lista_itens[] = '</option>' . PHP_EOL;

                // recurse na lista de filhos
                $lista_itens[] = self::categoriaListaOption($cat['ShopCategoria']['id_categoria']);

            }

            // converter para uma string
            $lista_itens = implode('', $lista_itens);

            // if vazio, sem os itens da lista!
            if ('' == trim($lista_itens)) {
                return '';
            }

            return $lista_itens;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    /**
     * Lista as categoria no painel admin
     * @param int $categoria_parent_id
     * @return array|string
     */
    public function categoriaListar($categoria_parent_id = 0)
    {

        try {

            // Construir a nossa lista de categorias de uma só vez
            static $cats;

            if (!is_array($cats)) {

                /*
                 * Verifica se a página já existe
                 */
                $conditions = array(

                    'fields' => array(
                        'ShopCategoria.id_categoria',
                        'ShopCategoria.nome_categoria',
                        'ShopCategoria.url',
                        'ShopCategoria.ativa',
                        'ShopCategoria.categoria_parent_id',
                        'ShopCategoria.nleft'
                    ),
                    'conditions' => array(
                        'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                    ),
                    'order' => array(
                        'ShopCategoria.posicao' => 'ASC',
                        'ShopCategoria.nome_categoria' => 'ASC'
                    )

                );

                if ($this->ShopCategoria->find('count', $conditions) <= 0) {
                    return false;
                }

                $dados = $this->ShopCategoria->find('all', $conditions);

                $cats = array();
                foreach ($dados as $key => $cat) {
                    array_push($cats, $cat);
                }

            }


            // Preencher uma lista de matriz itens
            $lista_itens = array();

            foreach ($cats as $cat) {

                // if não do tipo inteiro, seguir em frente
                if (( int )$cat['ShopCategoria']['categoria_parent_id'] !== ( int )$categoria_parent_id) {
                    continue;
                }

                // abra o item da lista
                if ($cat['ShopCategoria']['nleft'] <= 0) {

                    $lista_itens[] = '<li class="element with-children" id="categoria_' . $cat['ShopCategoria']['id_categoria'] . '" data-id="' . $cat['ShopCategoria']['id_categoria'] . '">' . PHP_EOL;

                    $lista_itens[] = '<div>
							<label>
							<input type="checkbox" name="categorias[]" value="' . $cat['ShopCategoria']['id_categoria'] . '" id="' . $cat['ShopCategoria']['id_categoria'] . '" />
							<i class="icon-move hide"></i>
							<a href="/admin/catalogo/categoria/editar/' . $cat['ShopCategoria']['id_categoria'] . '" target="_self" title="Editar categoria" class="title">' . $cat['ShopCategoria']['nome_categoria'] . '</a><small>- ' . $cat['ShopCategoria']['url'] . '</small>
							<span class="status check">';

                    if ($cat['ShopCategoria']['ativa'] == 'True') {
                        // code...
                        $lista_itens[] = 'Ativa <span class="icon-custom icon-white icon-power"></span>';
                    } else {
                        $lista_itens[] = 'Inativo <span class="icon-custom icon-white icon-power off"></span>';
                    }

                    $lista_itens[] = '</span>
							<a href="javascript:;" class="btn btn-small btn-ordenar">Ordenar categoria</a>
							</label>
						</div>';

                } else {


                    $getter = '';

                    if ($this->ShopCategoria instanceof ShopCategoria) {

                        $isParentCategoria = $this->ShopCategoria->setCategoriaParentId($cat['ShopCategoria']['id_categoria'])
                            ->isParentCategoria();

                        if ($isParentCategoria === true) {
                            $getter = 'with-children';
                        }

                    }

                    $lista_itens[] = '<li class="element ' . $getter . '" id="categoria_' . $cat['ShopCategoria']['id_categoria'] . '" data-id="' . $cat['ShopCategoria']['id_categoria'] . '">' . PHP_EOL;

                    $lista_itens[] = '<div>
						<label>
						<input type="checkbox" name="categorias[]" value="' . $cat['ShopCategoria']['id_categoria'] . '" />
						<a href="/admin/catalogo/categoria/editar/' . $cat['ShopCategoria']['id_categoria'] . '" target="_self" title="Editar categoria" class="title">' . $cat['ShopCategoria']['nome_categoria'] . '</a><small>- ' . $cat['ShopCategoria']['url'] . '</small>
						<span class="status check">';

                    if ($cat['ShopCategoria']['ativa'] == 'True') {
                        // code...
                        $lista_itens[] = 'Ativa <span class="icon-custom icon-white icon-power"></span>';
                    } else {
                        $lista_itens[] = 'Inativo <span class="icon-custom icon-white icon-power off"></span>';
                    }

                    $lista_itens[] = '</span>
						</label>
					</div>';
                }

                $lista_itens[] = '<ol class="children">';

                if ($cat['ShopCategoria']['categoria_parent_id'] > 0) {

                    if ($this->ShopCategoria instanceof ShopCategoria) {

                        $this->ShopCategoria->setIdCategoria($cat['ShopCategoria']['id_categoria'])
                            ->corrigePosicaoNLeft();

                    }

                }

                // recurse na lista de filhos
                $lista_itens[] = self::categoriaListar($cat['ShopCategoria']['id_categoria']);

                $lista_itens[] = '</ol>';

                $lista_itens[] = '</li>';


            }

            // converter para uma string
            $lista_itens = implode('', $lista_itens);

            // if vazio, sem os itens da lista!
            if ('' == trim($lista_itens)) {
                return '';
            }

            return $lista_itens;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    /**
     * Categoria para Checkbox
     * @param int $categoria_parent_id
     * @return array|bool|string
     */
    public function categoriaCheckboxProduto($categoria_parent_id = 0)
    {

        try {

            // Construir a nossa lista de categorias de uma só vez
            static $cats;

            if (!is_array($cats)) {

                /*
                 * Verifica se a página já existe
                 */
                $conditions = array(

                    'fields' => array(
                        'ShopCategoria.id_categoria',
                        'ShopCategoria.categoria_parent_id',
                        'ShopCategoria.nome_categoria',
                        'ShopCategoria.nome_categoria',
                        'ShopCategoria.nleft'
                    ),
                    'conditions' => array(
                        'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                    ),
                    'order' => array(
                        'ShopCategoria.nome_categoria' => 'ASC',
                    )

                );

                if ($this->ShopCategoria->find('count', $conditions) <= 0) {
                    return false;
                }

                $dados = $this->ShopCategoria->find('all', $conditions);

                $cats = array();
                foreach ($dados as $key => $cat) {
                    array_push($cats, $cat);
                }

            }


            // Preencher uma lista de matriz itens
            $lista_itens = array();

            foreach ($cats as $cat) {

                // if não do tipo inteiro, seguir em frente
                if (( int )$cat['ShopCategoria']['categoria_parent_id'] !== ( int )$categoria_parent_id) {
                    continue;
                }
                //checkbox
                $lista_itens[] = '<li style="margin-top:-10px; margin-left: ' . $cat['ShopCategoria']['nleft'] * 20 . 'px;">
						<label>
						<input type="checkbox" name="categoria_secundaria[]" data-level="' . $cat['ShopCategoria']['nleft'] . '" value="' . $cat['ShopCategoria']['id_categoria'] . '"  /> ' . $cat['ShopCategoria']['nome_categoria'] . '
						</label>
					</li>' . PHP_EOL;


                $lista_itens[] = self::categoriaCheckboxProduto($cat['ShopCategoria']['id_categoria']);


            }

            // converter para uma string
            $lista_itens = implode('', $lista_itens);

            // if vazio, sem os itens da lista!
            if ('' == trim($lista_itens)) {
                return '';
            }

            return $lista_itens;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    /**
     * Verifica se a categoria é pai
     * @param int $categoria_parent_id
     * @return array|string
     */
    public function categoriaCheckboxProdutoChecked($categoria_parent_id = 0)
    {

        try {

            // Construir a nossa lista de categorias de uma só vez
            static $cats;

            if (!is_array($cats)) {

                /*
                 * Verifica se a página já existe
                 */

                $dados = $this->ShopCategoria->find('all', array(

                    'fields' => array(

                        'ShopCategoria.id_categoria',
                        'ShopCategoria.categoria_parent_id',
                        'ShopCategoria.nome_categoria',
                        'ShopCategoria.nleft',
                        'ShopProdutoCategoria.*'

                    ),
                    'conditions' => array(
                        'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                    ),

                    'group' => array('ShopCategoria.nome_categoria'), //fields to GROUP BY

                    'joins' => array(
                        array('table' => 'shop_produto_categoria',
                            'alias' => 'ShopProdutoCategoria',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'ShopCategoria.id_categoria = ShopProdutoCategoria.id_categoria_default',
                            )
                        ),
                        /*
                        array('table' => 'shop_grade_variacao',
                            'alias' => 'ShopGradeVariacao',
                            'type' => 'RIGHT',
                            'conditions' => array(
                                'ShopProdutoVariacao.id_grade_variacao_default = ShopGradeVariacao.id_variacao',
                            )
                        ),
                        */

                    )

                ));

                if (count($dados) <= 0) {
                    return false;
                }

                $cats = array();
                foreach ($dados as $key => $cat) {
                    array_push($cats, $cat);
                }

            }


            // Preencher uma lista de matriz itens
            $lista_itens = array();

            foreach ($cats as $cat) {

                // if não do tipo inteiro, seguir em frente
                if (( int )$cat['ShopCategoria']['categoria_parent_id'] !== ( int )$categoria_parent_id) {
                    continue;
                }

                $checked = '';
                if (isset($cat['ShopProdutoCategoria']['categoria_secudaria'])
                    && $cat['ShopProdutoCategoria']['categoria_secudaria'] == 'True'
                ) {

                    if ($cat['ShopProdutoCategoria']['id_produto_default'] == $this->params['named']['id_produto']) {
                        $checked = 'checked="checked"';
                    }

                }

                //checkbox
                $lista_itens[] = '<li style="margin-top:-10px; margin-left: ' . $cat['ShopCategoria']['nleft'] * 20 . 'px;">
                        <label>
                        <input type="checkbox" ' . $checked . ' name="categoria_secundaria[]" data-level="' . $cat['ShopCategoria']['nleft'] . '" value="' . $cat['ShopCategoria']['id_categoria'] . '"  /> ' . $cat['ShopCategoria']['nome_categoria'] . '
                        </label>
                    </li>' . PHP_EOL;

                $lista_itens[] = self::categoriaCheckboxProdutoChecked($cat['ShopCategoria']['id_categoria']);


            }

            // converter para uma string
            $lista_itens = implode('', $lista_itens);

            // if vazio, sem os itens da lista!
            if ('' == trim($lista_itens)) {
                return '';
            }

            return $lista_itens;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }


    /**
     * Verifica se a categoria é filha e pega o nome da pai
     * @return bool
     */
    public function getCategoriaPaiNome()
    {
        try {

            /*
             * Verifica se exista uma categoria filha
             */
            $conditions = array(

                'fields' => array(
                    'ShopCategoria.categoria_parent_id'
                ),

                'conditions' => array(
                    'ShopCategoria.categoria_parent_id !=' => 0,
                    'ShopCategoria.id_categoria' => $this->params['named']['id_categoria']
                ),
                'limit' => 1

            );

            if ($this->ShopCategoria->find('count', $conditions) > 0) {

                $dados = $this->ShopCategoria->find('first', $conditions);

                /*
                 * Verifica se exista uma categoria filha
                 */
                $conditions = array(

                    'fields' => array(
                        'ShopCategoria.nome_categoria'
                    ),

                    'conditions' => array(
                        'ShopCategoria.id_categoria' => $dados['ShopCategoria']['categoria_parent_id']
                    )

                );

                return $this->ShopCategoria->find('first', $conditions);

            } else {
                return false;
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }
    }

    /**
     * Filtra o Parent_id da categoria
     */
    public function getCategoriaParentId()
    {

        try {

            /**
             *
             * Marca listar
             *
             **/
            $conditions = array(

                'fields' => array(
                    'ShopCategoria.categoria_parent_id'
                ),

                'conditions' => array(
                    'ShopCategoria.id_shop_default' => $this->Session->read('id_shop'),
                    'ShopCategoria.id_categoria' => $this->params['named']['categoria_id']
                )

            );

            $dados = $this->ShopCategoria->find('first', $conditions);

            if (!$this->Session->read('id_categorias_produto')) {

                $data = $this->Session->read('id_categorias_produto');
                $data[] = $dados['ShopCategoria']['categoria_parent_id'];
                $this->Session->write('id_categorias_produto', $data);

            }

            self::filterCategoriaParentId($dados['ShopCategoria']['categoria_parent_id']);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Filtra o Parent_id da categoria
     * @param int $id_categoria
     */
    private function filterCategoriaParentId($id_categoria = 0)
    {
        try {

            $conditions = array(
                'fields' => array(
                    'ShopCategoria.categoria_parent_id',
                    'ShopCategoria.id_categoria'
                ),
                'conditions' => array(
                    'ShopCategoria.id_categoria' => $id_categoria
                )
            );

            $dados = $this->ShopCategoria->find('first', $conditions);

            if (isset($dados['ShopCategoria']['categoria_parent_id']) && $dados['ShopCategoria']['categoria_parent_id'] > 0) {

                $data = $this->Session->read('id_categorias_produto');
                $data[] = $dados['ShopCategoria']['id_categoria'];
                $data[] = $dados['ShopCategoria']['categoria_parent_id'];
                $this->Session->write('id_categorias_produto', $data);
                self::filterCategoriaParentId($dados['ShopCategoria']['categoria_parent_id']);

            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

}
