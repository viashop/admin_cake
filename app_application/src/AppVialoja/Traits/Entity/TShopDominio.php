<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 20/10/16 às 14:57
 */

namespace AppVialoja\Traits\Entity;


trait TShopDominio
{

    private $id_dominio;
    private $dominio;
    private $subdominio_plataforma;
    private $subdominio_add;
    private $dominio_ssl;
    private $dominio_manutencao;
    private $ssl_ativo;
    private $physical_uri;
    private $virtual_uri;
    private $main;
    private $ativo;
    private $add_cpanel;
    private $date_add_cpanel;

    /**
     * @return mixed
     */
    public function getIdDominio()
    {
        return $this->id_dominio;
    }

    /**
     * @param int $id_dominio
     * @return TShopDominio
     */
    public function setIdDominio(int $id_dominio)
    {
        $this->id_dominio = $id_dominio;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDominio()
    {
        return $this->dominio;
    }

    /**
     * @param mixed $dominio
     * @return TShopDominio
     */
    public function setDominio($dominio)
    {
        $this->dominio = $dominio;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubdominioPlataforma()
    {
        return $this->subdominio_plataforma;
    }

    /**
     * @param mixed $subdominio_plataforma
     * @return TShopDominio
     */
    public function setSubdominioPlataforma($subdominio_plataforma)
    {
        $this->subdominio_plataforma = $subdominio_plataforma;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubdominioAdd()
    {
        return $this->subdominio_add;
    }

    /**
     * @param mixed $subdominio_add
     * @return TShopDominio
     */
    public function setSubdominioAdd($subdominio_add)
    {
        $this->subdominio_add = $subdominio_add;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDominioSsl()
    {
        return $this->dominio_ssl;
    }

    /**
     * @param mixed $dominio_ssl
     * @return TShopDominio
     */
    public function setDominioSsl($dominio_ssl)
    {
        $this->dominio_ssl = $dominio_ssl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDominioManutencao()
    {
        return $this->dominio_manutencao;
    }

    /**
     * @param mixed $dominio_manutencao
     * @return TShopDominio
     */
    public function setDominioManutencao($dominio_manutencao)
    {
        $this->dominio_manutencao = $dominio_manutencao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSslAtivo()
    {
        return $this->ssl_ativo;
    }

    /**
     * @param mixed $ssl_ativo
     * @return TShopDominio
     */
    public function setSslAtivo($ssl_ativo)
    {
        $this->ssl_ativo = $ssl_ativo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhysicalUri()
    {
        return $this->physical_uri;
    }

    /**
     * @param mixed $physical_uri
     * @return TShopDominio
     */
    public function setPhysicalUri($physical_uri)
    {
        $this->physical_uri = $physical_uri;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVirtualUri()
    {
        return $this->virtual_uri;
    }

    /**
     * @param mixed $virtual_uri
     * @return TShopDominio
     */
    public function setVirtualUri($virtual_uri)
    {
        $this->virtual_uri = $virtual_uri;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * @param int $main
     * @return TShopDominio
     */
    public function setMain(int $main)
    {
        $this->main = $main;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param int $ativo
     * @return TShopDominio
     */
    public function setAtivo(int $ativo)
    {
        $this->ativo = $ativo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddCpanel()
    {
        return $this->add_cpanel;
    }

    /**
     * @param int $add_cpanel
     * @return TShopDominio
     */
    public function setAddCpanel(int $add_cpanel)
    {
        $this->add_cpanel = $add_cpanel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateAddCpanel()
    {
        return $this->date_add_cpanel;
    }

    /**
     * @param mixed $date_add_cpanel
     * @return TShopDominio
     */
    public function setDateAddCpanel($date_add_cpanel)
    {
        $this->date_add_cpanel = $date_add_cpanel;
        return $this;
    }


}

