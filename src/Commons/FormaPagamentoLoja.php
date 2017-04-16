<?php

namespace Commons;

class FormaPagamentoLoja
{

	public static function formaAtiva($pagamento='')
	{

		if ($pagamento['Shop']['id_plano'] <= 1) {

            switch ($pagamento['ConfiguracaoPagamento']['slug']) {

                case 'pagamento_deposito':
                case 'pagamento_boleto':
                    return false;
                    break;
                default:

                    if ($pagamento['ShopPagamento']['ativo'] == 'True'):

                        if ($pagamento['ConfiguracaoPagamento']['slug'] == 'pagamento_paypal')
                            if (empty($pagamento['ShopPagamentoFacilitador']['usuario']))
                                return false;
                            else {
                                return true;
                            }
                        else {
                            if (empty($pagamento['ShopPagamentoFacilitador']['usuario'])
                                || empty($pagamento['ShopPagamentoFacilitador']['token']))
                                return false;
                            else {
                                return true;
                            }
                        }

                    else:

                       return false;

                    endif;

                    break;

            }

        } else {


            if ($pagamento['ShopPagamento']['ativo'] == 'True'):

                switch ($pagamento['ConfiguracaoPagamento']['slug']) {
                    case 'pagamento_paypal':

                        if (empty($pagamento['ShopPagamentoFacilitador']['usuario']))
                            return false;
                        else {
                            return true;
                        }
                        break;

                    case 'pagamento_deposito':

                        if (isset($pagamento['ShopPagamentoDepositoConfig']['ativo'])
                            && $pagamento['ShopPagamentoDepositoConfig']['ativo'] == 'True' )

                            if (empty($pagamento['ShopPagamentoDepositoConfig']['agencia'])
                                || empty($pagamento['ShopPagamentoDepositoConfig']['numero_conta'])
                                || empty($pagamento['ShopPagamentoDepositoConfig']['favorecido']))

                                return false;

                            else {
                                return true;
                            }

                        else {

                            return false;
                        }

                        break;

                    default:

                        if (empty($pagamento['ShopPagamentoFacilitador']['usuario'])
                        || empty($pagamento['ShopPagamentoFacilitador']['token']))
                            return false;
                        else {
                            return true;
                        }

                        break;
                }

            else:

                return false;

            endif;

        }

	}

}
