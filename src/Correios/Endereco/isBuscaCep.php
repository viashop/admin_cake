<?php

namespace Correios\Endereco;

/**
 * Interface isBuscaCep
 * @package Correios\Endereco
 */
interface isBuscaCep {

	/**
     * @param mixed $bairro
     */
    public function setBairro($bairro);

    /**
     * @return mixed
     */
    public function getBairro();

    /**
     * @param mixed $cep
     */
    public function setCep($cep);

    /**
     * @return mixed
     */
    public function getCep();

    /**
     * @param mixed $localidade
     */
    public function setLocalidade($localidade);

    /**
     * @return mixed
     */
    public function getLocalidade();

    /**
     * @param mixed $logradouro
     */
    public function setLogradouro($logradouro);

    /**
     * @return mixed
     */
    public function getLogradouro();

    /**
     * @param mixed $uf
     */
    public function setUf($uf);

    /**
     * @return mixed
     */
    public function getUf(); 

	/**
	 * buscarCep busca endereço pelo cep
	 * @param  int $cep
	 * @return array
	 */
	public function buscarCep($cep='');

	/**
	 * retorna as informações dos correios
	 * @param  int $cep
	 * @return string
	 */
	public function retornaInformacoesCep($cep='');	

	/**
	 * retorna as informações dos correios
	 * @param  int $cep
	 * @return string
	 */
	public function retornaUFCep($cep='');	

} 