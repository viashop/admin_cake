<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 18/10/16 às 00:10
 */

namespace AppVialoja\Traits\Entity;


trait TShopEnvioCorreios
{

    private $ativo;
    private $cep_origem;
    private $prazo_adicional;
    private $taxa_tipo;
    private $taxa_valor;
    private $com_contrato;
    private $codigo_servico;
    private $codigo;
    private $senha;
    private $mao_propria;
    private $valor_declarado;
    private $aviso_recebimento;


    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     * @return TShopEnvioCorreios
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCepOrigem()
    {
        return $this->cep_origem;
    }

    /**
     * @param mixed $cep_origem
     * @return TShopEnvioCorreios
     */
    public function setCepOrigem($cep_origem)
    {
        $this->cep_origem = $cep_origem;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrazoAdicional()
    {
        return $this->prazo_adicional;
    }

    /**
     * @param mixed $prazo_adicional
     * @return TShopEnvioCorreios
     */
    public function setPrazoAdicional($prazo_adicional)
    {
        $this->prazo_adicional = $prazo_adicional;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxaTipo()
    {
        return $this->taxa_tipo;
    }

    /**
     * @param mixed $taxa_tipo
     * @return TShopEnvioCorreios
     */
    public function setTaxaTipo($taxa_tipo)
    {
        $this->taxa_tipo = $taxa_tipo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxaValor()
    {
        return $this->taxa_valor;
    }

    /**
     * @param mixed $taxa_valor
     * @return TShopEnvioCorreios
     */
    public function setTaxaValor($taxa_valor)
    {
        $this->taxa_valor = $taxa_valor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComContrato()
    {
        return $this->com_contrato;
    }

    /**
     * @param mixed $com_contrato
     * @return TShopEnvioCorreios
     */
    public function setComContrato($com_contrato)
    {
        $this->com_contrato = $com_contrato;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodigoServico()
    {
        return $this->codigo_servico;
    }

    /**
     * @param mixed $codigo_servico
     * @return TShopEnvioCorreios
     */
    public function setCodigoServico($codigo_servico)
    {
        $this->codigo_servico = $codigo_servico;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     * @return TShopEnvioCorreios
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     * @return TShopEnvioCorreios
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaoPropria()
    {
        return $this->mao_propria;
    }

    /**
     * @param mixed $mao_propria
     * @return TShopEnvioCorreios
     */
    public function setMaoPropria($mao_propria)
    {
        $this->mao_propria = $mao_propria;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorDeclarado()
    {
        return $this->valor_declarado;
    }

    /**
     * @param mixed $valor_declarado
     * @return TShopEnvioCorreios
     */
    public function setValorDeclarado($valor_declarado)
    {
        $this->valor_declarado = $valor_declarado;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAvisoRecebimento()
    {
        return $this->aviso_recebimento;
    }

    /**
     * @param mixed $aviso_recebimento
     * @return TShopEnvioCorreios
     */
    public function setAvisoRecebimento($aviso_recebimento)
    {
        $this->aviso_recebimento = $aviso_recebimento;
        return $this;
    }

}


