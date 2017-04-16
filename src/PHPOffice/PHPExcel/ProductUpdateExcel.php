<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 12/09/16 às 15:05
 */

namespace PHPOffice\PHPExcel;

use Lib\Tools;
use Respect\Validation\Validator as v;

class ProductUpdateExcel implements IReflectionClassFactory
{

    private $array = array();
    private $cell;
    private $col;
    private $row;

    public function cell($cell)
    {
        $this->cell = $cell;
    }

    public function col($col)
    {
        $this->col = $col;
    }

    public function row($row)
    {
        $this->row = $row;
    }

    public function validateFile($file)
    {
        ValidateFile::check($file, 5);
    }

    /**
     * Valida os Nomes dos Campos da Planilha
     * @param $cell
     */
    public function validateHeader($cell)
    {
        $array = [
            'Cidade ou Região',
            'Faixa CEP Inicial',
            'Faixa CEP Final',
            'Peso Inicial',
            'Peso Final',
            'Valor Frete',
            'Prazo de Entrega',
            'AD VALOREM ( % )',
            'KG Adicional'
        ];

        if (!in_array($cell, $array, true)) {
            throw new \InvalidArgumentException(ERROR_FILE_INVALID_IMPORT_EXCEL, E_USER_WARNING);
        }
    }


    /**
     * Armazena dos dados em variaveis e limpa os dados
     */
    public function validateBody()
    {

        if (v::identical($this->col)->validate(1)) {

            /** Cidade ou Região **/

            $regiao = Tools::clean($this->cell);

            if (!v::stringType()->notBlank()->validate($regiao)) {
                throw new \InvalidArgumentException("Atenção: Informe na tabela a Cidade ou Região corretamente.", E_USER_WARNING);
            }

            $this->array[$this->row]['regiao'] = $regiao;

        }

        if (v::identical($this->col)->validate(2)) {

            /** Faixa CEP Inicial **/

            $cep_inicio = Tools::clean($this->cell);

            if (!v::postalCode('BR')->validate($cep_inicio)) {

                throw new \InvalidArgumentException("ATENÇÃO: Erro na linha {$this->row}, Informe na tabela as faixas de CEP no formato correto.

                Ex.: 09999-999

            Por favor, corrija o CEP Inicial \"{$cep_inicio}\" e envie o arquivo novamente.", E_USER_WARNING);

            }

            $this->array[$this->row]['cep_inicio'] = $cep_inicio;

        }

        if (v::identical($this->col)->validate(3)) {

            /** Faixa CEP Final **/

            $cep_fim = Tools::clean($this->cell);

            if (!v::postalCode('BR')->validate($cep_fim)) {

                throw new \InvalidArgumentException("ATENÇÃO: Erro na linha {$this->row}, Informe na tabela as faixas de CEP no formato correto.

                Ex.: 09999-999

            Por favor, corrija o CEP Final \"{$cep_fim}\" e envie o arquivo novamente.", E_USER_WARNING);

            }

            $this->array[$this->row]['cep_fim'] = $cep_fim;

        }

        if (v::identical($this->col)->validate(4)) {

            /** Peso Inicial **/

            $peso_inicial = Tools::clean($this->cell);

            if (v::numeric()->negative()->validate(Tools::convertToDecimal($peso_inicial))) {

                throw new \InvalidArgumentException("ATENÇÃO: Erro na linha {$this->row}, os VALORES do Peso Inicial não pode conter numeros negativos.

            Por favor, corrija o valor \"{$peso_inicial}\" e envie o arquivo novamente.", E_USER_WARNING);

            }

            $this->array[$this->row]['peso_inicial'] = $peso_inicial;

        }

        if (v::identical($this->col)->validate(5)) {

            /** Peso Final **/

            $peso_final = Tools::clean($this->cell);

            if (!v::numeric()->positive()->validate(Tools::convertToDecimal($peso_final))) {

                throw new \InvalidArgumentException("ATENÇÃO: Erro na linha {$this->row}, os VALORES do Peso Final não pode ser menor ou igual a Zero.

            Por favor, corrija o valor \"{$peso_final}\" e envie o arquivo novamente.", E_USER_WARNING);

            }

            $this->array[$this->row]['peso_final'] = $peso_final;

        }

        if (v::identical($this->col)->validate(6)) {

            /** Valor **/

            $valor = Tools::clean($this->cell);

            if (!v::notEmpty()->validate(Tools::convertToDecimal($valor))) {

                throw new \InvalidArgumentException("ATENÇÃO: Erro na linha {$this->row}, os VALOR do frete não pode ser vazio.

            Por favor, corrija o valor e envie o arquivo novamente.", E_USER_WARNING);

            }

            if (!v::numeric()->positive()->validate(Tools::convertToDecimal($valor))) {

                throw new \InvalidArgumentException("ATENÇÃO: Erro na linha {$this->row}, os VALORES do frete não pode ser menor ou igual a Zero.

            Por favor, corrija o valor \"{$valor}\" e envie o arquivo novamente.", E_USER_WARNING);

            }

            $this->array[$this->row]['valor'] = $valor;

        }

        if (v::identical($this->col)->validate(7)) {

            /** Prazo de Entrega **/

            $prazo_entrega = (int)Tools::clean($this->cell);

            /**
             * Verifica o prazo de entrega
             */
            if (!v::numeric()->positive()->validate($prazo_entrega)) {

                throw new \InvalidArgumentException("ATENÇÃO: Erro na linha {$this->row}, Atenção: Informe na tabela os Prazos de Entrega corretamente.

                Exemplo: 7 para sete dias.

            Por favor, corrija o Prazo de Entrega \"{$prazo_entrega}\" e envie o arquivo novamente.", E_USER_WARNING);

            }

            if (!v::numeric()->notBlank()->validate($prazo_entrega)) {
                $prazo_entrega = null;
            }

            $this->array[$this->row]['prazo_entrega'] = $prazo_entrega;

        }

        if (v::identical($this->col)->validate(8)) {

            /** AD VALOREM **/

            $ad_valorem = Tools::clean($this->cell);

            if (!empty($ad_valorem) && !v::numeric()->positive()->validate(Tools::convertToDecimal($ad_valorem))) {

                throw new \InvalidArgumentException("ATENÇÃO: Erro na linha {$this->row}, os VALORES do AD VALOREM não pode conter numeros negativos.

            Por favor, corrija o valor \"{$this->cell}\" e envie o arquivo novamente.", E_USER_WARNING);

            }

            if (!v::numeric()->notBlank()->validate(Tools::convertToDecimal($ad_valorem))) {
                $ad_valorem = null;
            }

            $this->array[$this->row]['ad_valorem'] = $ad_valorem;

        }

        if (v::identical($this->col)->validate(9)) {

            /** KG Adicional **/

            $kg_adicional = Tools::clean($this->cell);

            if (!empty($kg_adicional) && v::numeric()->negative()->validate(Tools::convertToDecimal($kg_adicional))) {

                throw new \InvalidArgumentException("ATENÇÃO: Erro na linha {$this->row}, os VALORES do KG Adicional não pode conter numeros negativos.

            Por favor, corrija o valor \"{$kg_adicional}\" e envie o arquivo novamente.", E_USER_WARNING);

            }

            if (!v::numeric()->notBlank()->validate(Tools::convertToDecimal($kg_adicional))) {
                $kg_adicional = null;
            }

            $this->array[$this->row]['kg_adicional'] = $kg_adicional;

        }

        return $this->array;

    }

}