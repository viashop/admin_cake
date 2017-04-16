<?php

use Lib\Tools;
use Lib\Validate;
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
class ImportarProdutosAtualizarController extends AppController
{

    public $uses = array('ShopProduto');

    private $array = array();
    private $arquivo;
    private $id_shop;
    private $count_atualizado = array();
    private $datasource;

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
     * Validação de Dados da Atualização
     */
    private function validacaoBodyExcelXLSX()
    {

        if (v::identical($this->col)->validate(1)) {

            if (!v::notEmpty()->validate($this->cell)) {
                throw new \NotFoundException("Erro: Por favor, não altere ou remova os dados da SKU.", E_USER_WARNING);
            }

            $this->array[$this->row]['sku'] = Tools::clean($this->cell);

        }

        /**
         * Produto Ativo
         */
        if (v::identical($this->col)->validate(2)) {

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

        if (v::identical($this->col)->validate(3)) {

            if (!v::stringType()->notEmpty()->validate($this->cell)) {
                throw new \NotFoundException("Erro: Por favor, preencha o(s) campo(s) Nome do Produto corretamente.", E_USER_WARNING);
            }

            $this->array[$this->row]['nome_produto'] = Tools::clean($this->cell);

        }

        /**
         * Gerenciar estoque
         */
        if (v::identical($this->col)->validate(4)) {


            /** Gerenciado? **/
            $gerenciado = (string)strtoupper(Tools::clean($this->cell));
            if (v::identical('SIM')->validate($gerenciado)) {
                $gerenciado = 'True';
            } elseif (v::contains('S')->validate($gerenciado)) {
                $gerenciado = 'True';
            } else {
                $gerenciado = 'False';
            }

            $this->array[$this->row]['gerenciado'] = $gerenciado;

        }

        if (v::identical($this->col)->validate(5)) {

            $this->array[$this->row]['quantidade'] = intval($this->cell);

        }

        if (v::identical($this->col)->validate(6)) {

            /** Preço Custo **/

            $this->array[$this->row]['preco_custo'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(7)) {

            /** Preço Venda **/

            $this->array[$this->row]['preco_venda'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(8)) {

            /** Preço Promocional **/

            $this->array[$this->row]['preco_promocional'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(9)) {

            /** Peso **/
            $this->array[$this->row]['peso'] = Tools::clean($this->cell);

        }

        if (v::identical($this->col)->validate(10)) {
            $this->array[$this->row]['altura'] = intval($this->cell);
        }

        if (v::identical($this->col)->validate(11)) {
            $this->array[$this->row]['largura'] = intval($this->cell);
        }

        if (v::identical($this->col)->validate(12)) {
            $this->array[$this->row]['comprimento'] = intval($this->cell);
        }

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
     * Valida os Nomes dos Campos da Planilha de Importação
     * @param $string
     */
    private function validacaoHeaderExcelXLSX()
    {

        $array = [
            'SKU',
            'Ativo?',
            'Nome produto',
            'Gerenciar estoque?',
            'Quantidade em estoque',
            'Preço custo',
            'Preço venda',
            'Preço promocional',
            'Peso (kg)',
            'Altura (cm)',
            'Largura (cm)',
            'Comprimento (cm)'
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

            if (v::numeric()->notBlank()->validate(Tools::convertToDecimal($valor['preco_venda']))) {

                $mensagem = EOL . EOL. "Por favor, informe os preços corretamente do produto com a SKU {$valor['sku']} na linha {$valor['row']} e tente novamente.

                     Só é possível salvar os dados do produto após corrigir este problema.";

                if (!v::numeric()->notBlank()->validate(Tools::convertToDecimal($valor['preco_custo']))) {
                    throw new \InvalidArgumentException("Atenção! Preço de custo do produto não pode ser vazio." . $mensagem,
                        E_USER_WARNING
                    );
                }

                if (!Validate::isValueBigger($valor['preco_venda'],$valor['preco_custo'])) {

                    throw new \InvalidArgumentException("Atenção! O preço de custo não pode ser maior ou igual que o preço de venda." . $mensagem,
                        E_USER_WARNING
                    );

                }

                if (v::numeric()->notBlank()->validate(Tools::convertToDecimal($valor['preco_promocional']))) {

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

        /**
         * Conferir preços invalidos
         */
        self::verificaPrecoInvalidosExcelXLSX();

    }


    /**
     * Salva dados da Planilha de Atualização
     * Em Caso de Erro Volta no estado Original com Transactions
     *
     * @see Validate::isDecimal($v['...']);
     *
     * @internal Model ShopProduto->getTotalProdutoSKU($this->id_shop, $v['sku'])
     * @internal AppModel ShopProduto->removeAll($this->id_shop)
     * @internal AppModel ShopProduto->ShopProduto->updateAll($fields, $conditions)
     * @internal AppModel ShopProduto->getAffectedRows()
     */
    private function salvaDadosEmDBExcelXLSX()
    {

        if ($this->ShopProduto instanceof ShopProduto) {

            $this->datasource = $this->ShopProduto->getDataSource();

            try {

                $this->datasource->begin();

                foreach ($this->array as $v) {

                    if (v::notEmpty()->validate($v['sku'])) {

                        if ($this->ShopProduto->setIdShop($this->id_shop)->setSku($v['sku'])->getTotalProdutoSKU() > 0) {

                            $fields = array(
                                'ShopProduto.ativo' => sprintf("'%s'", $v['ativo']),
                                'ShopProduto.nome' => sprintf("'%s'", $v['nome_produto']),
                                'ShopProduto.gerenciado' => sprintf("'%s'", $v['gerenciado']),
                                'ShopProduto.quantidade' => (int)$v['quantidade'],
                                'ShopProduto.preco_custo' => Validate::isDecimal($v['preco_custo']),
                                'ShopProduto.preco_cheio' => Validate::isDecimal($v['preco_venda']),
                                'ShopProduto.preco_promocional' => Validate::isDecimal($v['preco_promocional']),
                                'ShopProduto.peso' => Validate::isDecimal($v['peso']),
                                'ShopProduto.altura' => (int)$v['altura'],
                                'ShopProduto.largura' => (int)$v['largura'],
                                'ShopProduto.comprimento' => (int)$v['comprimento'],
                                'ShopProduto.tipo_importacao_xls' => sprintf("'%s'", 'update')
                            );
                            $conditions = array(
                                'ShopProduto.sku' => $v['sku'],
                                'ShopProduto.id_shop_default' => $this->id_shop
                            );
                            $upOK = $this->ShopProduto->updateAll($fields, $conditions);
                            if (!v::type('bool')->validate($upOK)) {
                                throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_WARNING);
                            }
                            if (v::notBlank()->validate($this->ShopProduto->getAffectedRows())) {
                                array_push($this->count_atualizado, $this->ShopProduto->getAffectedRows());
                            }

                        }

                    }

                }

                if ($this->datasource->commit()) {

                    if (count($this->count_atualizado)>0) {
                        $this->setMsgAlertSuccess('Dados de ' . count($this->count_atualizado) . ' produtos foram atualizados com sucesso.');
                    } else {
                        $this->setMsgAlertInfo('Parece que os dados da Planilha são idênticos e nada foi alterado.');
                    }

                }

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                \Exception\VialojaDatabaseException::errorHandler($e);

            }


        } else {

            trigger_error('Model ShopProduto não Instanciada', E_USER_WARNING);
            exit;

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


            /**
             * Recebe dados somente via POST
             */
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

            /* Analisa os Dados do XLSX */
            self::lerDadosExcelXLSX();

            /* Salva do Dados no DB*/
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
