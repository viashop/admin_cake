<?php

namespace Correios\Simulador;
use Correios\Calculos\Ect\Prdt\ECTFormatos as ECTFormatos;
use Correios\Calculos\Ect\Prdt\ECTServicos as ECTServicos;
use Exception;

class Frete
{
	
    /**
     * Envia os dados para calculo nos Correios
     * @param  string $forma [description]
     * @return array
     */
    public function calcular($cep_destino='', $peso='',$altura='',$largura='',$comprimento='',$envio_formas='')
    {       

        try {


            if ($envio_formas == '') {
                return false;
            }

            $codigo_servico = array();
            $com_contrato = array();
            $codigo = array();
            $senha = array();
            $mao_propria = array();
            $valor_declarado = array();
            $aviso_recebimento = array();
            $cep_origem = array();

            foreach ($envio_formas as $key => $forma) {
                array_push($codigo_servico, $forma['ShopEnvioCorreios']['codigo_servico']);
                array_push($com_contrato, $forma['ShopEnvioCorreios']['com_contrato']);
                array_push($codigo, $forma['ShopEnvioCorreios']['codigo']);
                array_push($senha, $forma['ShopEnvioCorreios']['senha']);
                array_push($mao_propria, $forma['ShopEnvioCorreios']['mao_propria']);
                array_push($valor_declarado, $forma['ShopEnvioCorreios']['valor_declarado']);
                array_push($aviso_recebimento, $forma['ShopEnvioCorreios']['aviso_recebimento']);
                array_push($cep_origem, $forma['ShopEnvioCorreios']['cep_origem']);
            }   


                                
            $ect = new \Correios\Calculos\Ect\ECT();
            $prdt = $ect->prdt();

            $prdt->setNVlAltura(2);
            if (!empty($altura) && $altura > 2) {
                if (round($altura)>105) {
                    throw new Exception("A altura não pode ser maior que 105 cm.", 1);              
                }
                $prdt->setNVlAltura($altura);
            }

            $prdt->setNVlLargura(11);
            if (!empty($largura) && $largura > 11) {
                $prdt->setNVlLargura($largura);
            }

            $prdt->setNVlComprimento(16);
            if (!empty($comprimento) && $comprimento > 16) {
                if (round($comprimento)>105) {
                    throw new Exception("O comprimento não pode ser maior que 105 cm.", 1);             
                }
                $prdt->setNVlComprimento($comprimento);
            }

            $prdt->setNCdFormato( ECTFormatos::FORMATO_CAIXA_PACOTE );
            $prdt->setNCdServico(  implode( ',' , $codigo_servico ) );

            $cep_origem = array_unique( $cep_origem );
            $prdt->setSCepOrigem( self::cleanIsInt( $cep_origem ) );        
            $prdt->setSCepDestino( self::cleanIsInt( $cep_destino ) );
            $prdt->setNVlPeso( $peso );
            $prdt->setNCdEmpresa( implode( ',' , $codigo ) );
            $prdt->setSDsSenha( implode( ',' , $senha ) );          
            $prdt->setSCdMaoPropria( implode( ',' , $mao_propria ) );
            $prdt->setSCdAvisoRecebimento( implode( ',' , $aviso_recebimento ) );

            return $prdt->call();
            
        } catch (Exception $e) {
            
            return false;

        }        

    }

    private function cleanIsInt($value)
    {
        return preg_replace('/[^0-9]/i', '', $value );
    }

}