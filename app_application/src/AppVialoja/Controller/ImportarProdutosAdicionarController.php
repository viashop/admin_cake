<?php

use Lib\Tools;
use Lib\Validate;
use WideImage\WideImage;
use Respect\Validation\Validator as v;


set_time_limit(0);

/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 *
 * @see Respect/Validation
 * @link https://github.com/Respect/Validation/blob/master/docs/VALIDATORS.md Documentação
 * @example if(v::notEmpty()->validate($var))
 *
 * @see PHPOffice/PHPExcel
 * @link https://github.com/PHPOffice/PHPExcel Documentação
 * @see PHPExcel_IOFactory::identify() indentifica o Arquivo
 * @see PHPExcel_IOFactory::createReader() Cria o Cabeçalho
 *
 */
class ImportarProdutosAdicionarController extends AppController
{

    public $uses = array(
        'ShopProduto',
        'ShopProdutoCategoria',
        'ShopCategoria',
        'ShopProdutoGrade',
        'ShopGrade',
        'ShopMarca',
        'ShopGradeVariacao',
    );

    private $array = array();
    private $error = false;
    private $arquivo;
    private $id_produto;
    private $id_shop;
    private $id_marca;


    private $parent_id = 0;
    private $count_insert_id = array();

    private $tipo_produto = 'normal';
    private $sku_do_produto_pai;

    private $disp_quando_nao_gerenciar_estoque;
    private $disp_dos_produtos_em_estoque;
    private $disp_quando_acabar_produtos_em_estoque;
    private $comprimento_cm;

    private $tamanho_de_tenis;
    private $produto_com_uma_cor;
    private $tamanho_de_capacete;
    private $tamanho_de_calca;
    private $produto_com_duas_cores;
    private $voltagem;
    private $tamanho_de_camisa_camiseta;
    private $tamanho_de_anel_alianca;
    private $genero;

    private $grade_nome_29;
    private $grade_nome_30;
    private $grade_nome_31;
    private $grade_nome_32;
    private $grade_nome_33;
    private $grade_nome_34;
    private $grade_nome_35;
    private $grade_nome_36;
    private $grade_nome_37;
    private $id_grade;
    private $variacao_id;
    private $value;
    private $cor;
    private $read;
    private $ok;
    private $datasource;

    /**
     * @var int Posição da Imagem
     */
    private $posicao = 0;

    /**
     * Var usadas em images
     */
    private $url;
    private $img_name;
    private $parsed_url;
    private $imagem_info;
    private $path_extension;
    private $path_img;
    private $finfo;
    private $mime;
    private $originalWidth;
    private $originalHeight;
    private $ratio;
    private $array_url = array();

    //Excel
    private $inputFileName;
    private $inputFileType;
    private $objPHPExcel;
    private $objReader;
    private $sheet;
    private $highestRow;
    private $highestColumn;
    private $row;
    private $col;
    private $cell;

    /**
     * Valida os Nomes dos Campos da Planilha de Importação
     * @param $string
     */
    private function validacaoHeaderExcelXLSX()
    {

        $array = [
            'SKU',
            'Sku do produto pai',
            'Ativo?',
            'Condição',
            'Nome produto',
            'Descrição',
            'Disponibilidade quando não gerenciar estoque.',
            'Gerenciar estoque?',
            'Quantidade',
            'Disponibilidade dos produtos em estoque',
            'Disponibilidade quando acabar produtos em estoque.',
            'Preço custo',
            'Preço venda',
            'Preço promocional',
            'Categoria (nível 1)',
            'Categoria (nível 2)',
            'Categoria (nível 3)',
            'Marca',
            'Peso (kg)',
            'Altura (cm)',
            'Largura (cm)',
            'Comprimento (cm)',
            'Link para a foto principal',
            'Link para foto adicional 1',
            'Link para foto adicional 2',
            'Link para foto adicional 3',
            'URL antiga do produto',
            'Link do vídeo no Youtube',
            'Tamanho de tênis',
            'Produto com uma cor',
            'Tamanho de capacete',
            'Tamanho de calça',
            'Produto com duas cores',
            'Voltagem',
            'Tamanho de camisa/camiseta',
            'Tamanho de anel/aliança',
            'Gênero'
        ];

        if (!in_array($this->cell, $array, true)) {
            throw new \InvalidArgumentException(ERROR_FILE_INVALID_IMPORT_EXCEL, E_USER_WARNING);
        }

    }

    /**
     * Validação de precos
     * @return bool
     */
    private function verificaPrecoInvalidosExcelXLSX()
    {

        foreach ($this->array as $valor) {

            if (v::floatType()->notBlank()->validate($valor['preco_venda'])) {

                $mensagem = EOL . EOL. "Por favor, informe os preços corretamente do produto com a SKU {$valor['sku']} na linha {$valor['row']} e tente novamente.

                     Só é possível salvar os dados do produto após corrigir este problema.";

                if (!v::floatType()->notEmpty()->validate($valor['preco_custo'])) {
                    throw new \InvalidArgumentException("Atenção! Preço de custo do produto não pode ser vazio." . $mensagem,
                        E_USER_WARNING
                    );
                }

                if ($valor['preco_custo'] >= $valor['preco_venda']) {
                    throw new \InvalidArgumentException("Atenção! O preço de custo não pode ser maior ou igual que o preço de venda." . $mensagem,
                        E_USER_WARNING
                    );
                }

                if (v::floatType()->notEmpty()->validate($valor['preco_promocional'])) {

                    if (!Validate::isValueBigger($valor['preco_venda'], $valor['preco_promocional'])) {

                        throw new \InvalidArgumentException(
                            "Atenção! O preço promocional não pode ser maior ou igual que o preço de venda." . $mensagem,
                            E_USER_WARNING
                        );
                    }

                }

            }

        }

    }

    /**
     * Validação de Dados da Importação
     */
    private function validacaoBodyExcelXLSX()
    {

//        $this->total_cadastrado = count($this->Session->read('total_produto_cadastrado'));
//
//        if (v::identical($this->Session->read('limite_produto_importacao'))->validate($this->total_cadastrado)) {
//
//            unset($this->sku);
//            unset($this->sku_do_produto_pai);
//
//        }


        if (v::identical($this->col)->validate(1)) {

            /** SKU **/

            if (!v::notEmpty()->validate($this->cell)) {
                throw new \NotFoundException("Atenção! Há produto com SKU não informada, por favor corrija e tente novamente.", E_USER_WARNING);
            }

            $this->array[$this->row]['sku'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(2)) {

            /** Sku do produto pai **/

            $this->array[$this->row]['sku_do_produto_pai'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(3)) {

            /** Ativo? **/
            $ativo = (string)strtoupper(Tools::clean($this->cell));
            if (v::identical('SIM')->validate($ativo)) {
                $ativo = 'True';
            } elseif (v::contains('S')->validate($ativo)) {
                $ativo = 'True';
            } else {
                $ativo = 'False';
            }

            $this->array[$this->row]['ativo'] = $ativo;

        }

        if (v::identical($this->col)->validate(4)) {

            /** Condição **/

            $usado = (string)strtoupper(Tools::clean($this->cell));
            if (v::identical('USADO')->validate($usado)) {
                $usado = 'True';
            } elseif (v::contains('U')->validate($usado)) {
                $usado = 'True';
            } else {
                $usado = 'False';
            }

            $this->array[$this->row]['usado'] = $usado;

        }

        if (v::identical($this->col)->validate(5)) {

            /** Nome produto **/

            if (!v::stringType()->notEmpty()->validate($this->cell)) {
                throw new \NotFoundException('Por favor, insira o nome do produto corretamente, este campo não pode ser enviado vazio.');
            }

            $this->array[$this->row]['nome_produto'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(6)) {

            /** Descrição **/

            $this->array[$this->row]['descricao'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(7)) {

            /** Disponibilidade quando não gerenciar estoque. **/

            $this->array[$this->row]['disp_quando_nao_gerenciar_estoque'] = Tools::clean($this->cell);
            $this->disp_quando_nao_gerenciar_estoque = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(8)) {

            /** Gerenciar estoque? **/

            $gerenciar_estoque = (string)strtoupper(Tools::clean($this->cell));

            if (v::identical('SIM')->validate($gerenciar_estoque)) {

                $gerenciar_estoque = 'True';

            } elseif (v::contains('S')->validate($gerenciar_estoque)) {

                $gerenciar_estoque = 'True';

            } else {

                $gerenciar_estoque = 'False';

                if (!v::intType()->validate($this->disp_quando_nao_gerenciar_estoque)) {
                    $this->disp_dos_produtos_em_estoque = 10;
                }

            }

            $this->array[$this->row]['gerenciar_estoque'] = $gerenciar_estoque;

        }

        if (v::identical($this->col)->validate(9)) {

            /** Quantidade **/

            $this->array[$this->row]['quantidade'] = intval($this->cell);

        }

        if (v::identical($this->col)->validate(10)) {

            /** Disponibilidade dos produtos em estoque **/

            $this->disp_dos_produtos_em_estoque = intval($this->cell);

            if (!v::numeric()->notBlank()->validate($this->disp_dos_produtos_em_estoque)) {
                $this->disp_dos_produtos_em_estoque = 10;
            }

            $this->array[$this->row]['disp_dos_produtos_em_estoque'] = $this->disp_dos_produtos_em_estoque;

        }

        if (v::identical($this->col)->validate(11)) {

            /** Disponibilidade quando acabar produtos em estoque. **/

            $this->disp_quando_acabar_produtos_em_estoque = intval($this->cell);
            if (!v::numeric()->notBlank()->validate($this->disp_quando_acabar_produtos_em_estoque)) {
                $this->disp_dos_produtos_em_estoque = 30;
            }

            $this->array[$this->row]['disp_quando_acabar_produtos_em_estoque'] = $this->disp_quando_acabar_produtos_em_estoque;

        }

        if (v::identical($this->col)->validate(12)) {

            /** Preço custo **/

            $this->array[$this->row]['preco_custo'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(13)) {

            /** Preço venda **/

            $this->array[$this->row]['preco_venda'] =  Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(14)) {

            /** Preço promocional **/

            $this->array[$this->row]['preco_promocional'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(15)) {

            /** Categoria (nível 1) **/

            $this->array[$this->row]['categoria_nome_nivel_1'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(16)) {

            /** Categoria (nível 2) **/

            $this->array[$this->row]['categoria_nome_nivel_2'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(17)) {

            /** Categoria (nível 3) **/

            $this->array[$this->row]['categoria_nome_nivel_3'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(18)) {

            /** Marca **/

            $this->array[$this->row]['marca'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(19)) {

            /** Peso (kg) **/

            $this->array[$this->row]['peso_kg'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(20)) {

            /** Altura (cm) **/

            $this->array[$this->row]['altura_cm'] = intval($this->cell);

        }

        if (v::identical($this->col)->validate(21)) {

            /** Largura (cm) **/

            $this->array[$this->row]['largura_cm'] = intval($this->cell);

        }

        $this->comprimento_cm = null;
        if (v::identical($this->col)->validate(22)) {

            /** Comprimento (cm) **/

            $this->array[$this->row]['comprimento_cm'] = intval($this->cell);

        }

        if (v::identical($this->col)->validate(23)) {

            /** Link para a foto principal **/
            if (v::url()->validate($this->cell)) {
                $this->array[$this->row]['link_para_a_foto_principal'] = $this->cell;
            }

        }

        if (v::identical($this->col)->validate(24)) {

            /** Link para foto adicional 1 **/
            if (v::url()->validate($this->cell)) {
                $this->array[$this->row]['link_para_foto_adicional_1'] = $this->cell;
            }

        }

        if (v::identical($this->col)->validate(25)) {

            /** Link para foto adicional 2 **/

            if (v::url()->validate($this->cell)) {
                $this->array[$this->row]['link_para_foto_adicional_2'] = $this->cell;
            }

        }

        if (v::identical($this->col)->validate(26)) {

            /** Link para foto adicional 3 **/

            if (v::url()->validate($this->cell)) {
                $this->array[$this->row]['link_para_foto_adicional_3'] = $this->cell;
            }

        }

        if (v::identical($this->col)->validate(27)) {

            /** URL antiga do produto **/

            if (v::url()->validate($this->cell)) {
                $this->array[$this->row]['url_antiga_do_produto'] = $this->cell;
            }

        }

        if (v::identical($this->col)->validate(28)) {

            /** Link do vídeo no Youtube **/

            if (v::videoUrl()->validate($this->cell)) {
                $link_do_video_no_youtube = $this->cell;
            } else {
                $link_do_video_no_youtube = null;
            }

            $this->array[$this->row]['link_do_video_no_youtube'] = $link_do_video_no_youtube;

        }

        if (v::identical($this->col)->validate(29)) {

            /** Tamanho de tênis **/

            $this->grade_nome_29 = 'Tamanho de tênis';
            $this->array[$this->row]['tamanho_de_tenis'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(30)) {

            /** Produto com uma cor **/

            $this->grade_nome_30 = 'Produto com uma cor';
            $this->array[$this->row]['produto_com_uma_cor'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(31)) {

            /** Tamanho de capacete **/

            $this->grade_nome_31 = 'Tamanho de capacete';
            $this->array[$this->row]['tamanho_de_capacete'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(32)) {

            /** Tamanho de calça **/

            $this->grade_nome_32 = 'Tamanho de calça';
            $this->array[$this->row]['tamanho_de_calca'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(33)) {

            /** Produto com duas cores **/

            $this->grade_nome_33 = 'Produto com duas cores';
            $this->array[$this->row]['produto_com_duas_cores'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(34)) {

            /** Voltagem **/

            $this->grade_nome_34 = 'Voltagem';
            $this->array[$this->row]['voltagem'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(35)) {

            /** Tamanho de camisa/camiseta **/

            $this->grade_nome_35 = 'Tamanho de camisa/camiseta';
            $this->array[$this->row]['tamanho_de_camisa_camiseta'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(36)) {

            /** Tamanho de anel/aliança **/

            $this->grade_nome_36 = 'Tamanho de anel/aliança';
            $this->array[$this->row]['tamanho_de_anel_alianca'] = Tools::clean($this->cell);

        }


        if (v::identical($this->col)->validate(37)) {

            /** Gênero **/

            $this->grade_nome_37 = 'Gênero';
            $this->array[$this->row]['genero'] = Tools::clean($this->cell);

        }

    }


    /**
     * Lê os Dados e Valida e Cria o Array para Salvar no DB
     *
     * @see PHPOffice/PHPExcel
     * @link https://github.com/PHPOffice/PHPExcel Documentação
     * @see PHPExcel_IOFactory::identify() indentifica o Arquivo
     * @see PHPExcel_IOFactory::createReader() Cria o Cabeçalho
     *
     * @see protected function validacaoHeaderExcelXLSX()
     * @see protected function validacaoBodyExcelXLSX()
     *
     * @see private function verificaPrecoInvalidosExcelXLSX()
     *
     * @throws PHPExcel_Exception
     */
    private function lerDadosExcelXLSX()
    {

        $this->inputFileName = $this->arquivo['tmp_name'];

        //  Read your Excel workbook
        try {
            $this->inputFileType = PHPExcel_IOFactory::identify($this->inputFileName);
            $this->objReader = PHPExcel_IOFactory::createReader($this->inputFileType);
            $this->objPHPExcel = $this->objReader->load($this->inputFileName);
        } catch (\Exception $e) {

            throw new \InvalidArgumentException(
                'Error no Carregamento do Arquivo"' . pathinfo($this->inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage()
            );

        }

        //  Get worksheet dimensions
        $this->sheet = $this->objPHPExcel->getSheet(0);
        $this->highestRow = $this->sheet->getHighestRow();
        $this->highestColumn = $this->sheet->getHighestColumn();

        //Percorrer cada linha da planilha, por sua vez
        for ($this->row = 1; $this->row <= $this->highestRow; $this->row++) {


            //Leia uma linha de dados em uma matriz
            $rowData = $this->sheet->rangeToArray('A' . $this->row . ':' . $this->highestColumn . $this->row, NULL, TRUE, FALSE);

            foreach ($rowData[0] as $this->col => $this->cell) {

                $this->col = $this->col + 1;

                if (v::identical($this->row)->validate(1)) {

                    self::validacaoHeaderExcelXLSX();

                } else {

                    $this->array[$this->row]['row'] = $this->row;
                    self::validacaoBodyExcelXLSX();

                }

            }

        }

        /*** Conferir preços invalidos */
        self::verificaPrecoInvalidosExcelXLSX();


        /**
         * Faz Upload das imagens
         * Obs.: Só grava caso nao haja nenhum erro de cadastro nem na imagem
         */
        //self::getUrlImagemProdutoSKU();

        //die;

    }

    /**
     * Cadastra os dados da tabela
     * @return bool
     */
    private function addTabelaProdutoImportacaoXLS()
    {

        /**
         * Verifica se produto não existe
         */
        if ($this->ShopProduto->getTotalProdutoSKU($this->id_shop, $this->v['sku']) <= 0) {

            $data = array(

                'id_shop_default' => $this->id_shop,
                'tipo' => $this->v['tipo_produto'],
                'parente_id' => $this->v['parent_id'],
                'sku' => $this->v['sku'],
                'ativo' => $this->v['ativo'],
                'usado' => $this->v['usado'],
                'nome' => $this->v['nome_produto'],
                'apelido' => Tools::slug($this->v['nome_produto']),
                'url' => Tools::slug($this->v['nome_produto']),
                'descricao_completa' => $this->v['descricao'],
                'preco_custo' => $this->v['preco_custo'],
                'preco_cheio' => $this->v['preco_venda'],
                'preco_promocional' => $this->v['preco_promocional'],
                'id_marca' => $this->v['id_marca'],
                'peso' => $this->v['peso_kg'],
                'altura' => $this->v['altura_cm'],
                'largura' => $this->v['largura_cm'],
                'comprimento' => $this->v['comprimento_cm'],
                'url_video_youtube' => $this->v['link_do_video_no_youtube'],
                'gerenciado' => $this->v['gerenciar_estoque'],
                'situacao_em_estoque' => $this->v['disp_dos_produtos_em_estoque'],
                'quantidade' => $this->v['quantidade'],
                'situacao_sem_estoque' => $this->v['disp_quando_acabar_produtos_em_estoque'],
                'tipo_importacao_xls' => 'insert',
                'produto_key' => Tools::uniqid()

            );

            $this->ok = $this->ShopProduto->saveAll($data);

            $this->id_produto = $this->ShopProduto->getInsertID();

//            if (v::numeric()->notBlank()->validate($this->id_produto)) {
//
//                if (!v::notEmpty()->validate($this->sku_do_produto_pai)) {
//                    array_push($this->count_insert_id, $this->id_produto);
//                    $this->Session->write('total_produto_cadastrado', $this->count_insert_id);
//                }
//
//                self::addCategoria();
//                self::adicionaGradeAoProduto();
//
//
//            }

        } else {

            $this->ok = true;

        }

        return $this->ok;

    }



    /**
     * Importa produtos para plataforma
     * @access public
     */
    public function importar()
    {

        try {

            /**
             * Recebe dados somente via POST
             */
            if (!$this->request->is('post')) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            $this->arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : false;


            //UTF-8
            $this->ExcelReader->setOutputEncoding('UTF-8');
            $this->ExcelReader->setUTFEncoder('mb');
            /**
             * Leia o arquivo Excel. Nota: apenas caminhos relativos parecem funcionar
             */
            $this->read = $this->ExcelReader->Spreadsheet_Excel_Reader($this->arquivo['tmp_name']);

            if (!v::type('bool')->validate($this->read) && $this->read === false) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            if (!v::arrayVal()->notEmpty()->validate($this->ExcelReader->sheets[0]['cells'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            self::transactionProdutoImportacao();



//            if (v::type('bool')->validate($this->ok_update)) {
//
//                if (count($this->Session->read('total_produto_atualizado')) > 0) {
//                    $this->setMsgAlertSuccess('Dados de ' . count($this->Session->read('total_produto_atualizado')) . ' produtos foram atualizados com sucesso.');
//                } else {
//                    $this->setMsgAlertSuccess('Dados de ' . count($this->Session->read('total_produto_atualizado')) . ' produto foram atualizados com sucesso.');
//                }
//
//                $this->Session->delete('total_produto_atualizado');
//                return $this->redirect(array('controller' => 'catalogo', 'action' => 'produto', 'listar'));
//
//            }
//
//            if (v::type('bool')->validate($this->ok)) {
//
//                $this->setMsgAlertSuccess('Foram importados o total de ' . $this->total_cadastrado . ' produtos com sucesso. <br /> Por favor, revise os dados de cada produto importado na lista abaixo.');
//                unset($this->total_cadastrado);
//                $this->Session->delete('total_produto_cadastrado');
//                return $this->redirect(array('controller' => 'catalogo', 'action' => 'produto', 'listar'));
//
//            } else {
//                throw new \RuntimeException("Error: Houve uma falha ao importar os registros!", E_USER_WARNING);
//            }


        } catch (\NotFoundException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError($e->getMessage());
            \Exception\VialojaDatabaseException::errorHandler($e);


//            if (strpos($e->getMessage(), 'image')) {
//
//                $this->setMsgAlertWarning(
//                    'Atenção! O arquivo foi processado e os dados foram inseridos parcialmente!
//                    <br /> Atenção! A imagem do produto "' . $this->nome_produto . '" está corrompida e a importação foi abortada.
//                    <br/> Corrija a imagem através do upload manual, ou <a href="/admin/catalogo/produto/importar">Clique Aqui</a> para enviar o arquivo novamente!'
//                );
//
//            } else {
//
//                $this->setMsgAlertWarning('Atenção! O arquivo foi processado e os dados foram inseridos parcialmente!');
//                return $this->redirect($this->referer());
//
//            }
//
//            unset($this->total_cadastrado);
//            $this->Session->delete('total_produto_cadastrado');
//            return $this->redirect(array('controller' => 'catalogo', 'action' => 'produto', 'listar'));


        } finally {

            $this->arquivo = false;
            return $this->redirect($this->referer());

        }

    }



    private function adicionaGradeAoProduto()
    {
        if (isset($this->grade_nome_29)) {

            /** Tamanho de tênis **/
            $this->id_grade = self::getGradeId($this->grade_nome_29);

            if (isset($this->id_grade, $this->tamanho_de_tenis) && v::numeric()->notBlank()->validate($this->id_grade)) {

                $this->variacao_id = self::getGradeVariacaoId($this->id_grade, $this->tamanho_de_tenis);

                self::addProdutoGradeVariacao(

                    $this->id_produto,
                    $this->parent_id,
                    $this->id_grade,
                    $this->variacao_id,
                    intval($this->tamanho_de_tenis),
                    $this->cor

                );

            }

        }

        if (isset($this->grade_nome_30)) {

            /** Produto com uma cor **/
            $this->id_grade = self::getGradeId($this->grade_nome_30);

            if (isset($this->id_grade, $this->produto_com_uma_cor) && v::numeric()->notBlank()->validate($this->id_grade)) {

                //ok
                $this->cor = 'True';
                $this->produto_com_uma_cor = preg_replace('/[^A-Za-zÀ-ú ]/i', '', $this->produto_com_uma_cor);
                $this->variacao_id = self::getGradeVariacaoId($this->id_grade, $this->produto_com_uma_cor);

                self::addProdutoGradeVariacao(
                    $this->id_produto,
                    $this->parent_id,
                    $this->id_grade,
                    $this->variacao_id,
                    $this->produto_com_uma_cor,
                    $this->cor
                );

            }

        }

        if (isset($this->grade_nome_31)) {

            /** Tamanho de capacete **/
            $this->id_grade = self::getGradeId($this->grade_nome_31);

            if (isset($this->id_grade, $this->tamanho_de_capacete) && v::numeric()->notBlank()->validate($this->id_grade)) {

                //ok
                $this->tamanho_de_capacete = preg_replace('/[^0-9]/i', '', $this->tamanho_de_capacete);

                if (isset($this->tamanho_de_capacete[0], $this->tamanho_de_capacete[1])) {
                    $this->tamanho_de_capacete = $this->tamanho_de_capacete[0] . $this->tamanho_de_capacete[1];
                }

                if (strlen($this->tamanho_de_capacete) == 2) {

                    //53-54, 55-56, 57-58, 59-60, 61-62, 63-64
                    switch (intval($this->tamanho_de_capacete)) {
                        case '53':
                        case '54':
                            $this->tamanho_de_capacete = '53-54';
                            break;

                        case '55':
                        case '56':
                            $this->tamanho_de_capacete = '55-56';
                            break;

                        case '57':
                        case '58':
                            $this->tamanho_de_capacete = '57-58';
                            break;

                        case '59':
                        case '60':
                            $this->tamanho_de_capacete = '59-60';
                            break;

                        case '61':
                        case '62':
                            $this->tamanho_de_capacete = '61-62';
                            break;

                        case '63':
                        case '64':
                            $this->tamanho_de_capacete = '63-64';
                            break;

                    }
                }

                $this->variacao_id = self::getGradeVariacaoId($this->id_grade, $this->tamanho_de_capacete);

                self::addProdutoGradeVariacao(
                    $this->id_produto,
                    $this->parent_id,
                    $this->id_grade,
                    $this->variacao_id,
                    $this->tamanho_de_capacete
                );

            }

        }

        if (isset($this->grade_nome_32)) {

            /** Tamanho de calça **/
            $this->id_grade = self::getGradeId($this->grade_nome_32);

            if (isset($this->id_grade, $this->tamanho_de_calca) && v::numeric()->notBlank()->validate($this->id_grade)) {

                $this->variacao_id = self::getGradeVariacaoId($this->id_grade, $this->tamanho_de_calca);

                self::addProdutoGradeVariacao(

                    $this->id_produto,
                    $this->parent_id,
                    $this->id_grade,
                    $this->variacao_id,
                    intval($this->tamanho_de_calca)

                );

            }

        }

        if (isset($this->grade_nome_33)) {

            /** Produto com duas cores **/
            $this->id_grade = self::getGradeId($this->grade_nome_33);

            if (isset($this->id_grade, $this->produto_com_duas_cores) && v::numeric()->notBlank()->validate($this->id_grade)) {

                //ok
                $this->cor = 'True';
                $this->produto_com_duas_cores = preg_replace('/[^A-Za-zÀ-ú ]/i', '/', $this->produto_com_duas_cores);

                $this->array = explode('/', $this->produto_com_duas_cores);

                $this->produto_com_duas_cores = str_replace('/ ', '/', $this->produto_com_duas_cores);

                foreach ($this->array as $this->value) {

                    $this->variacao_id = self::getGradeVariacaoId($this->id_grade, trim($this->value));

                    self::addProdutoGradeVariacao(
                        $this->id_produto,
                        $this->parent_id,
                        $this->id_grade,
                        $this->variacao_id,
                        $this->produto_com_duas_cores,
                        $this->cor
                    );

                }

                $this->array = null;

            }

        }

        if (isset($this->grade_nome_34)) {

            /** Voltagem **/
            $this->id_grade = self::getGradeId($this->grade_nome_34);

            if (isset($this->id_grade, $this->voltagem) && v::numeric()->notBlank()->validate($this->id_grade)) {

                //ok
                $this->voltagem = intval($this->voltagem);
                $this->voltagem = $this->voltagem . 'V';
                $this->variacao_id = self::getGradeVariacaoId($this->id_grade, $this->voltagem);

                self::addProdutoGradeVariacao(

                    $this->id_produto,
                    $this->parent_id,
                    $this->id_grade,
                    $this->variacao_id,
                    $this->voltagem

                );

            }

        }

        if (isset($this->grade_nome_35)) {

            /** Tamanho de camisa/camiseta **/
            $this->id_grade = self::getGradeId($this->grade_nome_35);

            if (isset($this->id_grade, $this->tamanho_de_camisa_camiseta) && v::numeric()->notBlank()->validate($this->id_grade)) {

                //ok
                $this->tamanho_de_camisa_camiseta = preg_replace('/[^0-9a-zA-Z]/i', '', $this->tamanho_de_camisa_camiseta);
                $this->variacao_id = self::getGradeVariacaoId($this->id_grade, $this->tamanho_de_camisa_camiseta);

                self::addProdutoGradeVariacao(

                    $this->id_produto,
                    $this->parent_id,
                    $this->id_grade,
                    $this->variacao_id,
                    $this->tamanho_de_camisa_camiseta

                );

            }

        }

        if (isset($this->grade_nome_36)) {

            /** Tamanho de anel/aliança **/
            $this->id_grade = self::getGradeId($this->grade_nome_36);

            if (isset($this->id_grade, $this->tamanho_de_anel_alianca)
                && v::numeric()->notBlank()->validate($this->id_grade)
            ) {

                //ok
                $this->variacao_id = self::getGradeVariacaoId($this->id_grade, $this->tamanho_de_anel_alianca);

                self::addProdutoGradeVariacao(
                    $this->id_produto,
                    $this->parent_id,
                    $this->id_grade,
                    $this->variacao_id,
                    intval($this->tamanho_de_anel_alianca)
                );

            }

        }

        if (isset($this->grade_nome_37)) {

            /** Gênero **/
            $this->id_grade = self::getGradeId($this->grade_nome_37);

            if (isset($this->id_grade, $this->genero) && v::numeric()->notBlank()->validate($this->id_grade)) {

                //ok
                $this->array = array('feminino', 'masculino');
                if (!in_array(strtolower($this->genero), $this->array)) {

                    if (strpos(strtoupper($this->genero), 'M') !== false) {
                        $this->genero = 'Masculino';
                    }

                    if (strpos(strtoupper($this->genero), 'F') !== false) {
                        $this->genero = 'Feminino';
                    }
                }

                $this->array = null;

                $this->variacao_id = self::getGradeVariacaoId($this->id_grade, $this->genero);

                self::addProdutoGradeVariacao(

                    $this->id_produto,
                    $this->parent_id,
                    $this->id_grade,
                    $this->variacao_id,
                    $this->genero

                );

            }

        }

    }

    /**
     * Verifica se o Produto é com atributos
     * Retorna o ID do produto pai caso exista
     * @param string $sku
     * @return bool|int
     */
    private function getIdProdutoPaiSKU($sku = '')
    {
        if (v::notEmpty()->validate($sku)) {
            if ($this->ShopProduto instanceof ShopProduto) {
                return $this->ShopProduto->setIdShop($this->id_shop)
                                ->setSku($sku)
                                ->getIdProdutoPaiViaSKU();
            }
        } else {
            return false;
        }
    }

    /**
     * Retorna o ID da grade
     *
     * @param null $nome
     * @return mixed
     */
    private function getGradeId($nome = null)
    {
        if (v::stringType()->notEmpty()->validate($nome)) {
            return $this->ShopGrade->getGradeId($nome);
        }

    }

    /**
     * Retorna o ID da Grade de Variação
     *
     * @param string $id_grade
     * @param string $nome
     * @return mixed
     */
    private function getGradeVariacaoId($id_grade = '', $nome = '')
    {

        if (v::numeric()->notBlank()->validate($id_grade) && v::notEmpty()->validate($nome)) {
            return $this->ShopGradeVariacao->getIdVariacao($id_grade, $nome);
        }

    }

    /**
     * Adiciona a Grade do Produto
     * @param null $id_produto
     * @param null $parent_id
     * @param null $id_grade
     * @param null $variacao_id
     * @param null $nome
     * @param null $cor
     */
    private function addProdutoGradeVariacao($id_produto = '', $parent_id = '', $id_grade = '', $variacao_id = '', $nome = '', $cor = 'False')
    {

        if (v::numeric()->notBlank()->validate($parent_id) && v::numeric()->notBlank()->validate($id_grade)) {

            $this->ShopProdutoGrade->addGradeImportacao($id_grade, $parent_id);

            if (v::numeric()->notBlank()->validate($id_produto) && v::numeric()->notBlank()->validate($variacao_id) && v::stringType()->notEmpty()->validate($nome)) {

                /**
                 * Adiciona Variação de Produto
                 */
                $this->ShopProdutoVariacao->addProdutoVariacaoViaImportacao($id_produto, $id_grade, $variacao_id, $nome, $cor);

            }

        }

    }




    /**
     * Armazena a Url do Produto para gravar as imagens
     * So grava as imagens caso nao haja nenhum erro de cadastro nem na imagem
     */
    private function getUrlImagemProdutoSKU()
    {

//        //Verifica images quebradas e Deleta o ID e o path da images
//        $this->requestAction(
//            array(
//                'controller' => 'ShopProdutoImagem',
//                'action' => 'verificaImagesQuebradas',
//                'id_produto' => $this->request->params['pass']['2']
//            )
//        );




        $urlProd = [];
        foreach ($this->array as $valor) {

            if (isset($valor['sku'])) {
                echo $valor['sku'] . EOL;
            }

            if (isset($valor['link_para_a_foto_principal'])) {
                echo $valor['link_para_a_foto_principal'] . EOL;
            }

            if (isset($valor['link_para_foto_adicional_1'])) {
                echo $valor['link_para_foto_adicional_1'] . EOL;
            }

            if (isset($valor['link_para_foto_adicional_2'])) {
                echo $valor['link_para_foto_adicional_2'] . EOL;
            }

            if (isset($valor['link_para_foto_adicional_3'])) {
                echo $valor['link_para_foto_adicional_3'] . EOL;
            }

            echo "<hr />";

        }

    }

    /**
     * Armazena a Url do Produto para gravar as imagens
     * So grava as imagens caso nao haja nenhum erro de cadastro nem na imagem
     *
     * @see private function getPosicaoMaxImage()
     * @see private function uploadImageServidor()
     *
     * @internal Validate::isTypeImage($this->mime);
     * @internal Tools::slug($this->imagem_info['filename']);
     * @internal Tools::file_get_contents($this->url);
     *
     * @internal Class finfo(FILEINFO_MIME);
     * @internal $this->finfo->buffer(Tools::file_get_contents($this->url));
     * @internal AppModel ShopProdutoImagem->saveAll($data);
     */
    private function validacaoImagemProduto()
    {

        set_time_limit(0);

        try {

            if (!v::numeric()->notBlank()->validate($this->id_produto)) {
                throw new \LogicException("Valor obrigatório: Informe o id_produto.", E_USER_WARNING);
            }


            foreach ($this->array_url as $this->url) {

                if (!v::url()->validate($this->url)) {
                    $this->error = true;
                }

                //Recusar imagem maior que 3.0MB
                list($this->originalWidth, $this->originalHeight) = @getimagesize($this->url);

                if (isset($this->originalWidth, $this->originalHeight)) {

                    //Verificar altura e largura
                    if ($this->originalWidth <= 1 && $this->originalHeight <= 1) {
                        $this->error = true;
                    } else {
                        $this->ratio = ($this->originalWidth / $this->originalHeight);
                    }

                } else {
                    $this->error = true;
                }

                //Recusar imagem maior que 3.0MB
                if (isset($this->ratio) && floatval($this->ratio)) {
                    if ($this->ratio > floatval('3.0MB')) {
                        $this->error = true;
                    }
                    $this->ratio = null;
                } else {
                    $this->error = true;
                }

                if (!v::type('bool')->validate($this->error)) {

                    $this->finfo = new \finfo(FILEINFO_MIME);  // abordagem orientada objeto !
                    $this->mime = $this->finfo->buffer(Tools::file_get_contents($this->url));  // pegar "image/jpeg"
                    $this->mime = explode(';', $this->mime);
                    $this->mime = trim($this->mime[0]);

                    if (v::notEmpty()->validate($this->mime)) {

                        if (!Validate::isTypeImage($this->mime)) {
                            $this->error = true;
                        }

                    } else {
                        $this->error = true;
                    }

                    $this->parsed_url = parse_url($this->url);
                    $this->path_img = array_reverse(explode('/', $this->parsed_url['path']));

                    $this->array = array('jpg', 'jpeg', 'gif', 'png');
                    $this->path_extension = pathinfo($this->path_img[0], PATHINFO_EXTENSION);

                    if (!in_array($this->path_extension, $this->array)) {
                        $this->error = true;
                    }

                    if (!v::type('bool')->validate($this->error)) {

                        $this->imagem_info = pathinfo($this->path_img[0]);
                        $this->img_name = Tools::slug($this->imagem_info['filename']) . '-' . $this->id_produto . '.' . $this->imagem_info['extension'];

                        $this->posicao = self::getPosicaoMaxImage();

                        $data = array(
                            'id_produto_default' => $this->id_produto,
                            'nome_imagem' => $this->img_name,
                            'posicao' => $this->posicao
                        );

                        if ($this->ShopProdutoImagem->saveAll($data)) {

                            self::uploadImageServidor();

                        }

                    }

                }

            }

            $this->array_url = null;

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Verifica a posicao da imagem
     *
     * @internal AppModel ShopProdutoImagem->find('count', $conditions)
     * @internal AppModel ShopProdutoImagem->find('first', $conditions)
     * @return int
     */
    private function getPosicaoMaxImage()
    {
        try {

            $conditions = array(

                'fields' => array(
                    'MAX(ShopProdutoImagem.posicao) as max_posicao'
                ),
                'conditions' => array(
                    'ShopProdutoImagem.id_produto_default' => $this->id_produto
                )

            );

            if ($this->ShopProdutoImagem->find('count', $conditions) > 0) {
                $posicao = $this->ShopProdutoImagem->find('first', $conditions);
                $posicao = $posicao['0']['max_posicao'] + 1;
            } else {
                $posicao = 0;
            }

            return $posicao;

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }
    }


    /**
     * Upload das images
     * @see WideImage::load($param, $param)
     * @example $original->resize(98, 98, 'inside')->saveToFile($small . $this->img_name);
     *
     * @internal Tools::createFolder($param)
     * @internal Tools::createFolder($param)
     */
    private function uploadImageServidor()
    {

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        $raw = curl_exec($ch);
        curl_close($ch);

        $diretorio = CDN_ROOT_UPLOAD .
            $this->id_shop . DS .
            'produto' . DS .
            $this->id_produto . DS;

        $thickbox = $diretorio . 'thickbox' . DS;

        Tools::createFolder($thickbox);

        $fp = fopen($thickbox . $this->img_name, 'wb');
        fwrite($fp, $raw);
        fclose($fp);

        // thickbox_default Tamanho 800 x 800
        $original = WideImage::load($thickbox . $this->img_name);
        $original->resize(800, 800, 'inside')->saveToFile($thickbox . $this->img_name);

        // large_default Tamanho 368 x 548
        $large = $diretorio . 'large' . DS;
        Tools::createFolder($large);
        $original->resize(368, 548, 'outside')->saveToFile($large . $this->img_name);

        // home_default Tamanho 270 x 270
        $home = $diretorio . 'home' . DS;
        Tools::createFolder($home);
        $original->resize(270, 270, 'inside')->saveToFile($home . $this->img_name);

        //* medium_default Tamanho 125 x 125
        $medium = $diretorio . 'medium' . DS;
        Tools::createFolder($medium);
        $original->resize(125, 125, 'inside')->saveToFile($medium . $this->img_name);

        // small_default Tamanho 98 x 98
        $small = $diretorio . 'small' . DS;
        Tools::createFolder($small);
        $original->resize(98, 98, 'inside')->saveToFile($small . $this->img_name);

        // cart_default Tamanho 85 x 108
        $cart = $diretorio . 'cart' . DS;
        Tools::createFolder($cart);
        $original->resize(85, 108, 'outside')->saveToFile($cart . $this->img_name);

        $original->destroy();

    }



    /**
     * Faz a verificação do arquivo
     * @internal Validate::isFileExcel($this->arquivo)
     * @internal Validate::isMaxSize($this->arquivo['size'], 5)
     */
    private function validacaoFileExcelXLSX()
    {

        if (v::type('bool')->validate($this->arquivo) && $this->arquivo === false) {
            throw new \NotFoundException(ERROR_FILE_NOT_FOUND, E_USER_WARNING);
        }

        if (!v::intVal()->notEmpty()->validate($this->arquivo['size'])) {
            throw new \NotFoundException(ERROR_FILE_INVALID, E_USER_WARNING);
        }

        if (!v::stringType()->notEmpty()->validate($this->arquivo['type'])) {
            throw new \InvalidArgumentException(ERROR_FILE_INVALID_EXCEL, E_USER_WARNING);
        }

        if (!Validate::isFileExcel($this->arquivo)) {
            throw new \InvalidArgumentException(ERROR_FILE_INVALID_EXCEL, E_USER_WARNING);
        }

        if (!Validate::isMaxSize($this->arquivo['size'], 5)) {
            throw new \InvalidArgumentException('O arquivo enviado é muito grande, envie arquivos de no máximo 5MB.', E_USER_WARNING);
        }

    }


    /**
     * Add Marca
     * @internal Model ShopMarca
     */
    private function addMarca()
    {

        if ($this->ShopMarca instanceof ShopMarca) {

            foreach ($this->array as $v) {

                if (!empty($v['marca'])) {
                    $this->ShopMarca->setIdShop($this->id_shop)
                        ->setNome(trim($v['marca']))
                        ->adicionaMarcaViaImportacao();

                }

            }

        }

    }

    /**
     * Adiciona a categorias
     * @internal Model ShopCategoria->adicionaCategoriaViaImportacao()
     * @param $v
     */
    private function addCategoria()
    {

        if ($this->ShopCategoria instanceof ShopCategoria) {

            foreach ($this->array as $v) {

                /** Categoria Nível 1 */
                if (!empty($v['categoria_nome_nivel_1'])) {

                    $categoria_id_nivel_1 = (int)$this->ShopCategoria->setIdShop($this->id_shop)
                        ->setNomeCategoria(trim($v['categoria_nome_nivel_1']))
                        ->setCategoriaParentId(0)
                        ->adicionaCategoriaViaImportacao();

                }

                /** Categoria Nível 2 */
                if (!empty($v['categoria_nome_nivel_2']) && isset($categoria_id_nivel_1)) {

                    $categoria_id_nivel_2 = (int)$this->ShopCategoria->setIdShop($this->id_shop)
                        ->setNomeCategoria(trim($v['categoria_nome_nivel_2']))
                        ->setCategoriaParentId($categoria_id_nivel_1)
                        ->adicionaCategoriaViaImportacao();


                }

                /** Categoria Nível 3 */
                if (!empty($v['categoria_nome_nivel_3']) && isset($categoria_id_nivel_2)) {

                    $this->ShopCategoria->setIdShop($this->id_shop)
                        ->setNomeCategoria(trim($v['categoria_nome_nivel_3']))
                        ->setCategoriaParentId($categoria_id_nivel_2)
                        ->adicionaCategoriaViaImportacao();

                }

            }

        }

    }

    /**
     * Adiciona a categorias
     * @see private function saveCategoriaDb($categoria_nome = '')
     * @see private function getIdProdutoPaiSKU($sku = '')
     * @internal Model ShopCategoria->adicionaCategoriaViaImportacao()
     * @param $v
     */
    private function addProdutoCategoria($v)
    {

        if ($this->ShopCategoria instanceof ShopCategoria) {

            /** Categoria Nível 1 */
            if (!empty($v['categoria_nome_nivel_1'])) {

                $id_categoria = (int)$this->ShopCategoria->setIdShop($this->id_shop)
                    ->setNomeCategoria(trim($v['categoria_nome_nivel_1']))
                    ->getIdCategoria();

                if ($id_categoria>0) {

                    $this->ShopProdutoCategoria->setIdProduto($this->id_produto)
                        ->setIdCategoria($id_categoria)
                        ->addCategoriaProdutoViaImportacao();

                }

            }

            if (v::notEmpty()->validate($this->sku_do_produto_pai)) {

                if (!empty($v['categoria_nome_nivel_1'])) {

                    $parent_id = (int) self::getIdProdutoPaiSKU($this->sku_do_produto_pai);

                    if ($parent_id > 0) {

                        $id_categoria = (int)$this->ShopCategoria->setIdShop($this->id_shop)
                            ->setNomeCategoria(trim($v['categoria_nome_nivel_1']))
                            ->getIdCategoria();

                        $this->ShopProdutoCategoria->setIdProduto($parent_id)
                            ->setIdCategoria($id_categoria)
                            ->addCategoriaProdutoViaImportacao();

                    }

                }

            }

            /** Categoria Nível 2 */
            if (!empty($v['categoria_nome_nivel_2'])) {

                $id_categoria = (int)$this->ShopCategoria->setIdShop($this->id_shop)
                    ->setNomeCategoria(trim($v['categoria_nome_nivel_2']))
                    ->getIdCategoria();

                if ($id_categoria>0) {

                    $this->ShopProdutoCategoria->setIdProduto($this->id_produto)
                        ->setIdCategoria($id_categoria)
                        ->addCategoriaProdutoViaImportacao();

                }

            }

            /** Categoria Nível 3 */
            if (!empty($v['categoria_nome_nivel_3'])) {

                $id_categoria = (int)$this->ShopCategoria->setIdShop($this->id_shop)
                    ->setNomeCategoria(trim($v['categoria_nome_nivel_3']))
                    ->getIdCategoria();

                if ($id_categoria>0) {

                    $this->ShopProdutoCategoria->setIdProduto($this->id_produto)
                        ->setIdCategoria($id_categoria)
                        ->addCategoriaProdutoViaImportacao();

                }

            }

        }

    }

    /**
     * Salva dados da Planilha de Atualização
     * Em Caso de Erro Volta no estado Original com Transactions
     *
     * @see private function getIdProdutoPaiSKU($sku = '')
     *
     * @see Tools::uniqid()
     * @see Tools::slug($v['nome_produto'])
     * @see Tools::htmlentitiesUTF8($v['descricao'])
     *
     * @internal Model ShopProduto->getTotalProdutoSKU($this->id_shop, $v['sku'])
     * @internal AppModel ShopProduto->saveAll($data)
     * @internal AppModel ShopProduto->getInsertID()
     */
    private function salvaDadosEmDBExcelXLSX()
    {

        $this->datasource = $this->ShopProduto->getDataSource();

        try {

            $this->datasource->begin();

            /** Cadastrar Marcas */
            self::addMarca();

            /** Cadastrar Categorias */
            self::addCategoria();

            if ($this->ShopProduto instanceof ShopProduto) {

                foreach ($this->array as $v) {

                    if (v::notEmpty()->validate($v['sku'])) {

                        if ($this->ShopProduto->setIdShop($this->id_shop)->setSku($v['sku'])->getTotalProdutoSKU() <= 0) {

                            /**
                             * Verifica se o Produto é com atributos
                             */
                            if (v::notEmpty()->validate($v['sku_do_produto_pai'])) {

                                $this->parent_id = self::getIdProdutoPaiSKU($v['sku_do_produto_pai']);

                                if (!is_numeric($this->parent_id)) {

                                    $this->sku_do_produto_pai = null;
                                    $this->tipo_produto = 'normal';
                                    $this->parent_id = 0;

                                } else {
                                    $this->tipo_produto = 'atributo';
                                    $this->sku_do_produto_pai = $v['sku_do_produto_pai'];

                                }

                            }

                            if ($this->ShopMarca instanceof ShopMarca) {

                                if (!empty($v['marca'])) {
                                    $this->id_marca = $this->ShopMarca->setIdShop($this->id_shop)
                                        ->setNome(trim($v['marca']))
                                        ->getIdMarca();

                                }

                            }

                            $data = array(

                                'id_shop_default' => (int)$this->id_shop,
                                'id_marca' => (int)$this->id_marca,
                                'tipo' => $this->tipo_produto,
                                'parente_id' => (int)$this->parent_id,
                                'sku' => $v['sku'],
                                'ativo' => $v['ativo'],
                                'usado' => $v['usado'],
                                'nome' => $v['nome_produto'],
                                'apelido' => Tools::slug($v['nome_produto']),
                                'url' => Tools::slug($v['nome_produto']),
                                'descricao_completa' => Tools::htmlentitiesUTF8($v['descricao']),
                                'preco_custo' => Validate::isDecimal($v['preco_custo']),
                                'preco_cheio' => Validate::isDecimal($v['preco_venda']),
                                'preco_promocional' => Validate::isDecimal($v['preco_promocional']),
                                'peso' => Validate::isDecimal($v['peso_kg']),
                                'altura' => $v['altura_cm'],
                                'largura' => $v['largura_cm'],
                                'comprimento' => $v['comprimento_cm'],
                                'url_video_youtube' => $v['link_do_video_no_youtube'],
                                'gerenciado' => $v['gerenciar_estoque'],
                                'situacao_em_estoque' => $v['disp_dos_produtos_em_estoque'],
                                'quantidade' => $v['quantidade'],
                                'situacao_sem_estoque' => $v['disp_quando_acabar_produtos_em_estoque'],
                                'tipo_importacao_xls' => 'insert',
                                'produto_key' => Tools::uniqid()

                            );

                            $saveOK = $this->ShopProduto->saveAll($data);
                            if (!v::type('bool')->validate($saveOK)) {
                                throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_WARNING);
                            }

                            $this->id_produto = $this->ShopProduto->getInsertID();

                            /** Add Produto Categoria */
                            self::addProdutoCategoria($v);


//                            if ($this->id_produto !== 0) {
//
//                                array_push($this->count_insert_id, $this->id_produto);
//
//                                //self::adicionaGradeAoProduto();
//
//
//                            }



                        }

                    }

                }


            }

            if ($this->datasource->commit()) {

                die('commit');

                $this->Session->write('total_produto_cadastrado', $this->count_insert_id);

//                if (count($this->count_atualizado)>0) {
//                    $this->setMsgAlertSuccess('Dados de ' . count($this->count_atualizado) . ' produtos foram atualizados com sucesso.');
//                } else {
//                    $this->setMsgAlertInfo('Parece que os dados da Planilha são idênticos e nada foi alterado.');
//                }

            }


        } catch (\PDOException $e) {

            $this->datasource->rollback();
            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }


    /**
     * Recebe a Planilha e faz a validações e cadastra
     *
     * @see protected function validacaoFileExcelXLSX()
     * @see protected function lerDadosExcelXLSX()
     * @see protected function salvaDadosEmDBExcelXLSX()
     *
     * @return mixed redirect Redirecionamento de URL
     * @throws Exception
     */
    public function recebeDadosExcelXLSX()
    {

        try {

            /** Recebe dados somente via POST */

            if (!$this->request->is('post')) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            if (!$this->Session->read('id_shop')) {
                throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
            }

            $this->id_shop = $this->Session->read('id_shop');

            if ($this->id_envio_default === false) {
                throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
            }

            //Valida dados de entrada
            $this->arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : false;

            self::validacaoFileExcelXLSX();

            $this->id_envio_default = isset($this->params['named']['id_envio_default']) ? (int)$this->params['named']['id_envio_default'] : false;

            if (!v::notEmpty()->validate($this->arquivo['tmp_name'])) {
                throw new InvalidArgumentException(ERROR_FILE_INVALID, E_USER_WARNING);
            }

            /** Salva os dados */
            self::lerDadosExcelXLSX();

            /** Valida e Salva o Dados senao houver erros */
            self::salvaDadosEmDBExcelXLSX();

        } catch (\NotFoundException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError($e->getMessage());
            \Exception\VialojaDatabaseException::errorHandler($e);

        } finally {

            $this->arquivo = false;
            return $this->redirect($this->referer());

        }

    }

}
