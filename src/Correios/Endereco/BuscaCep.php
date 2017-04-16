<?php 
/**
 * @brief	Endereço dos Correios
 * @details	Classes e interfaces para buscar endereço atraves do CEP
 * @package Correios\Endereco
 */

namespace Correios\Endereco;
use Correios\Endereco\isBuscaCep as isBuscaCep;

/**
* Busca endereço via cep
*/
class BuscaCep implements isBuscaCep {
	
	private $logradouro;
	private $bairro;
	private $localidade;
	private $uf;
	private $cep;

    /**
     * @param mixed $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $localidade
     */
    public function setLocalidade($localidade)
    {
        $this->localidade = $localidade;
    }

    /**
     * @return mixed
     */
    public function getLocalidade()
    {
        return $this->localidade;
    }

    /**
     * @param mixed $logradouro
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    /**
     * @return mixed
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * @param mixed $uf
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    /**
     * @return mixed
     */
    public function getUf()
    {
        return $this->uf;
    }


	/**
	 * buscarCep busca endereço pelo cep
	 * @param  int $cep
	 * @return array
	 */
	public function buscarCep($cep=''){

		$ch = curl_init();

			curl_setopt_array($ch, array
			(
				CURLOPT_URL 			=> "http://www.buscacep.correios.com.br/servicos/dnec/consultaEnderecoAction.do",
				CURLOPT_POST			=> TRUE,
				CURLOPT_POSTFIELDS		=> "relaxation={$cep}&TipoCep=ALL&semelhante=N&Metodo=listaLogradouro&TipoConsulta=relaxation&StartRow=1&EndRow=10&cfm=1",
				CURLOPT_RETURNTRANSFER	=> TRUE
			));

			$response = curl_exec($ch);
			curl_close($ch);

			preg_match_all("/>(.*?)<\/td>/", $response, $matches);

			return $matches[1];

	}

	/**
	 * retorna as informações dos correios
	 * @param  int $cep
	 * @return string
	 */
	public function retornaInformacoesCep($cep='')
	{
	 	
	 	$infoCorreios = $this->buscarCep($cep);

	 	if (isset($infoCorreios[0])) {

			$this->setLogradouro($infoCorreios[0]);

	 	}

	 	if (isset($infoCorreios[1])) {

			$this->setBairro($infoCorreios[1]);

	 	}

	 	if (isset($infoCorreios[2])) {

			$this->setLocalidade($infoCorreios[2]);

	 	}

	 	if (isset($infoCorreios[3])) {

			$this->setUf($infoCorreios[3]);

	 	}

	 	if (isset($infoCorreios[4])) {

			$this->setCep($infoCorreios[4]);

	 	}

	}


	/**
	 * retorna as informações dos correios
	 * @param  int $cep
	 * @return string
	 */
	public function retornaUFCep($cep='')
	{
	 	
	 	$infoCorreios = $this->buscarCep($cep);

	 	if (isset($infoCorreios[4]) && strlen($infoCorreios[4])==2) {

	 		$this->setUf($infoCorreios[4]);

	 	} elseif (isset($infoCorreios[3]) && strlen($infoCorreios[3])==2) {

	 		$this->setUf($infoCorreios[3]);

	 	} elseif (isset($infoCorreios[2]) && strlen($infoCorreios[2])==2) {

	 		$this->setUf($infoCorreios[2]);

	 	} elseif (isset($infoCorreios[1]) && strlen($infoCorreios[1])==2) {

	 		$this->setUf($infoCorreios[1]);

	 	} elseif (isset($infoCorreios[0]) && strlen($infoCorreios[0])==2) {

	 		$this->setUf($infoCorreios[0]);

	 	}

	}

}
