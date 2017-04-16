<?php
/**
 * @brief	Rastreamento dos Correios
 * @details	Classes e interfaces para leitura de HTML dos Correios
 * @package Correios\Rastreamento
 */

namespace Correios\Rastreamento;
use Correios\Rastreamento\isTrackingHtml as isTrackingHtml;
use Correios\Curl\CURL as CURL;
use LengthException;
use RuntimeException;

/**
 * @brief	Resposta HTML
 * @details	Implementação de um objeto representa uma resposta HTML.
 */

class TrackingHtml implements isTrackingHtml {

	private $code;
	private $html;
	private $table;
	private $url;
	private $result;

	/**
	* Construtor
	*
	* @param string $code Código da encomenda
	* return void
	*/
	public function setCodeTrack($code=false){
		if ( strlen($code) !== 13) {		
			throw new LengthException('Código da encomenda é inválido.');
		}

		$this->code = $code;
	}

    /**
     * @return null
     * @throws \RuntimeException
     */
    public function getHtmlTrack()
	{

		$this->url = 'http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI=' . $this->code;
		$this->html = utf8_encode( CURL::file_get_contents( $this->url ) );

		if (strpos($this->html, "src=../correios/") !==false) {
			$this->html  = str_replace('src=../correios/',
				'src=http://websro.correios.com.br/correios/', $this->html );
		}

		preg_match( '/<table  border cellpadding=1 hspace=10>.*<\/TABLE>/s', $this->html, $this->table );
								
		$this->result = ( count( $this->table ) == 1 ) ? $this->table[0] : null;
		
		if($this->result === null){
			throw new RuntimeException('Objeto não encontrado!');
		}			
		
		return $this->result;
			
	}
	
}
