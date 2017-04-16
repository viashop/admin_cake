<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 18/10/16 às 20:08
 */

namespace AppVialoja\Traits\Entity;


trait TShopEndereco
{


    private $id_endereco;
    private $id_estado;
    private $id_cidade;
    private $endereco;
    private $cep;
    private $bairro;
    private $numero;
    private $complemento;
    private $mostrar_endereco;
    private $outros;

    /**
     * @return mixed
     */
    public function getIdEndereco()
    {
        return $this->id_endereco;
    }

    /**
     * @param mixed $id_endereco
     * @return IShopEndereco
     */
    public function setIdEndereco(int $id_endereco)
    {
        $this->id_endereco = $id_endereco;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdEstado()
    {
        return $this->id_estado;
    }

    /**
     * @param mixed $id_estado
     * @return IShopEndereco
     */
    public function setIdEstado(int $id_estado)
    {
        $this->id_estado = $id_estado;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdCidade()
    {
        return $this->id_cidade;
    }

    /**
     * @param mixed $id_cidade
     * @return IShopEndereco
     */
    public function setIdCidade(int $id_cidade)
    {
        $this->id_cidade = $id_cidade;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     * @return IShopEndereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     * @return IShopEndereco
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     * @return IShopEndereco
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     * @return IShopEndereco
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * @param mixed $complemento
     * @return IShopEndereco
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMostrarEndereco()
    {
        return $this->mostrar_endereco;
    }

    /**
     * @param mixed $mostrar_endereco
     * @return IShopEndereco
     */
    public function setMostrarEndereco($mostrar_endereco)
    {
        $this->mostrar_endereco = $mostrar_endereco;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOutros()
    {
        return $this->outros;
    }

    /**
     * @param mixed $outros
     * @return IShopEndereco
     */
    public function setOutros($outros)
    {
        $this->outros = $outros;
        return $this;
    }


}


