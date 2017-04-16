<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 07/09/16 às 17:25
 */

namespace AppVialoja\Traits\Entity;


trait TShopEnvioTransportadora
{

    private $regiao;
    private $cep_inicio;
    private $cep_fim;
    private $peso_inicial;
    private $peso_final;
    private $valor;
    private $prazo_entrega;
    private $ad_valorem;
    private $kg_adicional;

    /**
     * @return string
     */
    public function getRegiao()
    {
        return $this->regiao;
    }

    /**
     * @param string $regiao
     * @return TShopEnvioTransportadora
     */
    public function setRegiao(string $regiao)
    {
        $this->regiao = $regiao;
        return $this;
    }

    /**
     * @return string
     */
    public function getCepInicio()
    {
        return $this->cep_inicio;
    }

    /**
     * @param string $cep_inicio
     * @return TShopEnvioTransportadora
     */
    public function setCepInicio(string $cep_inicio)
    {
        $this->cep_inicio = $cep_inicio;
        return $this;
    }

    /**
     * @return string
     */
    public function getCepFim()
    {
        return $this->cep_fim;
    }

    /**
     * @param string $cep_fim
     * @return TShopEnvioTransportadora
     */
    public function setCepFim(string $cep_fim)
    {
        $this->cep_fim = $cep_fim;
        return $this;
    }

    /**
     * @return float
     */
    public function getPesoInicial()
    {
        return $this->peso_inicial;
    }

    /**
     * @param float $peso_inicial
     * @return TShopEnvioTransportadora
     */
    public function setPesoInicial(float $peso_inicial)
    {
        $this->peso_inicial = $peso_inicial;
        return $this;
    }

    /**
     * @return float
     */
    public function getPesoFinal()
    {
        return $this->peso_final;
    }

    /**
     * @param float $peso_final
     * @return TShopEnvioTransportadora
     */
    public function setPesoFinal(float $peso_final)
    {
        $this->peso_final = $peso_final;
        return $this;
    }

    /**
     * @return float
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param float $valor
     * @return TShopEnvioTransportadora
     */
    public function setValor(float $valor)
    {
        $this->valor = $valor;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrazoEntrega()
    {
        return $this->prazo_entrega;
    }

    /**
     * @param int $prazo_entrega
     * @return TShopEnvioTransportadora
     */
    public function setPrazoEntrega(int $prazo_entrega)
    {
        $this->prazo_entrega = $prazo_entrega;
        return $this;
    }

    /**
     * @return float
     */
    public function getAdValorem()
    {
        return $this->ad_valorem;
    }

    /**
     * @param float $ad_valorem
     * @return TShopEnvioTransportadora
     */
    public function setAdValorem(float $ad_valorem)
    {
        $this->ad_valorem = $ad_valorem;
        return $this;
    }

    /**
     * @return float
     */
    public function getKgAdicional()
    {
        return $this->kg_adicional;
    }

    /**
     * @param float $kg_adicional
     * @return TShopEnvioTransportadora
     */
    public function setKgAdicional(float $kg_adicional)
    {
        $this->kg_adicional = $kg_adicional;
        return $this;
    }

}