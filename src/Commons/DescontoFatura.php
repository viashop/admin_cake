<?php

namespace Commons;

class DescontoFatura
{
	
	private $dataCompra = null;
	private $dataVencimento = null;
	private $valorPlanoAtual = null;
	private $valorPlanoNovo = null;

	public function setDataCompra($dataCompra){
		$this->dataCompra = $dataCompra;
	}

	public function setDataVencimento($dataVencimento){
		$this->dataVencimento = $dataVencimento;
	}

	public function setValorPlanoAtual($valorPlanoAtual){
		$this->valorPlanoAtual = $valorPlanoAtual;
	}

	public function setValorPlanoNovo($valorPlanoNovo){
		$this->valorPlanoNovo = $valorPlanoNovo;
	}
	
	public function calcular()
	{
		
		$date = new \DateTime( date('Y-m-d') );
		if( $date->format( 'Y-m-d' ) > $this->dataVencimento ){
		
			return $this->valorPlanoNovo;
			
		} else {
		
			$date1 = new \DateTime( $this->dataCompra );
			$date2 = new \DateTime( $this->dataVencimento );
			
			//calcula a diferenca entre as duas datas
			$diff = $date1->diff($date2);
			$valor_dia = ( $this->valorPlanoAtual / ($diff->days+1) );	
			
			$date3 = new \DateTime( date('Y-m-d') );
			$diff2 = $date3->diff($date2);
			$valor_abatimento = ( $diff2->days * $valor_dia );
			$valor_atual_fatura = ( $this->valorPlanoNovo - $valor_abatimento );
			
			return round( $valor_atual_fatura, 2);
		
		}
	}
}

/*
$data_compra = '2014-07-08';
$data_vencimento = '2014-09-07';
$valor_plano_atual = '549.00';
$valor_plano_novo = '949.90';


$calcula = new \DescontoFatura();
$calcula->setDataCompra($data_compra);
$calcula->setDataVencimento($data_vencimento);
$calcula->setValorPlanoAtual($valor_plano_atual);
$calcula->setValorPlanoNovo($valor_plano_novo);
$saldo = $calcula->calcular();



if( $saldo < 0){
	//Insert crédito
	echo 'Novo valor fatura: 0.00';
	echo '<br />';
	echo 'Crédito próxima cobrança: ' . abs($calcula->calcular());
} else {
	echo 'Valor do novo plano: '. $valor_plano_novo;
	echo '<br />';
	echo 'Desconto: '. ( $valor_plano_novo - $saldo );
}
*/
